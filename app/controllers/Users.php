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
			$_SESSION['img'] = $user->img;
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
					'img' => 'masculino.png',
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
							flash("users", "Não foi possível adicionar o Usuário, as senhas não coincidem !", "alert-danger");
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
					if ($this->userModel->findUserByEmail($data['email']) == false OR $data['email'] == $this->userModel->getUser($id)->email) {
						if ($this->userModel->updateUser($id, $data)) {
							if ($_POST['acao'] == 'perfil') {
								$_SESSION['nome'] = $data['nome'];
								flash("perfil", "Dados Pessoais editados com Sucesso !");
								redirect("/users/perfil");
							}else{
								flash("users", "Usuário editado com Sucesso !");
								redirect("/users/");
							}
						}else{
							if ($_POST['acao'] == 'perfil') {
								flash("perfil", "Não foi possível editar os Dados Pessoais !", "alert-danger");
								redirect("/users/perfil");
							}else{
								flash("users", "Não foi possível editar o Usuário !", "alert-danger");
								redirect("/users/");
							}
						}
					}else{
						if ($_POST['acao'] == 'perfil') {
							flash("perfil", "Não foi possível editar os dados do Usuário, este email já está sendo usado !", "alert-danger");
							redirect("/users/perfil");
						}else{
							flash("users", "Não foi possível editar o Usuário, este email já está sendo usado !", "alert-danger");
							redirect("/users/");
						}
						
					}
				}else{
					if ($_POST['acao'] == 'perfil') {
						flash("perfil", "Não foi possível editar os dados do Usuário2232323, este email já está sendo usado !", "alert-danger");
						redirect("/users/perfil");
					}else{
						flash("users", "Não foi possível editar o Usuário, verifique todos os campos !", "alert-danger");
						redirect("/users/");
					}
				}
				// echo "<pre>";
				// print_r($data);

			}
		
		}

		public function updateSenha($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'senha' => trim($_POST['senha']),
					'new_senha' => trim($_POST['new_senha']),
					'confirm_new_senha' => trim($_POST['confirm_new_senha']),
				];

				if (isset($data['senha']) && isset($data['new_senha']) && isset($data['confirm_new_senha'])){
					$senha_atual = $this->userModel->getUser($id)->senha;
					if (password_verify($data['senha'], $senha_atual)) {
						if (strlen($data['new_senha']) >= 6 && strlen($data['confirm_new_senha']) >= 6) {
							if ($data['new_senha'] === $data['confirm_new_senha']) {
								$senha = password_hash($data['new_senha'], PASSWORD_DEFAULT);
								if ($this->userModel->updateSenha($id, $senha)) {
									flash("perfil", "Senha atualizada com sucesso !");
									redirect("/users/perfil");
								}else{
									flash("perfil", "Não foi possível alterar a senha !", "alert-danger");
									redirect("/users/perfil");
								}
							}else{
								flash("perfil", "Não foi possível alterar a senha, as novas senhas não coincidem !", "alert-danger");
								redirect("/users/perfil");
							}
						}else{
							flash("perfil", "Não foi possível alterar a senha, as senhas devem ter no mínimo 6 caracteres!", "alert-danger");
							redirect("/users/perfil");
						}
					}else{
						flash("perfil", "Não foi possível alterar a senha, a senha que você digitou não coincide com a senha atual !", "alert-danger");
						redirect("/users/perfil");
					}

				}else{
					flash("perfil", "Não foi possível alterar a senha, verfifique todos os campos !", "alert-danger");
					redirect("/users/perfil");
				}
				// echo "<pre>";
				// print_r($data);

			}
		
		}

		public function updateImg($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'imagem' => trim($_POST['imagem']),
				];

				if (isset($data['imagem'])){
					
					if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {
						$nometemporario = $_FILES['imagem']['tmp_name'];
	
						$nome = $_FILES['imagem']['name'];
						$extensao = pathinfo($nome, PATHINFO_EXTENSION);
						$extensao = strtolower($extensao);
	
						if (strstr('.jpg;.jpeg', $extensao)) {
							$uploaddir = 'img/users/';
							$uploadfile = $uploaddir . 'perfil'.$_SESSION['id_usuario'].'.jpg';

							if (move_uploaded_file($nometemporario, $uploadfile)) {
								$this->userModel->updateImg($id, 'perfil'.$_SESSION['id_usuario'].'.jpg');
								$_SESSION['img'] = 'perfil'.$_SESSION['id_usuario'].'.jpg';
							    flash("perfil", "Foto atualizada com Sucesso !");
								redirect("/users/perfil");
							} else {
							    flash("perfil", "Não foi possível alterar a foto !", "alert-danger");
								redirect("/users/perfil");
							
							}
						}
						else{
							flash("perfil", "Não foi possível alterar a foto !", "alert-danger");
							redirect("/users/perfil");
						}
					}
					else{
						flash("perfil", "Não foi possível alterar a foto !", "alert-danger");
						redirect("/users/perfil");
						
					}
					

					// echo 'Aqui está mais informações de debug:';
					// print_r($_FILES);

				}else{
					flash("perfil", "Não foi possível alterar a senha, verfifique todos os campos !", "alert-danger");
					redirect("/users/perfil");
				}


			}
		}

		public function perfil() {
			$id_usuario = $_SESSION['id_usuario'];
			$user = $this->userModel->getUser($id_usuario);

			$data = [
				'user' => $user
			];

			$this->view('users/perfil', $data);
		}
		
	}

?>