<?php  
	class Caixas extends Controller {

		public function __construct(){
			if (!isset($_SESSION['id_usuario'])) {
				redirect('/users/login');
			}

			$this->caixaModel = $this->model('Caixa');
		}

		public function index(){
			$data = [
				'receitas' => $this->getReceitas(),
				'despesas' => $this->getDespesas(),
				'saldo_inicial' => $this->getSaldoInicial(),
				'saldo_final' => $this->getSaldo(),
				'movimentos' => $this->caixaModel->getMovimentos($this->caixaModel->idCaixa()),
				'caixas' => $this->caixaModel->getCaixas(),
				// 'm' => $this->getMovimentos(39),
			];

			$this->view('/caixas/dashboard', $data);
		
		}

		public function openCaixa(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'saldo_inicial' => numberHelper(str_replace(',', '.', $_POST['saldoInicial'])),
					'data_aberto' => date('Y-m-d H:i:s'),
					'id_usuario' => $_SESSION['id_usuario'],
				];


				if (isset($data['id_usuario']) && isset($data['saldo_inicial'])) {

					if ($this->caixaModel->verifyOpen() == false) {

						if ($this->caixaModel->open($data)) {
							flash("caixa", "Novo Caixa aberto com Sucesso !");
							$id_caixa = $this->caixaModel->idCaixa();
							$this->createSessionCaixa($id_caixa);

						}else{
							flash("caixa", "Não foi possível abrir um Novo Caixa !", "alert-danger");
							redirect("/caixas/");
						}
					}else{
						flash("caixa", "Não foi possível abrir um Novo Caixa !", "alert-danger");
						redirect("/caixas/");
					}
				}

			}else{
				flash("caixa", "Não foi possível abrir um Novo Caixa !", "alert-danger");
				redirect("/caixas/");
			}
		
		}

		public function closeCaixa(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->getSaldo() >= 0) {
					if ($this->caixaModel->verifyOpen()) {
						$id_caixa = $this->caixaModel->idCaixa();
						$saldo = $this->getSaldo();
						if ($this->caixaModel->close($id_caixa, $saldo)) {
							// $this->pdf($id_caixa);
							$this->deleteSessionCaixa();	
							flash("caixa", "Caixa fechado com Sucesso !");
							redirect("/caixas/");
						}else{
							flash("caixa", "Não foi possível fechar o caixa, tente mais tarde !", "alert-danger");
							redirect("/caixas/");
						}
					}else{
						flash("caixa", "Não existe caixa a ser fechado !", "alert-danger");
						redirect("/caixas/");
					}
				}else{
					flash("caixa", "Você não pode fechar um caixa com Saldo negativo !", "alert-danger");
					redirect("/caixas/");
				}

				

			}else{
				flash("caixa", "Ação Bloqueada !", "alert-danger");
				redirect("/caixas/");
			}
		
		}

		public function insertReceita(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				if ($_POST['action'] == 1) {
					// Init data
					$data = [
						'descricao' => trim($_POST['descricao']),
						'data_registro' => date('Y-m-d H:i:s'),
						'valor' => numberHelper(str_replace(",", ".", $_POST['valor'])),
						'tipo' => 1,
						'action' => ($_POST['action']),
						'modo_pagamento' => ($_POST['modo_pagamento'])
					];

					if (isset($data['descricao']) && isset($data['data_registro']) && isset($data['valor']) && isset($data['action']) && isset($data['modo_pagamento'])) {
						if ($this->caixaModel->verifyOpen() == true) {
							$id_caixa = $this->caixaModel->idCaixa();

							if ($this->caixaModel->movimentoCaixa($data, $id_caixa)) {
								flash("caixa", "Receita inserida com Sucesso !");
								redirect("/caixas/");
							}else{
								flash("caixa", "Não foi possível adicionar a receita !", "alert-danger");
								redirect("/caixas/");
							}
						}else{
							flash("caixa", "Não foi possível adicionar a receita, não existe um caixa aberto !", "alert-danger");
							redirect("/caixas/");
						}			
					}
				}elseif ($_POST['action'] == 2) {
					echo "<pre>";
					print_r($_POST);
				}
				


			}else{
				flash("caixa", "Ação Bloqueada !", "alert-danger");
				redirect("/caixas/");
			}
		
		}

		public function insertDespesa(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'descricao' => trim($_POST['descricao']),
					'data_registro' => date('Y-m-d H:i:s'),
					'valor' => numberHelper(str_replace(",", ".", $_POST['valor'])),
					'tipo' => 2,
					'modo_pagamento' => ($_POST['modo_pagamento'])
				];


				if (isset($data['descricao']) && isset($data['data_registro']) && isset($data['valor'])) {
					if ($data['valor'] <= $this->getSaldo()) {
						if ($this->caixaModel->verifyOpen() == true) {
							$id_caixa = $this->caixaModel->idCaixa();

							if ($this->caixaModel->movimentoCaixa($data, $id_caixa)) {
								flash("caixa", "Despesa inserida com Sucesso !");
								redirect("/caixas/");
							}else{
								flash("caixa", "Não foi possível adicionar a Despesa !", "alert-danger");
								redirect("/caixas/");
							}
						}else{
							flash("caixa", "Não foi possível adicionar a Despesa, não existe um caixa aberto !", "alert-danger");
							redirect("/caixas/");
						}

					}else{
						flash("caixa", "Ops.. Seu Saldo é Insuficiente para esta Despesa.", "alert-danger");
						redirect("/caixas/");
					}
				}

			}else{
				flash("caixa", "Ação Bloqueada !", "alert-danger");
				redirect("/caixas/");
			}
		
		}

		public function getReceitas(){
			if ($this->caixaModel->idCaixa()) {
				$id_caixa = $this->caixaModel->idCaixa();
				$movimento = $this->caixaModel->consultarMovimentos(1, $id_caixa);
				$movimento == null ? $movimento = 0.00 : $movimento = $movimento;
			}else{
				$movimento = 0.00;
			}
			
			
			return $movimento;
		
		}	

		public function getDespesas(){
			if ($this->caixaModel->idCaixa()) {
				$id_caixa = $this->caixaModel->idCaixa();
				$movimento = $this->caixaModel->consultarMovimentos(2, $id_caixa);
				$movimento == null ? $movimento = 0.00 : $movimento = $movimento;
			}else{
				$movimento = 0.00;
			}
			
			return $movimento;
		
		}

		public function getSaldoInicial(){
			$id_caixa = $this->caixaModel->idCaixa();
			$saldo_inicial = $this->caixaModel->saldoInicial($id_caixa);
			$saldo_inicial = (isset($saldo_inicial) ? $saldo_inicial : 0);

			return $saldo_inicial > 0 ? $saldo_inicial : 0;

		}

		public function getSaldo(){
			$id_caixa = $this->caixaModel->idCaixa();
			$receitas = $this->caixaModel->consultarMovimentos(1, $id_caixa);
			$despesas = $this->caixaModel->consultarMovimentos(2, $id_caixa);
			$saldoInicial =  $this->getSaldoInicial();

			$saldo = ($saldoInicial + $receitas) - $despesas; 
			// echo "<pre>";
			// print_r($receitas);
			return ($saldo);
		
		}

		public function createSessionCaixa($id){
			$_SESSION['id_caixa'] = $id;

			redirect("/caixas/");
		
		}

		public function deleteSessionCaixa(){
			unset($_SESSION['id_caixa']);

			redirect("/caixas/");
		
		}

		public function pdf($id, $nome = 'Relatório Caixa') {
			$movimentos = $this->caixaModel->getMovimentos($id);
			$caixa = $this->caixaModel->getCaixa($id);

			$body = '<!DOCTYPE html>
			<html>
			<head>
				<title>Teste</title>
				<link rel="stylesheet" type="text/css" href="../../public/css/fontes.css">
				<style type="text/css">
					body{
						font-family: Open Sans, sans-serif;
					}

					.center{
						text-align: center;
					}

					.left{
						text-align: left;
					}

					table {
					  border-collapse: collapse;
					  border-right: 1px solid #dddddd;
					  border-left:1px solid #dddddd;
					  font-size: 12px;
					  width: 100%;
					}

					td, th {
					  border: 1px solid #dddddd;
					  border-right: none;
					  border-left:none;
					  padding: 8px;
					}

					tr:nth-child(even) {
					  background-color: #dddddd;
					}
				</style>
			</head>
			<body>
				<div width="100%">
				    <p style="text-transform: uppercase; text-align: center; font-family: Open Sans, sans-serif; font-size: 22px">Relatório Caixa - 10/06/2019</p>
				    <p style="text-align: center; font-size: 12px;">Aberto por Luis Otavio</p>
				</div>
				<table style="width: 100%; margin-top: 15px">
					<thead>
						<tr>
							<th class="center">#</th>
							<th class="left">Descrição</th>
							<th class="center">Modo</th>
							<th class="center">Tipo</th>
							<th class="center">Valor</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="center">--</th>
							<th class="left">Saldo Inicial</th>
							<th class="center">--</th>
							<th class="center">--</th>
							<th class="center">R$ '.str_replace('.', ',', $caixa[0]->saldo_inicial).'</th>
						</tr>
						';	
							$cont = 1;
							foreach ($movimentos as $key => $value) { 
								$body .= 
									'<tr>
										<td class="center">'.$cont.'</td>
										<td class="left">'.$value->descricao.'</td>
										<td class="center">'.($value->modo_pagamento == 1 ? "Cartão" : "Dinheiro").'</td>
										<td class="center">'.($value->tipo == 1 ? "Receita" : "Despesa").'</td>
										<td class="center">'.($value->tipo == 1 ? "+" : "-").' R$ '.str_replace('.', ',', $value->valor).'</td>
									</tr>';
								$cont++;
							}

					$body .='
					</tbody>
					<foot>
						<tr>
							<th class="center">--</th>
							<th class="left">Saldo Final</th>
							<th class="center">--</th>
							<th class="center">--</th>
							<th class="center">R$ '.str_replace('.', ',', $caixa[0]->saldo_final).'</th>
						</tr>
					</foot>

				</table>

			</body>
			</html>';
			//Instaciamento da classe preenchimento de parametros
			require_once '../app/vendor/autoload.php';

			$mpdf = new \Mpdf\Mpdf([
				'margin_left' => 20,
				'margin_right' => 15,
				'margin_top' => 20,
				'margin_bottom' => 20,
				'margin_header' => 10,
				'margin_footer' => 10
			]);

			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Carteiras - " . $curso . " - " . date("d/m/Y"));
			$mpdf->SetAuthor("Include Jr");
			$mpdf->SetDisplayMode('fullpage');

			$mpdf->SetHTMLFooter('
			<div style="text-align: center;  font-family: Open Sans, sans-serif;">
			    {DATE j/m/Y}
			</div>');

			$mpdf->WriteHTML($body);

			$mpdf->Output("$nome.pdf", \Mpdf\Output\Destination::DOWNLOAD);

		}

		public function getMovimentos($id) {
			$movimentos = $this->caixaModel->getMovimentos($id);
			echo json_encode($movimentos);
		
		}

		public function deleteCaixa($id) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				// Sanitize POST data
				$_GET = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


				if (isset($id)) {
					if ($this->caixaModel->deleteMovimentosAll($id)) {
						if ($this->caixaModel->deleteCaixa($id)) {
							flash("caixa", "Caixa excluído com Sucesso !");
							redirect("/caixas/");
						}else{
							flash("caixa", "Não foi possível deletar o caixa 1 !", "alert-danger");
							redirect("/caixas/");
						}
					}else{
						flash("caixa", "Não foi possível deletar o caixa  2!", "alert-danger");
						redirect("/caixas/");
					}
				}else{
					flash("caixa", "Não foi possível deletar o caixa 3 !", "alert-danger");
					redirect("/caixas/");
				}

			}else{
				flash("caixa", "Ação Bloqueada !", "alert-danger");
				redirect("/caixas/");
			}
				
		}
		
	}

?>