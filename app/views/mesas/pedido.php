<?php  
	// echo "<pre>";
	// print_r(($data['id']));

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pedido <?php echo isset($data['id']) ? $data['id'] : 'Não encontrado !'; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom fonts for this template-->
    <link href="<?php echo URLROOT; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo URLROOT; ?>/css/sb-admin-2.css" rel="stylesheet">
    <style type="text/css">
    	.table th, .table td {
    		vertical-align: inherit !important;
    		height: 60px !important;
    		font-size: .9rem !important;
    	}

    	.table .total th{
    		font-weight: 700 !important; 
    	}

    	.text-muted-footer, .instagram, .whatsapp, .linkedin{
			color: white;
			transition: all 0.4s;
		}

		.text-muted-footer:hover{
			color: white;
		}

		.instagram:hover{
			color: #d03481;
		}

		.whatsapp:hover{
			color: #00e676;
		}

		.linkedin:hover{
			color: #4997ce;
		}

		.data{
			font-size: 14px;
		}

		.menus{
			font-weight: 600;
		}

		.red{
			color: #d12323 !important;
		}

		.footer{
			/*background: rgb(180,58,114);
			background: linear-gradient(90deg, rgba(180,58,114,1) 0%, rgba(211,39,81,1) 21%, rgba(253,29,29,1) 73%, rgba(255,58,5,1) 94%);*/
			/*background: rgb(0,0,0);
background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(253,29,29,1) 60%);*/
/*background: rgb(0,0,0);
background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(190,22,22,0.9051995798319328) 27%, rgba(253,29,29,1) 73%);*/
/*background: rgb(60,54,54);
background: linear-gradient(90deg, rgba(60,54,54,1) 0%, rgba(253,29,29,1) 41%);*/
/*background: rgb(60,54,54);
background: linear-gradient(90deg, rgba(60,54,54,1) 0%, rgba(117,47,47,1) 1%, rgba(192,37,37,1) 37%, rgba(211,35,35,1) 66%, rgba(253,29,29,1) 84%);*/
/*background: rgb(60,54,54);
background: linear-gradient(90deg, rgba(60,54,54,1) 0%, rgba(117,47,47,1) 1%, rgba(192,37,37,1) 37%, rgba(202,36,36,1) 54%, rgba(211,35,35,1) 76%, rgba(253,29,29,1) 100%);*/
/*background: rgb(60,54,54);
background: linear-gradient(90deg, rgba(60,54,54,1) 0%, rgba(117,47,47,1) 1%, rgba(192,37,37,1) 37%, rgba(202,36,36,1) 54%, rgba(206,36,36,1) 69%, rgba(211,35,35,1) 94%, rgba(253,29,29,1) 100%);*/
background: rgb(60,54,54);
background: linear-gradient(90deg, rgba(60,54,54,1) 0%, rgba(117,47,47,1) 1%, rgba(192,37,37,1) 37%, rgba(202,36,36,1) 54%, rgba(206,36,36,1) 69%, rgba(211,35,35,1) 100%, rgba(253,29,29,1) 100%);
		}

    </style>
