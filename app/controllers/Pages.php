<?php  
	class Pages extends Controller {

		public function __construct(){
			if (!isset($_SESSION['id_usuario'])) {
				redirect('/users/login');
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