<?php  
	class Config {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function updateConfigs($id, $data) {
			$this->db->query("UPDATE tb_configuracoes SET email = :email, telefone = :telefone, instagram = :instagram, facebook = :facebook, whatsapp = :whatsapp, maps = :maps, endereco = :endereco, descricaoEmpresa = :descricao, debitarEstoque = :estoque WHERE id = :id");
			$this->db->bind(":id", $id);
			$this->db->bind(":email", $data['email']);
			$this->db->bind(":telefone", $data['telefone']);
			$this->db->bind(":instagram", $data['instagram']);
			$this->db->bind(":facebook", $data['facebook']);
			$this->db->bind(":whatsapp", $data['whatsapp']);
			$this->db->bind(":maps", $data['maps']);
			$this->db->bind(":endereco", $data['endereco']);
			$this->db->bind(":descricao", $data['descricao']);
			$this->db->bind(":estoque", $data['estoque']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
			
		}

		public function getConfigs() {
			$this->db->query("SELECT * FROM tb_configuracoes WHERE id = 1");

			if ($this->db->execute()) {
				return $this->db->singleSet();
			}else{
				return false;
			}
		}
		
		public function setVotos($tipo) {
			if ($tipo == 1) {
				$this->db->query("UPDATE tb_configuracoes SET votosSim = votosSim + 1 WHERE id = 1");
			}elseif ($tipo == 2) {
				$this->db->query("UPDATE tb_configuracoes SET votosNao = votosNao + 1 WHERE id = 1");
			}

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
			
		}

		public function getDebEstoque() {
			$this->db->query("SELECT debitarEstoque FROM tb_configuracoes WHERE id = 1");

			if ($this->db->execute()) {
				return $this->db->singleSet();
			}else{
				return false;
			}
		}

		public function getVotosSim() {
			$this->db->query("SELECT votosSim FROM tb_configuracoes WHERE id = 1");

			if ($this->db->execute()) {
				return $this->db->singleSet()->votosSim;
			}
		}

		public function getVotosNao() {
			$this->db->query("SELECT votosNao FROM tb_configuracoes WHERE id = 1");

			if ($this->db->execute()) {
				return $this->db->singleSet()->votosNao;
			}
		}

	}




?>