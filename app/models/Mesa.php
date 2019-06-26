<?php  
	
	class Mesa {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function addMesa($data) {
			$this->db->query('INSERT INTO tb_mesas(id, descricao, data_registro, id_usuario, status) VALUES (:id, :descricao, :data_registro, :id_usuario, :status)');
			$this->db->bind(":id", $data['id']);
			$this->db->bind(":descricao", $data['descricao']);
			$this->db->bind(":data_registro", $data['data_registro']);
			$this->db->bind(":id_usuario", $data['id_usuario']);
			$this->db->bind(":status", $data['status']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		
		}

		public function delete($id) {
			$this->db->query("DELETE FROM tb_mesas WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		
		}

		public function getMesas() {
			$this->db->query("SELECT m.* FROM tb_mesas AS m");
			

			if ($this->db->execute()) {
				return $this->db->resultSet();
			}else{
				return false;
			}
		
		}

		public function getComandaMesa($id) {
			$this->db->query("SELECT c.* FROM tb_comandas AS c JOIN tb_mesas AS m ON c.id_mesa = m.id WHERE c.status = 0 AND m.id = :id");
			$this->db->bind(":id", $id);
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}

		}

		public function verify($id) {
			$this->db->query("SELECT * FROM tb_mesas WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		
		}

		public function verifyDis($id) {
			$this->db->query("SELECT * FROM tb_mesas WHERE id = :id AND status = 1");
			$this->db->bind(":id", $id);
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		
		}


		public function setMesa($id, $status) {
			$this->db->query("UPDATE tb_mesas SET status = :status WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->bind(":status", $status);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		
		}

		public function update($data) {
			$this->db->query("UPDATE tb_mesas SET id = :new_id, descricao = :descricao WHERE id = :id");
			$this->db->bind(":id", $data['id']);
			$this->db->bind(":new_id", $data['new_id']);
			$this->db->bind(":descricao", $data['descricao']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		
		}


		// PEDIDOS

		public function getProdutos($query) {
			$this->db->query("SELECT id, descricao, valor, estoque FROM tb_produtos WHERE descricao LIKE :query ORDER BY estoque DESC");
			$this->db->bind(":query", '%'.$query.'%');

			$this->db->execute();
			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}
			
		}

		public function estoque($id) {
			$this->db->query("SELECT estoque FROM tb_produtos WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}

		}


		// COMANDAS

		public function addComanda($data) {
			$this->db->query("INSERT INTO tb_comandas(nome_cliente, whatsapp, data_registro, id_usuario, id_mesa, status) VALUES (:nome_cliente, :whatsapp, :data_registro, :id_usuario, :id_mesa, :status)");
			$this->db->bind(":nome_cliente", $data['cliente']);
			$this->db->bind(":whatsapp", $data['whatsapp']);
			$this->db->bind(":data_registro", $data['data_registro']);
			$this->db->bind(":id_usuario", $data['id_usuario']);
			$this->db->bind(":id_mesa", $data['mesa']);
			$this->db->bind(":status", $data['status']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function getCom($id) {
			$this->db->query("SELECT * FROM tb_comandas WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute() && $this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}
		}

		public function setCom($id, $status) {
			$this->db->query("UPDATE tb_comandas SET status = :status WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->bind(":status", $status);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		
		}

		public function setVotoCom($id) {
			$this->db->query("UPDATE tb_comandas SET statusVoto = :statusVoto WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->bind(":statusVoto", 1);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function closeComanda($id, $total) {
			$this->db->query("UPDATE tb_comandas SET data_fechado = :data_fechado, total = :total, status = :status WHERE id = :id");
			$this->db->bind(":data_fechado", date("Y-m-d H:i:s"));
			$this->db->bind(":total", $total);
			$this->db->bind(":status", 1);
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}

		}

		public function getComAll() {
			$this->db->query("SELECT * FROM tb_comandas WHERE status = 0");

			return $this->db->resultSet();
		}

		public function getComCloses() {
			$this->db->query("SELECT * FROM tb_comandas WHERE status = 1 AND CURRENT_DATE < data_fechado");

			return $this->db->resultSet();
		}

		public function getCurrentesCom() {
			$this->db->query("SELECT * FROM tb_comandas WHERE CURRENT_DATE < data_registro OR CURRENT_DATE < data_fechado");
			$this->db->execute();
			return $this->db->rowCount();
		}

		public function verifyComActive() {
			$this->db->query("SELECT * FROM tb_comandas WHERE status = 0");
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		public function cancelarCom($id) {
			if ($this->deletePedidoAll($id)) {
				$this->db->query("DELETE FROM tb_comandas WHERE id = :id");
				$this->db->bind(":id", $id);

				if ($this->db->execute()) {
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
			

		}

		// PEDIDOS

		public function addPedido($id_comanda, $id_produto, $qtd) {
			$this->db->query("INSERT INTO tb_comandas_produtos(quantidade, id_comanda, id_produto) VALUES (:quantidade, :id_comanda, :id_produto)");
			$this->db->bind(":quantidade", $qtd);
			$this->db->bind(":id_comanda", $id_comanda);
			$this->db->bind(":id_produto", $id_produto);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}

		}

		public function getEstoquePedido($id) {
			$this->db->query("SELECT p.estoque, p.id, cp.quantidade FROM tb_produtos AS p JOIN tb_comandas_produtos AS cp ON cp.id_produto = p.id WHERE cp.id = :id LIMIT 1");
			$this->db->bind(":id", $id);
			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				$estoque = $this->db->resultSet();
				return $estoque;
			}else{
				return false;
			}
		}

		public function updatePedido($id, $valor) {
			$this->db->query("UPDATE tb_comandas_produtos SET quantidade = :quantidade WHERE id = :id");
			$this->db->bind(":quantidade", $valor);
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}

		}

		public function deletePedido($id) {
			$this->db->query("DELETE FROM tb_comandas_produtos WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function deletePedidoAll($id) {
			$this->db->query("DELETE FROM tb_comandas_produtos WHERE id_comanda = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function getPedido($id) {
			$this->db->query("SELECT cp.id AS id_pedido, p.id AS id_produto, p.estoque, m.id AS id_comanda, m.total, m.nome_cliente, m.data_registro, p.descricao, p.valor, cp.quantidade FROM tb_comandas_produtos AS cp JOIN tb_comandas AS m ON m.id = cp.id_comanda JOIN tb_produtos AS p ON cp.id_produto = p.id WHERE cp.id_comanda = :id ORDER BY cp.id ASC");
			$this->db->bind(":id", $id);

			if ($this->db->execute() && $this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}
		}

		public function getPedidoTotal($id) {
			$this->db->query("SELECT m.id AS id_comanda, SUM(p.valor * cp.quantidade) AS total, cp.quantidade FROM tb_comandas_produtos AS cp JOIN tb_comandas AS m ON m.id = cp.id_comanda JOIN tb_produtos AS p ON cp.id_produto = p.id WHERE cp.id_comanda = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return $this->db->resultSet();
			}else{
				return false;
			}
		}


	}


?>