<?php  
	class Pages extends Controller {

		public function __construct(){
			$this->userModel = $this->model('User');
			
			if (!isset($_SESSION['id_usuario'])) {
				redirect("/users/login");
			}else{
				if ($this->userModel->verifyUser($_SESSION['id_usuario']) == false) {
					redirect("/users/login");
				}
			}
		}

		public function index(){
			// if (isLogged()) {
			// 	redirect('posts');
			// }

			$data = [
					'title' => 'Aplicação Padrão MVC',
					'descricao' => 'Descrição do Site'
			];

			$this->view('pages/index', $data);
		}
		
		public function about(){
			$data = [
					'title' => 'Sobre',
					'descricao' => 'Descrição do Site'
			];

			$this->view('pages/about', $data);
		}

		
	}

?>