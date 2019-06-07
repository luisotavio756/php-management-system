<?php  
	
	class User {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		// Register user
		public function registerUser($data) {
			$this->db->query("INSERT INTO tb_usuarios(nome, sobrenome, email, senha, nivel, status) VALUES (:nome, :sobrenome, :email, :senha, :nivel, :status)");

			//Bind values
			$this->db->bind(":nome", $data['nome']);
			$this->db->bind(":sobrenome", $data['sobrenome']);
			$this->db->bind(":email", $data['email']);
			$this->db->bind(":senha", $data['password']);
			$this->db->bind(":nivel", ($data['nivel'] ? $data['nivel'] : 1 ));
			$this->db->bind(":status", ($data['status'] ? $data['status'] : 1 ));

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteUser($id){
			$this->db->query("DELETE FROM tb_usuarios WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		// Find user by email
		public function findUserByEmail($email) {
			$this->db->query("SELECT * FROM tb_usuarios WHERE email = :email");
			$this->db->bind(':email', $email);

			$this->db->singleSet();

			// Check row
			if ($this->db->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		// Login user
		public function login($email, $password) {
			$this->db->query("SELECT * FROM tb_usuarios WHERE email = :email");
			$this->db->bind(":email", $email);

			$row = $this->db->singleSet();

			$hash_pass = $row->senha;

			if (password_verify($password, $hash_pass)) {
				// User logged
				return $row;
			}else{
				return false;
			}
		
		}

		public function getUsers(){
			$this->db->query("SELECT * FROM tb_usuarios");

			if ($this->db->execute()) {
				return $this->db->resultSet();
			}
		
		}

		public function getUser($id){
			$this->db->query("SELECT * FROM tb_usuarios WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return $this->db->singleSet();
			}
		
		}

		public function updateUser($id, $data){
			$this->db->query("UPDATE tb_usuarios SET nome = :nome, sobrenome = :sobrenome, email = :email, nivel = :nivel, status = :status WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->bind(":nome", $data['nome']);
			$this->db->bind(":sobrenome", $data['sobrenome']);
			$this->db->bind(":email", $data['email']);
			$this->db->bind(":nivel", $data['nivel']);
			$this->db->bind(":status", $data['status']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

	}


?>