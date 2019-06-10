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
			];

			$this->view('/caixas/dashboard', $data);
		}

		public function openCaixa(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				
				// Init data
				$data = [
					'saldo_inicial' => $this->tofloat($_POST['saldoInicial']),
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
							$this->deleteSessionCaixa();	
							flash("caixa", "Caixa fechado com Sucesso !");
							redirect("/caixas");
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
						'valor' => $this->tofloat($_POST['valor']),
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
					'valor' => $this->tofloat($_POST['valor']),
					'tipo' => 2,
					'modo_pagamento' => ($_POST['modo_pagamento'])
				];


				if (isset($data['descricao']) && isset($data['data_registro']) && isset($data['valor'])) {
					if ($data['valor'] < $this->getSaldo()) {
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
			return $saldo;
		
		}

		public function createSessionCaixa($id){
			$_SESSION['id_caixa'] = $id;

			redirect("/caixas/");
		
		}

		public function deleteSessionCaixa(){
			unset($_SESSION['id_caixa']);

			redirect("/caixas/");
		
		}

		public function tofloat($num) {
		    $dotPos = strrpos($num, '.');
		    $commaPos = strrpos($num, ',');
		    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
		        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
		   
		    if (!$sep) {
		        return floatval(preg_replace("/[^0-9]/", "", $num));
		    } 

		    return floatval(
		        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
		        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
		    );
		
		}


		
	}

?>