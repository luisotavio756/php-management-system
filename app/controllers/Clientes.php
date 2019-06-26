<?php  

	class Clientes extends Controller {
		
		public function __construct(){
			$this->mesaModel = $this->model('Mesa');
			$this->configModel = $this->model('Config');
			
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
				'status' => $status,
				'statusVoto' => $this->mesaModel->getCom($id)[0]->statusVoto
			];

			$this->view('mesas/pedido', $data);	
		}

		public function imprimirPedido($id, $method = 'INLINE') {
			$pedidos = $this->mesaModel->getPedido($id);

			if ($this->mesaModel->getCom($id)) {
				if ($this->mesaModel->getCom($id)[0]->status == 0) {
					$status = 0;				
				}else{
					$status = 1;
				}
			}else{
				$status = 1;
			}

			if ($status == 1) {
				$data = [
					'pedido' => $pedidos,
					'status' => $status
				];

				$this->view('mesas/pedido', $data);	
			}

			$body = '<!DOCTYPE html>
			<html>
			<head>
				<title></title>
			</head>
			<body>
				<div width="100%">
					<h1 style="text-align: center; font-weight: 100 !important">Churrascaria Assakabrasa</h1>
				    <p style="text-align: center; font-family: Arial, sans-serif; font-size: 14px">Pedido Emitido em '.date("d/m/Y").'</p>
				    
				</div>
				<table style="width: 100%; margin-top: 15px">
					<thead>
						<tr>
							<th class="center">#</th>
							<th class="left">Produto</th>
							<th class="center">Qtd.</th>
							<th class="center">Valor Uni.</th>
							<th class="center">Valor Total</th>
						</tr>
					</thead>
					<tbody>
						';	
							$cont = 1;
							$total = 0;
							foreach ($pedidos as $key => $value) { 
								$body .= 
									'<tr>
										<td class="center">'.$cont.'</td>
										<td class="left">'.$value->descricao.'</td>
										<td class="center">'.$value->quantidade.'</td>
										<td class="center">R$ '. str_replace(".", ',', number_format($value->valor, 2)).'</td>
										<td class="center">R$ '. str_replace(".", ',', number_format($value->valor * $value->quantidade, 2)) .'</td>
									</tr>';
								$cont++;
							}

							$total += $value->valor * $value->quantidade;

					$body .='
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3" class="center">TOTAL:</th>
					
							<th colspan="2" class="center">R$ ' . str_replace('.', ',', number_format($total, 2)) .'</th>
						</tr>
					</tfoot>

				</table>

			</body>
			</html>';
			//Instaciamento da classe preenchimento de parametros
			require_once '../app/vendor/autoload.php';

			$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
			$fontDirs = $defaultConfig['fontDir'];

			$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
			$fontData = $defaultFontConfig['fontdata'];

			$mpdf = new \Mpdf\Mpdf([
			    'fontDir' => array_merge($fontDirs, [
			        __DIR__ . '/custom/font/directory',
			    ]),
			    'fontdata' => $fontData + [
			        'frutiger' => [
			            'O' => 'OpenSans-Bold.ttf',
			            'R' => 'OpenSans-Regular.ttf',
			            'T' => 'OpenSans-SemiBold.ttf',
			        ]
			    ],
			    'default_font' => 'OpenSans'
			]);



			// $mpdf = new \Mpdf\Mpdf([
			//     'fontDir' => array_merge($fontDirs, [
			//         __DIR__ . '/custom/font/directory',
			//     ]),
			//     'fontdata' => $fontData + [
			//         'frutiger' => [
			//             'R' => 'Frutiger-Normal.ttf',
			//             'I' => 'FrutigerObl-Normal.ttf',
			//         ]
			//     ],
			//     'default_font' => 'frutiger'
			// ]);


			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Pedido ".$id." - " . date("d/m/Y"));
			$mpdf->SetAuthor("Include Jr");
			$mpdf->SetDisplayMode('fullpage');


			$mpdf->SetHTMLFooter('<table width="100%" style="border: none">
						    <tr style="border: none">				        
						        <td width="40%" style="text-align: right;">Russas-CE, {DATE j/m/Y}</td>
						        <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
						    </tr>
						</table>');
			$stylesheet = file_get_contents('css/style_pedido.css');
			$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
			$mpdf->WriteHTML($body,\Mpdf\HTMLParserMode::HTML_BODY);
			// $mpdf->WriteHTML($body);
			switch ($method) {
				case 'INLINE':
					$mpdf->Output("Pedido.pdf", \Mpdf\Output\Destination::INLINE);
					break;
				case 'DOWNLOAD':
					$mpdf->Output("Pedido.pdf", \Mpdf\Output\Destination::DOWNLOAD);
					break;
				default:
					$mpdf->Output("Pedido.pdf", \Mpdf\Output\Destination::INLINE);
					break;
			}

		}

		public function sendOpinion($tipo, $id) {
			if ($this->configModel->setVotos($tipo)) {
				$this->mesaModel->setVotoCom($id);
				echo "1";
			}else{
				echo "0";
			}	
	
		}
	}


?>