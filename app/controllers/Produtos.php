<?php  
	class Produtos extends Controller {

		public function __construct(){
			if (!isset($_SESSION['id_usuario'])) {
				
				redirect('/users/login');
			}

			$this->produtoModel = $this->model('Produto');
			
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
					'cod' => trim($_POST['cod']),
					'descricao' => trim($_POST['descricao']),
					'categoria' => trim($_POST['categoria']),
					'valor' => trim($_POST['valor']),
					'estoque' => trim($_POST['estoque']),
					'id_usuario' => $_SESSION['id_usuario'],
				];

				// Validade all 
				if (!empty($data['cod']) && !empty($data['descricao']) && !empty($data['categoria']) && !empty($data['valor']) && !empty($data['estoque']) && !empty($data['id_usuario'])) {
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

		public function alterProduto(){
	
		}

		public function deleteProduto(){
	
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


		
		

		
	}

?>