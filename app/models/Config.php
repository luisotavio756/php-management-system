<?php  
	class Config {
		private $db;

		public function __construct() {
			$this->db = new Database;
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

	}




?>