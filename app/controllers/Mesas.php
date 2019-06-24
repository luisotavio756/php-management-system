<?php  
	class Mesas extends Controller {

		public function __construct(){
			$this->userModel = $this->model('User');
			$this->mesaModel = $this->model('Mesa');
			$this->caixaModel = $this->model('Caixa');
			$this->produtoModel = $this->model('Produto');

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

			$this->gerenciar();
		
		}
		
		public function salao(){
			$mesas = $this->mesaModel->getMesas();

			$data = [
				'mesas' => $mesas,
				'comandas' => $this->getComandas(),
				'comandasMesa' => $this->getComandaMesa(),
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
					flash("mesas", "Não é possível excluir uma mesa que está em Uso !", "alert-danger");
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

		// COMANDAS
		public function addComanda() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'cliente' => (isset($_POST['cliente']) ? trim($_POST['cliente']) : ''),
					'whatsapp' => str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', trim($_POST['whatsapp']))))),
					'data_registro' => date('Y-m-d H:i:s'),
					'mesa' => $_POST['mesa'],
					'id_usuario' => $_SESSION['id_usuario'],
					'status' => 0,
				];

				// Validate all 
				if (isset($data['mesa']) && isset($data['id_usuario']) && isset($data['whatsapp'])) {
					//Validated
					if ($this->mesaModel->verifyDis($data['mesa']) == false) {
						// Load function register
						if ($this->mesaModel->addComanda($data)) {
							if ($this->mesaModel->setMesa($data['mesa'], 1)) {
								flash("salao", "Comanda adicionada com Sucesso !");
								redirect("/mesas/salao");									
							}else{
								flash("salao", "Não foi possível adicionar a Comanda, tente novamente mais tarde !", "alert-danger");
								redirect("/mesas/salao");
							}
							
						}else{
							flash("salao", "Não foi possível adicionar a Comanda !", "alert-danger");
							redirect("/mesas/salao");
						}
						
					}else{
						flash("salao", "Não foi possível adicionar a Comanda, a mesa escolhida não está disponível !", "alert-danger");
						redirect("/mesas/salao");
					}
					
				}else{
					flash("salao", "Não foi possível cadastrar a Comanda, verifique todos os campos !", "alert-danger");
					redirect("/mesas/salao");
				}

			}else{
				flash("salao", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/salao");
			}
		
		}

		public function getComandas() {
			$array = array();
			$row = $this->mesaModel->getComAll();

			foreach ($row as $key => $value) {
				$total = $this->mesaModel->getPedidoTotal($value->id);
				$array[$value->id] = $total[0]->total;
			}

			return $array;
		
		}

		public function getComandaMesa() {
			$array = array();
			$row = $this->mesaModel->getMesas();

			foreach ($row as $key => $value) {
				if ($value->status == 1) {
					$total = $this->mesaModel->getComandaMesa($value->id);
					$array[$value->id] = $total[0];		
				}
			}

			return $array;
		
		}

		public function adicionarPedido() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'id_comanda' => ($_POST['id_comanda']),
					'id_mesa' => ($_POST['id_mesa']),
					'pedidos' => ($_POST['pedidos']),
				];

				if (isset($data['id_comanda']) && isset($data['id_mesa']) && isset($data['pedidos'])) {
					$cont = 0;
					foreach ($data['pedidos'] as $key => $value) {
						$this->mesaModel->addPedido($data['id_comanda'], $key, $value);
						$estoque = $this->produtoModel->verifEstoque($key)[0];
						if ($estoque >= $value) {
							$this->produtoModel->updateEstoque($key, $value);
						}else{
							$this->produtoModel->updateEstoque($key, $estoque);
						}
					}

					flash("salao", "Pedido adicionado com Sucesso !");
					redirect("/mesas/salao");
					
				}else{
					flash("salao", "Não foi possível adicionar o pedido !", "alert-danger");
					redirect("/mesas/salao");
				}

			}else{
				flash("salao", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/salao");
			}
		
		}

		public function getPedido($id){
			$row = $this->mesaModel->getPedido($id);

			echo json_encode($row);
		
		}

		public function verPedido($id) {
			$pedido = $this->mesaModel->getPedido($id);

			$data = [
				'pedido' => $pedido
			];

			$this->view('mesas/pedido', $data);
		}

		public function alterPedido() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'pedidosAlter' => ($_POST['pedidosAlter']),
					'pedidosDel' => (isset($_POST['pedidosDel']) ? $_POST['pedidosDel'] : []),
				];

				if (isset($data['pedidosAlter']) && isset($data['pedidosDel'])) {

					foreach ($data['pedidosAlter'] as $key => $value) {
						$id_produto = $this->mesaModel->getEstoquePedido($key)[0]->id;
						$estoque = $this->mesaModel->getEstoquePedido($key)[0]->estoque;
						$quantidade = $this->mesaModel->getEstoquePedido($key)[0]->quantidade;
						$total = $value - $quantidade;
						$this->produtoModel->updateEstoque($id_produto, $total);
						$this->mesaModel->updatePedido($key, $value);
						// echo "<pre>";
						// echo "Id Produto: $id_produto<br>";
						// echo "Estoque Produto: $estoque<br>";
						// echo "Quantidade no Pedido: $quantidade<br>";
						// echo("Id do pedido: ".$key)."<br>";
						// echo("Nova Quantidade: ".($value - $quantidade))."<br>";
						// echo "Total: ". $total;
					}

					foreach ($data['pedidosDel'] as $key => $value) {
						$id = $this->mesaModel->getEstoquePedido($value)[0]->id;
						$quantidade = $this->mesaModel->getEstoquePedido($value)[0]->quantidade;
						$this->produtoModel->updateEstoque($id, (-$quantidade));
						$this->mesaModel->deletePedido($value);
					}

					flash("salao", "Pedido alterado com Sucesso !");
					redirect("/mesas/salao");
					
				}else{
					flash("salao", "Não foi possível alterar o pedido !", "alert-danger");
					redirect("/mesas/salao");
				}

			}else{
				flash("salao", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/salao");
			}
		
		}

		public function comandaTotal($id) {

		}

		public function fecharComanda() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'id_comanda' => ($_POST['id_comanda']),
					'id_mesa' => ($_POST['id_mesa']),
					'modo_pagamento' => $_POST['modo_pagamento'],
					'descricao' => 'Pagamento Comanda ' . $_POST['id_comanda'],
					'data_registro' => date('Y-m-d H:i:s'),
					'valor' => numberHelper(str_replace(",", ".", $_POST['total_comanda'])),
					'tipo' => 1,
				];

				if (isset($data['id_comanda']) && isset($data['id_mesa']) && isset($data['modo_pagamento']) && isset($data['descricao']) && isset($data['data_registro']) && isset($data['valor']) && isset($data['tipo'])) {
					if ($this->caixaModel->verifyOpen()) {
						$id_caixa = $this->caixaModel->idCaixa();
	

						if ($this->mesaModel->closeComanda($data['id_comanda'], $data['valor'])) {
							$this->mesaModel->setMesa($data['id_mesa'], 0);
							if ($this->caixaModel->movimentoCaixa($data, $id_caixa)) {
								flash("salao", "Comanda fechada e inserida no caixa com Sucesso !");
								redirect("/mesas/salao");
							}else{
								flash("salao", "Não foi possível fechar a comanda e adicionar ao caixa !", "alert-danger");
								redirect("/mesas/salao");
							}

						}else{
							flash("salao", "Não foi possível fechar a comanda !", "alert-danger");
							redirect("/mesas/salao");
						}
						
					}else{
						flash("salao", "Não foi possível fechar a comanda, você precisa ter um caixa aberto para concluir esta ação !", "alert-danger");
						redirect("/mesas/salao");
					}
					
					
				}else{
					flash("salao", "Não foi possível fechar a comandasss !", "alert-danger");
					redirect("/mesas/salao");
				}

			}else{
				flash("salao", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/salao");
			}
		
		}

		public function cancelarComanda() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'id_comanda' => ($_POST['id_comanda']),
					'id_mesa' => ($_POST['id_mesa']),
				];


				if (isset($data['id_comanda']) && isset($data['id_mesa'])) {
					$pedido = $this->mesaModel->getPedido($data['id_comanda']);
					// echo "<pre>";
					// print_r($pedido);

					if ($this->mesaModel->cancelarCom($data['id_comanda'])) {
						if ($this->mesaModel->setMesa($data['id_mesa'], 0)) {
							flash("salao", "Comanda Cancelada com Sucesso !");
							redirect("/mesas/salao");
						}else{
							flash("salao", "Não foi possível cancelar a comanda !", "alert-danger");
							redirect("/mesas/salao");
						}
					}else{
						flash("salao", "Não foi possível cancelar a comanda !", "alert-danger");
						redirect("/mesas/salao");
					}
					
				}else{
					flash("salao", "Não foi possível cancelar a comanda !", "alert-danger");
					redirect("/mesas/salao");
				}

			}else{
				flash("salao", "Ação Bloqueada !", "alert-danger");
				redirect("/mesas/salao");
			}
		
		}

		public function QRCode($id = 5) {
			// Para gerar um codigo qr para o usuario
			require_once '../app/libraries/Authenticator.php';
			$Authenticator = new Authenticator();
		    $secret = $Authenticator->generateRandomSecret();
		    $_SESSION['auth_secret'] = $secret;
			

			$qrCodeUrl = $Authenticator->getQR(URLROOT.'/mesas/comandas/', $id);

			echo '<img style="height: 100px;width: 100px;" class="img-fluid" src="'.$qrCodeUrl.'" alt="Verify this Google Authenticator">';
		
		}

		public function comandas($id) {
			echo "kkkkkkk";
		}

	
	}

?>