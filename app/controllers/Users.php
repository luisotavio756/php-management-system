<?php  
	class Users extends Controller{

		public function __construct(){
			
			$this->userModel = $this->model('User');
			$this->caixaModel = $this->model('Caixa');

		}

		public function index() {

			if (!isset($_SESSION['id_usuario'])) {
				redirect("/users/login");
			}else{
				if ($this->userModel->verifyUser($_SESSION['id_usuario']) == false) {
					redirect("/users/login");
				}
			}

			$users = $this->userModel->getUsers();

			$data = [
				'users' => $users
			];

			$this->view("/users/index", $data);
		}


		public function register(){
			// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// 	// Sanitize POST data
			// 	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			// 	// Init data
			// 	$data = [
			// 		'nome' => trim($_POST['nome']),
			// 		'sobrenome' => trim($_POST['sobrenome']),
			// 		'email' => trim($_POST['email']),
			// 		'password' => trim($_POST['senha']),
			// 		'confirm_password' => trim($_POST['confirm_senha']),
			// 		'name_err' => '',
			// 		'sobrenome_err' => '',
			// 		'email_err' => '',
			// 		'password_err' => '',
			// 		'confirm_password_err' => ''
			// 	];

			// 	// Validate name
			// 	if (empty($data['name'])) {
			// 		$data['name_err'] = 'Digite seu nome';
			// 	}

			// 	// Validate name
			// 	if (empty($data['sobrenome'])) {
			// 		$data['sobrenome_err'] = 'Digite seu sobrenome';
			// 	}

			// 	// Validate email
			// 	if (empty($data['email'])) {
			// 		$data['email_err'] = 'Digite seu email';
			// 	}else{
			// 		if ($this->userModel->findUserByEmail($data['email']) == true) {
			// 			$data['email_err'] = 'Este email já foi cadastrado';
			// 		}
			// 	}

			// 	// Validate password
			// 	if (empty($data['password'])) {
			// 		$data['password_err'] = 'Digite sua senha';
			// 	}elseif (strlen($data['password']) <= 6) {
			// 		$data['password_err'] = 'A senha deve ter no mínimo 6 caracteres';
			// 	}

			// 	// Validate confirm password
			// 	if (empty($data['confirm_password'])) {
			// 		$data['confirm_password_err'] = 'Digite a confirmação senha';
			// 	}elseif (strlen($data['confirm_password']) <= 6) {
			// 		$data['confirm_password_err'] = 'A senha deve ter no mínimo 6 caracteres';
			// 	}elseif ($data['password'] != $data['confirm_password']) {
			// 		$data['confirm_password_err'] = 'As senhas não coincidem !';
			// 	}

			// 	// Validade all 
			// 	if (empty($data['name_err']) && empty($data['sobrenome_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
			// 		//Validated

			// 		// Hash password
			// 		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

			// 		// Load function register
			// 		if ($this->userModel->registerUser($data)) {
			// 			flash("login", "Você foi  registrado");
			// 			redirect("/users/login");
			// 		}else{
			// 			flash("register", "Não foi possível cadastrar o Usuário !", "alert-danger");
			// 			redirect("/users/register");
			// 		}
					
			// 	}else{
			// 		// Load view errors
			// 		$this->view('/users/register', $data);
			// 	}

			// }else{
			// 	$data = [
			// 		'name' => '',
			// 		'sobrenome' => '',
			// 		'email' => '',
			// 		'password' => '',
			// 		'confirm_password' => '',
			// 		'name_err' => '',
			// 		'sobrenome_err' => '',
			// 		'email_err' => '',
			// 		'password_err' => '',
			// 		'confirm_password_err' => ''
			// 	];

			// 	// Load view
			// 	$this->view('/users/register', $data);
			// }
			$this->index();
		
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
					flash("login", 'Usuário não encontrado !', 'alert alert-danger');
					$data['email_err'] = ' ';
				}

				// Validade all 
				if (empty($data['email_err']) && empty($data['password_err'])) {
					// Check and set logged
					$loggedUser = $this->userModel->login($data['email'], $data['password']);

					if ($this->userModel->verifyUser($loggedUser->id)) {
						if ($loggedUser) {
							// Create sessions
							$this->createUserSession($loggedUser);
						}else{
							$data['email_err'] = ' ';
							$data['password_err'] = ' ';
							// Load view errors
							flash("login", 'Usuário ou senha Inválidos !', 'alert alert-danger');
							redirect('/users/login');
						}
					}else{
						// Load view errors
						flash("login", 'Usuário ou senha Inválidos !', 'alert alert-danger');
						redirect('/users/login');
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
			$_SESSION['nivel'] = $user->nivel;
			if ($this->caixaModel->verifyOpen()) {
				$_SESSION['id_caixa'] = $this->caixaModel->idCaixa();
			}

			redirect('/');
		
		}

		public function logout() {
			unset($_SESSION['id_usuario']);
			unset($_SESSION['nome']);
			unset($_SESSION['sobrenome']);
			unset($_SESSION['email']);
			unset($_SESSION['senha']);
			unset($_SESSION['nivel']);

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


				// Validate all 
				if (isset($data['nome']) && isset($data['sobrenome']) && isset($data['email']) && isset($data['password']) && isset($data['confirm_password']) && isset($data['nivel']) && isset($data['status'])) {
					//Validated
					if ($this->userModel->findUserByEmail($data['email']) == false) {
						if ($data['password'] === $data['confirm_password']) {
							if (strlen($data['password']) >= 6) {
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
								flash("users", "Não foi possível adicionar o Usuário, a senha deve ter no mínimo 6 caracteres !", "alert-danger");
								redirect("/users/");
							}
						}else{
							flash("users", "Não foi possível adicionar o Usuário, as senha não coincidem !", "alert-danger");
							redirect("/users/");
						}
					}else{
						flash("users", "Não foi possível adicionar o Usuário, este email já está sendo usado !", "alert-danger");
						redirect("/users/");
					}
					
				}else{
					// Load view errors
					flash("users", "Não foi possível adicionar o Usuário, verifique todos os campos !", "alert-danger");
					$this->view('/users/index');
				}

			}else{
				// Load view
				flash("users", "Ação Bloqueada !", "alert-danger");
				$this->view('/users/index');
			}
		
		}

		public function deleteUser($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($id != $_SESSION['id_usuario']) {
					if ($this->userModel->deleteUser($id)) {
						flash("users", "Usuário Excluido com Sucesso !");
						redirect("/users/");
					}else{
						flash("users", "Não foi possível excluir o Usuário !", "alert-danger");
						redirect("/users/");
					}
				}else{
					flash("users", "Você não pode excluir seu próprio Usuário !", "alert-danger");
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

				if (isset($data['nome']) && isset($data['sobrenome']) && isset($data['email']) && isset($data['nivel']) && isset($data['status'])) {
					if ($this->userModel->findUserByEmail($data['email']) == false) {
						if ($this->userModel->updateUser($id, $data)) {
							flash("users", "Usuário editado com Sucesso !");
							redirect("/users/");
						}else{
							flash("users", "Não foi possível editar o Usuário !", "alert-danger");
							redirect("/users/");
						}
					}else{
						flash("users", "Não foi possível editar o Usuário, este email já está sendo usado !", "alert-danger");
							redirect("/users/");
					}
				}

			}
		
		}
		
	}

?>