<?php  
	class Caixas extends Controller {

		public function __construct(){
			if (!isset($_SESSION['id_usuario'])) {
				redirect('/users/login');
			}
		}

		public function index(){
			// if (isLogged()) {
			// 	redirect('posts');
			// }

			$this->view('/caixa/dashboard');
		}

		
	}

?>