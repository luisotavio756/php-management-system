<?php  

	class Clientes extends Controller {
		
		public function __construct(){
			$this->mesaModel = $this->model('Mesa');

			
		}

		public function index($id) {
			$pedido = $this->mesaModel->getPedido($id);
			if ($this->mesaModel->getCom($id)) {
				if ($this->mesaModel->getCom($id)[0]->status == 0) {
					$status = 0;				
				}else{
					$status = 1;
				}
			}else{
				$status = 1;
			}

			$data = [
				'pedido' => $pedido,
				'status' => $status
			];

			$this->view('mesas/pedido', $data);	
		}
	}


?>