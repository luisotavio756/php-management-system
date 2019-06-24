<?php  
	class Pages extends Controller {

		public function __construct(){
			$this->userModel = $this->model('User');
			$this->mesaModel = $this->model('Mesa');
			if (!isset($_SESSION['id_usuario'])) {
				redirect("/users/login");
			}else{
				if ($this->userModel->verifyUser($_SESSION['id_usuario']) == false) {
					redirect("/users/login");
				}
			}
		}

		public function index(){
			$comandas = $this->mesaModel->getComAll();
			$comandasCloses = $this->mesaModel->getComCloses();

			$data = [
					'comandas' => $comandas,
					'comandasClose' => $comandasCloses,
					'pedidosPendentes' => $this->getPedidosAll(),
					'clientes' => $this->mesaModel->getCurrentesCom()
			];

			$this->view('pages/index', $data);
		}

		public function getPedidosAll(){
			$comandas = $this->mesaModel->getComAll();
			$cont = 0;
			foreach ($comandas as $key => $value) {
				$pedidos = $this->mesaModel->getPedido($value->id);
				if ($pedidos) {
					$cont += count($pedidos);
				}
			}

			return $cont;
		}
		

		
	}

?>