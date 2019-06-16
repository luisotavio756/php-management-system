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
		
		public function salao(){
			$mesas = $this->mesaModel->getMesas();

			$data = [
				'mesas' => $mesas
			];

			$this->view('mesas/salao', $data);
		
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
					'id' => ($_POST['num']),
					'descricao' => 'Mesa '.$_POST['num'],
					'data_registro' => date('Y-m-d H:m:s'),
					'id_usuario' => $_SESSION['id_usuario'],
					'status' => 0,
				];

				// Validade all 
				if (isset($data['id']) && isset($data['descricao']) && isset($data['id_usuario'])) {
					//Validated

					if ($this->mesaModel->verify($data['id']) == false) {
						// Load function register
						if ($this->mesaModel->addMesa($data)) {
							flash("mesas", "Mesa adicionada com Sucesso !");
							redirect("/mesas/");
						}else{
							flash("mesas", "Não foi possível cadastrar a Mesa !", "alert-danger");
							redirect("/mesas");
						}
					}else{
						flash("mesas", "Não foi possível cadastrar a Mesa, já existe uma mesa com este código !", "alert-danger");
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

		public function alterMesa($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'id' => $id,
					'new_id' => ($_POST['num']),
					'descricao' => 'Mesa '.$_POST['num'],
				];

				// Validade all 
				if (isset($data['id']) && isset($data['descricao']) && isset($data['new_id'])) {
					//Validated
					if ($data['id'] == $data['new_id']) {
						// Load function register
						if ($this->mesaModel->update($data)) {
							flash("mesas", "Mesa alterarada com Sucesso !");
							redirect("/mesas/");
						}else{
							flash("mesas", "Não foi possível alterar a Mesa !", "alert-danger");
							redirect("/mesas");
						}
					}elseif ($data['id'] != $data['new_id']) {
						if ($this->mesaModel->verify($data['new_id']) == false) {
							// Load function register
							if ($this->mesaModel->update($data)) {
								flash("mesas", "Mesa alterarada com Sucesso !");
								redirect("/mesas/");
							}else{
								flash("mesas", "Não foi possível alterar a Mesa !", "alert-danger");
								redirect("/mesas");
							}
						}else{
							flash("mesas", "Não foi possível alterar a Mesa, já existe uma mesa com este código !", "alert-danger");
							redirect("/mesas");
						}
					}else{
						flash("mesas", "Não foi possível alterar a Mesa !", "alert-danger");
						redirect("/mesas");
					}
					
				}else{
					flash("mesas", "Não foi possível alterar a Mesa, verifique todos os campos !", "alert-danger");
					redirect("/mesas");
				}

			}else{
				flash("mesas", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas");
			}
		
		}

		public function deleteMesa($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->mesaModel->verifyDis($id) == false) {
					if ($this->mesaModel->delete($id)) {
						flash("mesas", "Mesa Excluida com Sucesso !");
						redirect("/mesas/");
					}else{
						flash("mesas", "Não foi possível excluir a Mesa !", "alert-danger");
						redirect("/mesas/");
					}
				}else{
					flash("mesas", "Não foi possível excluir uma mesa que está em Uso !", "alert-danger");
					redirect("/mesas/");
				}

			}else{
				flash("mesas", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/");
			}
		
		}

		public function getProdutos($query) {

			$row = $this->mesaModel->getProdutos(strtolower($query));

			echo json_encode($row);
		}
	
	}

?>