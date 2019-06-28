<?php  

	class Configuracoes extends Controller {
		
		public function __construct(){
			$this->mesaModel = $this->model('Mesa');
			$this->configModel = $this->model('Config');
			
		}

		public function index($id = '') {
			// $pedido = $this->mesaModel->getPedido($id);
		

			$data = [
				'configs' => $this->configModel->getConfigs(),
			];

			$this->view('configuracoes/index', $data);	
		}

		public function update($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'email' => (isset($_POST['email']) ? $_POST['email'] : ''),
					'telefone' => (isset($_POST['telefone']) ? $_POST['telefone'] : ''),
					'instagram' => (isset($_POST['instagram']) ? $_POST['instagram'] : ''),
					'facebook' => (isset($_POST['facebook']) ? $_POST['facebook'] : ''),
					'whatsapp' => str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', trim(isset($_POST['whatsapp']) ? trim($_POST['whatsapp']) : ''))))),
					'maps' => (isset($_POST['maps']) ? $_POST['maps'] : ''),
					'endereco' => (isset($_POST['endereco']) ? $_POST['endereco'] : ''),
					'estoque' => (isset($_POST['estoque']) && $_POST['estoque'] == 'on' ? 1 : 0),
					'descricao' => (isset($_POST['descricao']) ? $_POST['descricao'] : ''),
				];

				// Validade all 
				if (isset($data['email']) && isset($data['telefone']) && isset($data['instagram']) && isset($data['facebook']) && isset($data['whatsapp']) && isset($data['maps']) && isset($data['descricao']) && isset($data['estoque'])) {
					if ($this->configModel->updateConfigs($id, $data)) {
						flash("configs", "Dados atualizados com sucesso !");
						redirect("/configuracoes/");
					}else{
						flash("configs", "Não foi possível atualizar os dados !", "alert-danger");
						redirect("/configuracoes/");
					}
						// echo "<pre>";
						// print_r($_POST);

					
				}else{
					flash("configs", "Não foi possível atualizar os dados, verifique todos os campos !", "alert-danger");
					redirect("/configuracoes/");
				}

			}else{
				flash("configs", "Ação Bloqueada !", "alert-danger");
				redirect("/configuracoes/");
			}
		}

	}


?>