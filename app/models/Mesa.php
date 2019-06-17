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
			$this->db->query("SELECT m.*, c.id AS id_comanda FROM tb_mesas AS m LEFT JOIN tb_comandas AS c ON c.id_mesa = m.id");
			

			if ($this->db->execute()) {
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

		public function getProdutos($query) {
			$this->db->query("SELECT id, descricao, valor FROM tb_produtos WHERE descricao LIKE :query");
			$this->db->bind(":query", '%'.$query.'%');

			$this->db->execute();
			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
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

		// COMANDAS

		// public function verifyCom($num) {
		// 	$this->db->query("SELECT * FROM tb_comandas WHERE  = :num");
		// 	$this->db->bind(":num", $num);

		// 	if ($this->db->execute() && $this->db->rowCount() > 0) {
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
		// }

		public function addComanda($data) {
			$this->db->query("INSERT INTO tb_comandas(nome_cliente, data_registro, id_usuario, id_mesa, status) VALUES (:nome_cliente, :data_registro, :id_usuario, :id_mesa, :status)");
			$this->db->bind(":nome_cliente", $data['cliente']);
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

			$this->db->execute();

			if ($this->db->rowCount() > 0) {
				return $this->db->resultSet();
			}else{
				return false;
			}
		}

	}


?>