<?php  
	
	class Mesa {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function addMesa($data) {
			$this->db->query('INSERT INTO tb_mesas(num, descricao, data_registro, id_usuario, status) VALUES (:num, :descricao, :data_registro, :id_usuario, :status)');
			$this->db->bind(":num", $data['num']);
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
			$this->db->query("SELECT * FROM tb_mesas WHERE status = 1");
			

			if ($this->db->execute()) {
				return $this->db->resultSet();
			}else{
				return false;
			}
		}

		// public function verify($id) {
		// 	$this->db->query("SELECT * FROM tb_mesas WHER")
		// }

	}


?>