<?php  
	class Users extends Controller{

		public function __construct(){
			// if (!isset($_SESSION['id_usuario'])) {
			// 	$this->logout();
			// }

			$this->userModel = $this->model('User');
		}

		public function index() {
			$users = $this->userModel->getUsers();

			$data = [
				'users' => $users
			];

			$this->view("/users/index", $data);
		}


		public function register(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'name' => trim($_POST['nome']),
					'sobrenome' => trim($_POST['sobrenome']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['senha']),
					'confirm_password' => trim($_POST['confirm_senha']),
					'name_err' => '',
					'sobrenome_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => ''
				];

				// Validate name
				if (empty($data['name'])) {
					$data['name_err'] = 'Digite seu nome';
				}

				// Validate name
				if (empty($data['sobrenome'])) {
					$data['sobrenome_err'] = 'Digite seu sobrenome';
				}

				// Validate email
				if (empty($data['email'])) {
					$data['email_err'] = 'Digite seu email';
				}else{
					if ($this->userModel->findUserByEmail($data['email']) == true) {
						$data['email_err'] = 'Este email já foi cadastrado';
					}
				}

				// Validate password
				if (empty($data['password'])) {
					$data['password_err'] = 'Digite sua senha';
				}elseif (strlen($data['password']) <= 6) {
					$data['password_err'] = 'A senha deve ter no mínimo 6 caracteres';
				}

				// Validate confirm password
				if (empty($data['confirm_password'])) {
					$data['confirm_password_err'] = 'Digite a confirmação senha';
				}elseif (strlen($data['confirm_password']) <= 6) {
					$data['confirm_password_err'] = 'A senha deve ter no mínimo 6 caracteres';
				}elseif ($data['password'] != $data['confirm_password']) {
					$data['confirm_password_err'] = 'As senhas não coincidem !';
				}

				// Validade all 
				if (empty($data['name_err']) && empty($data['sobrenome_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
					//Validated

					// Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Load function register
					if ($this->userModel->registerUser($data)) {
						flash("login", "Você foi  registrado");
						redirect("/users/login");
					}else{
						flash("register", "Não foi possível cadastrar o Usuário !", "alert-danger");
						redirect("/users/register");
					}
					
				}else{
					// Load view errors
					$this->view('/users/register', $data);
				}

			}else{
				$data = [
					'name' => '',
					'sobrenome' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_err' => '',
					'sobrenome_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => ''
				];

				// Load view
				$this->view('/users/register', $data);
			}
		}

		public function login(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['senha']),
					'email_err' => '',
					'password_err' => '',
				];

				// Validate email
				if (empty($data['email'])) {
					$data['email_err'] = 'Digite seu email';
				}

				// Validate password
				if (empty($data['password'])) {
					$data['password_err'] = 'Digite sua senha';
				}

				// Check user/email
				if ($this->userModel->findUserByEmail($data['email'])) {
					# code...
				}else{
					// User not found
					flash("not_found", 'Usuário não encontrado !', 'alert alert-danger');
					$data['email_err'] = ' ';
				}

				// Validade all 
				if (empty($data['email_err']) && empty($data['password_err'])) {
					// Check and set logged
					$loggedUser = $this->userModel->login($data['email'], $data['password']);

					if ($loggedUser) {
						// Create sessions
						$this->createUserSession($loggedUser);
					}else{
						$data['email_err'] = ' ';
						$data['password_err'] = ' ';
						flash("not_found", 'Usuário ou senha Inválidos !', 'alert alert-danger');
						$this->view('/users/login', $data);
					}
				}else{
					// Load view errors
					$this->view('/users/login', $data);
				}

			}else{
				$data = [
					'email' => '',
					'password' => '',
					'email_err' => '',
					'password_err' => '',
				];

				// Load view
				$this->view('/users/login', $data);
			}
		}

		public function createUserSession($user) {
			$_SESSION['id_usuario'] = $user->id;
			$_SESSION['nome'] = $user->nome;
			$_SESSION['sobrenome'] = $user->sobrenome;
			$_SESSION['email'] = $user->email;
			$_SESSION['senha'] = $user->senha;
			// $_SESSION['data_registro'] = $user->data_registro;

			redirect('/');
		}

		// Logout user
		public function logout() {
			unset($_SESSION['id_usuario']);
			unset($_SESSION['nome']);
			unset($_SESSION['sobrenome']);
			unset($_SESSION['email']);
			unset($_SESSION['senha']);

			session_destroy();
			redirect("/users/login");
		
		}

		public function addUser(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'nome' => trim($_POST['nome']),
					'sobrenome' => trim($_POST['sobrenome']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['senha']),
					'confirm_password' => trim($_POST['confirm_senha']),
					'nivel' => trim($_POST['nivel']),
					'status' => trim($_POST['status']),
				];

				// // Validate confirm password
				// if (empty($data['confirm_password'])) {
				// 	$data['confirm_password_err'] = 'Digite a confirmação senha';
				// }elseif (strlen($data['confirm_password']) <= 6) {
				// 	$data['confirm_password_err'] = 'A senha deve ter no mínimo 6 caracteres';
				// }elseif ($data['password'] != $data['confirm_password']) {
				// 	$data['confirm_password_err'] = 'As senhas não coincidem !';
				// }

				// Validade all 
				if (!empty($data['nome']) && !empty($data['sobrenome']) && !empty($data['email']) && !empty($data['password']) && !empty($data['nivel']) && isset($data['status'])) {
					//Validated

					// Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Load function register
					if ($this->userModel->registerUser($data)) {
						flash("users", "Usuário adicionado com sucesso !");
						redirect("/users/");
					}else{
						flash("users", "Não foi possível adicionar o Usuário !", "alert-danger");
						redirect("/users/");
					}
					
				}else{
					// Load view errors
					echo "<pre>";
					print_r($data);
					die("Erro");
					$this->view('/users/index');
				}

			}else{
				// Load view
				$this->view('/users/index');
			}

			// $password = password_hash($data['senha'], PASSWORD_DEFAULT);

			
		}

		public function deleteUser($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->userModel->deleteUser($id)) {
					flash("users", "Usuário Excluido com Sucesso !");
					redirect("/users/");
				}else{
					flash("users", "Não foi possível excluir o Usuário !", "alert-danger");
					redirect("/users/");
				}

			}
		
		}

		public function updateUser($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'nome' => trim($_POST['nome']),
					'sobrenome' => trim($_POST['sobrenome']),
					'email' => trim($_POST['email']),
					'nivel' => trim($_POST['nivel']),
					'status' => trim($_POST['status']),
				];

				if ($this->userModel->updateUser($id, $data)) {
					flash("users", "Usuário editado com Sucesso !");
					redirect("/users/");
				}else{
					flash("users", "Não foi possível editado o Usuário !", "alert-danger");
					redirect("/users/");
				}

			}
		
		}
		
	}

?>