</head>
<body>
	<div class="container-fluid fadeIn">
		<div class="row">
			<div class="col-lg-8 mx-auto mt-5" style="min-height: 100vh;">
				<div class="row">
					<div class="col-12">
						<h2 class="text-center red"><i class="fas fa-drumstick-bite"></i> <b>Assakabrasa</b> <i class="fas fa-utensils"></i></h3>
					</div>
				</div>
				<?php if ($data['status'] != 1): ?>
					<div class="row">
						<div class="col-12">
							<h3 class="text-center"><b>Olá,</b></h3>
							<h4 class="text-center"><b>bem vindo ao seu pedido !</h4>
						</div>
					</div>
					<?php if ($data['pedido']): ?>
						<div class="row mt-3">
							<div class="col-12">
								<h5 class="text-center">Resumo do <b>Pedido <?php echo $data['pedido'][0]->id_comanda ?></b></h4>
								<p style="font-size: 14px">Clique sobre o pedido para detalhes</p>
							</div>
						</div>
						<div class="row">
							<div class="col-12 px-0">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="text-center ">#</th>
											<th class="">Produto</th>
											<th class="text-center ">Qtd.</th>
											<th class="text-center ">Valor</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$cont = 1;
											$total = 0;
											foreach ($data['pedido'] as $key => $value):
										?>
											<tr onclick="openModal(<?php echo $value->id_pedido ?>)" style="cursor: pointer;">
												<td class="text-center"><?php echo $cont ?></td>
												<td><?php echo $value->descricao ?></td>
												<td class="text-center"><?php echo $value->quantidade ?></td>
												<td style="font-style: " class="text-center">R$ <?php echo str_replace('.', ',', $value->valor) ?></td>
											</tr>
										<?php 	
											$total += $value->valor * $value->quantidade;
											$cont++;
											endforeach; 
										?>
									</tbody>
									<tfoot>
										<tr class="total">
											<th colspan="2" class="text-center text-success">TOTAL:</th>
									
											<th colspan="2" class="text-center text-success">R$ <?php echo str_replace('.', ',', number_format($total, 2)) ?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-12 my-2 text-center">
								<a href="<?php echo URLROOT ?>/clientes/imprimirPedido/<?php echo $data['pedido'][0]->id_comanda ?>/DOWNLOAD"><i class="fas fa-file-download"></i> Clique para Imprimir o Pedido</a>
								<hr>
							</div>
						</div>
						<?php if ($data['statusVoto'] == 0): ?>
							<div class="row mb-5 feedback">
								<div class="col-12 px-0">
									<h4 class="text-center">Gostou do nosso atendimento ?</h4>
								</div>
								<div class="col-12 text-center">
									<div class="btn-group">
										<button type="button" onclick="sendO(1, <?php echo $data['pedido'][0]->id_comanda ?>)" class="btn btn-danger"><i class="far fa-thumbs-down"></i> Não</button>
										<button type="button" onclick="sendO(2, <?php echo $data['pedido'][0]->id_comanda ?>)" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Sim</button>
									</div>
									
								</div>
							</div>
							
						<?php endif ?>
					<?php else: ?>
						<div class="row mt-3">
							<div class="col-12">
								<h5 class="text-center">Sua mesa ainda não fez nenhum pedido, peça algo e atualize a página <i class="fas fa-smile"></i></h4>
							</div>
						</div>


					<?php endif; ?>
					
				<?php else: ?>
					<div class="row mt-5">
						<div class="col-12">
							<h5 class="text-center">Este pedido já foi pago ou cancelado, não é possível acessá-lo..</h4>
						</div>
					</div>

				<?php endif; ?>
			</div>	
		</div>
		<div class="row">
			<div class="col-lg-12 footer" style="min-height: 350px; box-shadow: 2px 0px 5px #e9ecef; color: white">
				<div class="row" style="min-height: 300px">
					<div class="col-lg-4 px-3">
						<div class="logo text-center mt-5">
							<!-- <img  src="../public/img/logo.svg" width="200" height="130" class="img-fluid"> -->
							<h2 class="">Assakabrasa</h2>
						</div>
						
						<!-- <p class="text-justify text-muted-footer mt-3" style="font-weight: 500">Desenvolvido por <a href="https://www.instagram.com/includejr/" target="_blank">@includejr</a> com o pensamento ambiental de "Menos é Mais". Menos papel, menos poluição, mais anos de vida para nosso planeta. Colabore com essa idéia !</p> -->
						<p class="text-justify text-muted-footer mt-3" style="font-weight: 500"><?php echo $data['configs']->descricaoEmpresa ?></p>

					</div>
					<div class="col-lg-4 py-5 text-center">
						<?php if (isset($data['configs']->maps)): ?>
							
							<iframe src="<?php echo $data['configs']->maps ?>" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						<?php else: ?>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31800.077480058895!2d-37.989034613294194!3d-4.938021863997906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7b982a3a30d74a3%3A0x8c394db26dbbcbb!2sRussas%2C+CE%2C+62900-000!5e0!3m2!1spt-BR!2sbr!4v1561663850324!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						<?php endif; ?>
					</div>
					<div class="col-lg-3 py-1 py-lg-5 px-4 mb-4 mg-lg-0 text-center">
						<h4>Contato</h4>
						<div class="mt-4 pl-1 text-left">
							<p class="text-muted-footer data"><i class="fas fa-map-marker-alt"></i> <?php echo $data['configs']->endereco ?></p>
							<p class="text-muted-footer data"><i class="fas fa-phone-volume"></i> <?php echo $data['configs']->telefone ?></p>
							<p class="text-muted-footer data"><i class="fas fa-inbox"></i> <?php echo $data['configs']->email ?></p>
							<div class="">
								<?php if (isset($data['configs']->instagram)): ?>
									<a href="<?php echo isset($data['configs']->instagram) ? $data['configs']->instagram : '#' ?>" target="_blank" class="mr-3 instagram"><i style="font-size: 25px" class="fab fa-instagram"></i></a> 
									
								<?php endif ?>

								<?php if (isset($data['configs']->whatsapp)): ?>
									<a href="<?php echo isset($data['configs']->whatsapp) ? 'https://api.whatsapp.com/send?phone=55'.$data['configs']->whatsapp : '#' ?>" target="_blank" class="mr-3 whatsapp"><i style="font-size: 25px" class="fab fa-whatsapp"></i></a> 
									
								<?php endif ?>

								<?php if (isset($data['configs']->facebook)): ?>
									<a href="<?php echo $$data['configs']->facebook ?>" target="_blank" class="linkedin"><i style="font-size: 25px"class="fab fa-facebook"></i></a>
								<?php endif ?>

							</div>

						</div>
					</div>
					<!-- #12a5bb -->
					<!-- #bf0101e6 -->
					<!-- #ff3a05e6 -->
				</div>	
				<div class="row" style="height: 50px;">
					<div class="col-lg-12" style="display: flex;background-color: #09090963;align-items: center; justify-content: center;">
						<p class="text-center mb-0" style="align-items: center;color: white">Copyright © Todos os direitos reservados.</p>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal" id_pedido="" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Pedido Detalhado</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
                <div class="modal-body">
					<div class="row">
						<div class="col-12 Produto">
							<h5></h5>
							<hr>
						</div>
						<div class="col-12 quantidade">
							<h5></h5>
							<hr>
						</div>
						<div class="col-12 ValorU">
							<h5></h5>
							<hr>
						</div>
						<div class="col-12 ValorT">
							<h5></h5>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
	           
	        </div>
	    </div>
	</div>
	<!-- Bootstrap core JavaScript-->
    <script src="<?php echo URLROOT; ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo URLROOT; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <?php if ($data['pedido']): ?>
	    <?php  
	    	$data_json = array();
			foreach ($data['pedido'] as $key => $value) {
				$data_json[$value->id_pedido]['descricao'] = $value->descricao;
				$data_json[$value->id_pedido]['valor'] = $value->valor;
				$data_json[$value->id_pedido]['quantidade'] = $value->quantidade;
			}

			// echo "<pre>";
			// print_r($data_json);

			$data_json = json_encode($data_json);

	    ?>
	    <script type="text/javascript">
	    	var data = JSON.parse('<?php echo $data_json ?>');
	    	var id;
	    	function openModal(idDefault) {
	    		id = idDefault;
	    		$("#modal").modal('show');

	    	}

	    	$("#modal").on("show.bs.modal", function(e) {
				var link = $(e.relatedTarget);
				$(this).find('.Produto h5').append("<b>Produto: </b> " + data[id].descricao);
				$(this).find('.quantidade h5').append("<b>Quantidade: </b> " + data[id].quantidade);
				$(this).find('.ValorU h5').append("<b>Valor Unitário: </b>  R$ " + data[id].valor);
				$(this).find('.ValorT h5').append("<b>Valor Total: </b>  R$ " + (parseFloat(data[id].valor) * parseInt(data[id].quantidade)).toFixed(2));

				
			});

			$("#modal").on("hidden.bs.modal", function(e) {
				id = '';	
				$(this).find('.Produto h5').html("");
				$(this).find('.quantidade h5').html("");
				$(this).find('.ValorU h5').html("");
				$(this).find('.ValorT h5').html("");
			});

	    </script>
    	
    <?php endif ?>
    <script type="text/javascript">
		function sendO(tipo, id) {
			$.ajax({
	            type: "GET",
	            url: "sendOpinion/" + tipo + "/" + id,  
	            data: {},        
	            success: function (data) {
	            	$(".feedback").html('<div class="col-12 px-0">\
								<h4 class="text-center">Obrigado !</h4>\
							</div>');
	            },
	            error: function(e) {
	            	
	            }
	        });
		
		}

		$(document).ready(function(){
			$('iframe').attr('width', '100%').attr('height', '250')
		})
    </script> 
</body>

</html>