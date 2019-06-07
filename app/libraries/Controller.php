<?php  
	/*
	 * CLASSE CORE DO CONTROLLER
	 * 
	 * AQUI SERÁ CARREGADO OS MODELS E VIEWS.
	 */

	class Controller{
		// Load model
		public function model($model){
			// Require the file
			require_once '../app/models/' . $model . '.php';

			// Instance the model
			return new $model();
		}

		// Load view
		public function view($view, $data = []){
			// Check for view file
			if (file_exists('../app/views/' . $view . '.php')) {
				require_once '../app/views/' . $view . '.php';
			}else{
				die("Esta view não existe");
			}
		}
	}

?>