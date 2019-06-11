<?php  
	class Mesas extends Controller {

		public function __construct(){
			if (!isset($_SESSION['id_usuario'])) {
				redirect('/users/login');
			}

			$this->mesaModel = $this->model('Mesa');

		}

		public function index(){
			// if (isLogged()) {
			// 	redirect('posts');
			// }

			$this->gerenciar();
		}
		
		public function gerenciar(){
			$mesas = $this->mesaModel->getMesas();

			$data = [
				'mesas' => $mesas
			];

			$this->view('mesas/index', $data);
		}

		public function add(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'num' => ($_POST['num']),
					'descricao' => trim($_POST['descricao']),
					'data_registro' => date('Y-m-d H:m:s'),
					'id_usuario' => $_SESSION['id_usuario'],
					'status' => 1,
				];

				// Validade all 
				if (isset($data['num']) && isset($data['descricao']) && isset($data['id_usuario'])) {
					//Validated

					// Load function register
					if ($this->mesaModel->addMesa($data)) {
						flash("mesas", "Mesa adicionada com Sucesso !");
						redirect("/mesas/");
					}else{
						flash("mesas", "Não foi possível cadastrar a Mesa !", "alert-danger");
						redirect("/mesas");
					}
					
				}else{
					flash("mesas", "Não foi possível cadastrar a Mesa, verifique todos os campos !", "alert-danger");
					redirect("/mesas");
				}

			}else{
				flash("mesas", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas");
			}
		
		}

		public function deleteMesa($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->mesaModel->delete($id)) {
					flash("mesas", "Mesa Excluida com Sucesso !");
					redirect("/mesas/");
				}else{
					flash("mesas", "Não foi possível excluir a Mesa !", "alert-danger");
					redirect("/mesas/");
				}

			}else{
				flash("mesas", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/");
			}
		}

		
	}

?>