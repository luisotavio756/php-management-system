<?php  
	class Produtos extends Controller {

		public function __construct(){
			$this->userModel = $this->model('User');
			$this->produtoModel = $this->model('Produto');
			
			if (!isset($_SESSION['id_usuario'])) {
				redirect("/users/login");
			}else{
				if ($this->userModel->verifyUser($_SESSION['id_usuario']) == false) {
					redirect("/users/login");
				}
			}
		}

		public function index(){
			$produtos = $this->produtoModel->getProdutos();
			$categorias = $this->produtoModel->getCategorias();
			$data = [
				'produtos' => $produtos,
				'categorias' => $categorias,
				'id_usuario' => $_SESSION['id_usuario']
			];

			$this->view('/produtos/cadastrar/index', $data);
		}

		public function addProduto(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'descricao' => trim($_POST['descricao']),
					'categoria' => trim($_POST['categoria']),
					'valor' => numberHelper(str_replace(",", '.', $_POST['valor'])),
					'estoque' => trim($_POST['estoque']),
					'id_usuario' => $_SESSION['id_usuario'],
				];

				// Validade all 
				if (!empty($data['descricao']) && !empty($data['categoria']) && !empty($data['valor']) && !empty($data['estoque']) && !empty($data['id_usuario'])) {
					//Validated

					// Load function register
					if ($this->produtoModel->addProduto($data)) {
						flash("produtos", "Produto adicionado com Sucesso !");
						redirect("/produtos/");	
					}else{
						flash("produtos", "Não foi possível cadastrar o produto!", "alert-danger");
						redirect("/produtos/");
					}
					
				}else{
					// Load view errors
					$this->view('/produtos/');
				}

			}else{
				// Load view
				$this->view('/produtos/');
			}
		
		}

		public function alterProduto($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'id' => $id,
					'descricao' => trim($_POST['descricao']),
					'valor' => numberHelper(str_replace(",", '.', $_POST['valor'])),
					'estoque' => trim($_POST['estoque']),
					'categoria' => trim($_POST['categoria']),
				];

				// Validade all 
				if (!empty($data['descricao']) && !empty($data['categoria']) && !empty($data['valor']) && !empty($data['estoque'])) {
					//Validated

					// Load function register
					if ($this->produtoModel->updateProduto($data)) {
						flash("produtos", "Produto atualizado com Sucesso !");
						redirect("/produtos/");	
					}else{
						flash("produtos", "Não foi possível atualizar o produto 1!", "alert-danger");
						redirect("/produtos/");
					}
					
				}else{
					flash("produtos", "Não foi possível atualizar o produto!", "alert-danger");
					redirect("/produtos/");
				}

			}else{
				flash("produtos", "Ação Bloqueada !", "alert-danger");
				redirect("/produtos/");
			}
		}

		public function deleteProduto($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->produtoModel->deleteProduto($id)) {
					flash("produtos", "Produto Excluido com Sucesso !");
					redirect("/produtos/cadastrar/");
				}else{
					flash("produtos", "Não foi possível excluir o Produto, ele pode está sendo usado em algum pedido ativo ou um pedido passado !", "alert-danger");
					redirect("/produtos/cadastrar/");
				}

			}
		
		}

		public function categorias(){
			$categorias = $this->produtoModel->getCategorias();
			$data = [
				'categorias' => $categorias,
			];

			$this->view('/produtos/categorias/index', $data);
		
		}

		public function addCategoria(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'descricao' => trim($_POST['descricao']),
					'data' => date('Y-m-d H:m:s'),
				];

				// Validade all 
				if (!empty($data['descricao'])) {
					//Validated

					// Load function register
					if ($this->produtoModel->addCategoria($data)) {
						flash("categoria", "Categoria adicionada com Sucesso !");
						redirect("/produtos/categorias/index");
					}else{
						flash("categoria", "Não foi possível cadastrar a Categoria !", "alert-danger");
						redirect("/produtos/categorias/index");
					}
					
				}else{
					// Load view errors
					$this->view('/produtos/categorias/index');
				}

			}else{
				// Load view
				$this->view('/produtos/categorias/index');
			}
		
		}

		public function deleteCategoria($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->produtoModel->deleteCategoria($id)) {
					flash("categoria", "Categoria Excluida com Sucesso !");
					redirect("/produtos/categorias/");
				}else{
					flash("categoria", "Não foi possível excluir a Categoria, ela pode esta sendo usada em algum produto !", "alert-danger");
					redirect("/produtos/categorias/");
				}

			}
		
		}

		public function alterCategoria($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'id' => $id,
					'descricao' => trim($_POST['descricao']),
				];

				// Validade all 
				if (!empty($data['descricao']) && !empty($data['id'])) {
					//Validated

					// Load function register
					if ($this->produtoModel->alterCategoria($data)) {	
						flash("categoria", "Categoria atualizada com Sucesso !");
						redirect("/produtos/categorias/");
					}else{
						flash("categoria", "Não foi possível atualizar a Categoria!", "alert-danger");
						redirect("/produtos/categorias/");
					}
					
				}else{
					flash("categoria", "Não foi possível atualizar a Categoria 2 !", "alert-danger");
					// Load view errors
					$this->view('/produtos/categoria/index');
				}

			}else{
				// Load view
				flash("categoria", "Ação Bloqueada!", "alert-danger");
				$this->view('/produtos/categoria/index');
			}
		
		}
		
	}

?>