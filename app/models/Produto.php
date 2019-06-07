<?php  
	
	class Produto {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getCategorias(){
			$this->db->query("SELECT * FROM tb_categorias");

			if ($this->db->execute()) {
				return $this->db->resultSet();
			}
			
		}

		public function addCategoria($data){
			$this->db->query("INSERT INTO tb_categorias(descricao, data_registro) VALUES (:descricao, :data)");
			$this->db->bind(":descricao", $data['descricao']);
			$this->db->bind(":data",  $data['descricao']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function getProdutos(){
			$this->db->query("SELECT p.id AS id_produto, p.cod, p.descricao, p.valor, p.estoque, p.data_registro, u.nome, c.id AS id_categoria, c.descricao AS descricao_categoria FROM tb_produtos AS p JOIN tb_categorias AS c ON p.id_categoria = c.id JOIN tb_usuarios AS u ON u.id = p.id_usuario");

			if ($this->db->execute()) {
				return $this->db->resultSet();
			}
		}

		public function addProduto($data){
			$this->db->query("INSERT INTO tb_produtos(cod, descricao, valor, estoque, data_registro, id_categoria, id_usuario) VALUES (:cod, :descricao, :valor, :estoque, :data_registro, :id_categoria, :id_usuario)");
			$this->db->bind(":cod", $data['cod']);
			$this->db->bind(":descricao", $data['descricao']);
			$this->db->bind(":valor", $data['valor']);
			$this->db->bind(":estoque", $data['estoque']);
			$this->db->bind(":data_registro", date('Y-m-d H:i:s'));
			$this->db->bind(":id_categoria", $data['categoria']);
			$this->db->bind(":id_usuario", $data['id_usuario']);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteProduto($id){
			$this->db->query("DELETE FROM tb_produtos WHERE id = :id");
			$this->db->bind(":id", $id);

			if ($this->db->execute()) {
				return true;
			}else{
				return false;
			}
		}

	}


?>