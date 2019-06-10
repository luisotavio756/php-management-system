<?php  
	
	class Caixa {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function open($data){
			$this->db->query("INSERT INTO tb_caixa(saldo_inicial, data_aberto, id_usuario, status) VALUES (:saldo_inicial, :data_aberto, :id_usuario, :status)");
			$this->db->bind(":saldo_inicial", $data['saldo_inicial']);
			$this->db->bind(":data_aberto", $data['data_aberto']);
			$this->db->bind(":id_usuario", $data['id_usuario']);
			$this->db->bind(":status", 1);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function close($id, $saldo){
			$this->db->query("UPDATE tb_caixa SET saldo_final = :saldo_final, data_fechado = :data_fechado, status = :status WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->bind(":saldo_final", $saldo);
			$this->db->bind(":status", 0);
			$this->db->bind(":data_fechado", date("Y-m-d H:i:s"));

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function movimentoCaixa($data, $id_caixa) {
			$this->db->query("INSERT INTO tb_movimento_caixa(descricao, tipo, modo_pagamento, valor, data_registro, id_caixa) VALUES (:descricao, :tipo, :modo_pagamento, :valor, :data_registro, :id_caixa)");
			$this->db->bind(":descricao", $data['descricao']);
			$this->db->bind(":tipo", $data['tipo']);
			$this->db->bind(":modo_pagamento", $data['modo_pagamento']);
			$this->db->bind(":valor", $data['valor']);
			$this->db->bind(":data_registro", $data['data_registro']);
			$this->db->bind(":id_caixa", $id_caixa);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function consultarMovimentos($tipo, $id_caixa) {
			$this->db->query("SELECT SUM(valor) AS valor FROM tb_movimento_caixa WHERE tipo = :tipo AND id_caixa = :id_caixa");
			$this->db->bind(":tipo", $tipo);
			$this->db->bind(":id_caixa", $id_caixa);

			if ($this->db->execute()) {
				return $this->db->singleSet()->valor;
			}else{
				return false;
			}
		}
 
		public function verifyOpen(){
			$this->db->query("SELECT * FROM tb_caixa WHERE status = 1 OR saldo_final = null");
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		public function idCaixa(){
			$this->db->query("SELECT id FROM tb_caixa WHERE status = 1 ORDER BY id DESC LIMIT 1");
			if ($this->db->execute() && $this->db->rowCount() > 0) {
				$row = $this->db->singleSet();
				return $row->id;
			}else{
				return false;
			}
		}

		public function saldoInicial($id){
			$this->db->query("SELECT saldo_inicial FROM tb_caixa WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute() && $this->db->rowCount() > 0) {
				$row = $this->db->singleSet();
				return $row->saldo_inicial;
			}else{
				return false;
			}
		}

	}


?>