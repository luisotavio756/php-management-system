<?php require_once APPROOT . '/views/inc/header.php'; ?>
	<style type="text/css">
		table tbody td{
			padding: 7px !important;
    		vertical-align: baseline !important;
    		font-weight: 700;
		}

		.dropdown-item {
		    display: flex !important;
		    height: 35px !important;
		    align-items: center !important;
		    font-size: 15px !important;
		    font-weight: 600 !important;

		}

		.select-mesa {
		    -webkit-appearance: none;
		    -moz-appearance: none;
		    text-indent: 1px;
		    text-overflow: '';
		}

		.collapseCardOptions a{
			font-size: 14.5px;
			font-weight: 700;
		}

		.collapseCardOptions .card{
			cursor: pointer;
		}
		

		@media screen and (max-width: 992px) {
			.text-back {
				display: block !important;
			}

			.text-back-2{
				display: none !important;
			}
		}

		@media screen and (min-width: 992px) {
			.text-back {
				display: none !important;
			}

			.text-back-2{
				display: block !important;
			}
		}

	</style>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="h3 mb-2 text-gray-800">Salão de Mesas</h1>
			<div class="row">
				<div class="col-12">
					<?php echo flash('salao'); ?>
				</div>
				<div class="col-12 mt-4">
					<div class="row">
						<?php foreach ($data['mesas'] as $key => $value): ?>
							<div class="col-md-6 col-lg-6 col-xl-4 mb-4">
								<div class="card border-left-<?php echo $value->status == 1 ? 'danger' : 'success' ?> shadow h-100 py-1" style="min-height: 180px !important;">
									<div class="card-body collapse-text-<?php echo $value->id ?> text-center collapseCardExample align-items-center" id="<?php echo $value->id ?>" style="display: flex; cursor: pointer;">
										<div class="row mx-auto">
											<div class="col mr-2">
												<div style="font-size: 16px" class="font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $value->descricao ?>
												<?php echo $value->status == 1 ? " --- Comanda <b>" . $data['comandasMesa'][$value->id]->id . "</b>" : "" ?> </div>
												<p class="pulsate my-0 font-weight-bolder text-<?php echo $value->status == 1 ? 'danger' : 'success' ?>"><i class="fas fa-circle"></i> <?php echo $value->status == 1 ? 'Ocupada' : 'Disponível' ?></p>
												<p class="text-center">Clique para ações</p>

											</div>
										</div>
									</div>
									<div class="card-body py-2 px-1 collapse-options-<?php echo $value->id ?> collapseCardOptions" style="display: none" title="Clique para Voltar">
										<div class="row mt-1 px-1">
											<?php if ($value->status == 1): ?>
					                		<div class="col-6 mb-2">
					                			<div class="card h-100 px-0" href="#modal_pedidos" data-toggle="modal" id="<?php echo $data['comandasMesa'][$value->id]->id ?>" mesa="<?php echo $value->id ?>" title="Adicionar Produtos">
													<div class="card-body py-2 px-1 text-center">
														<a class="text-info"><i class="fas fa-plus mr-1"></i> Produtos</a>
													</div>
												</div>
					                		</div>
					                		<div class="col-6 mb-2">
					                			<div class="card h-100 px-0" href="#modal_ver_pedidos" data-toggle="modal" id="<?php echo $data['comandasMesa'][$value->id]->id ?>" mesa="<?php echo $value->id ?>" nome="<?php echo $data['comandasMesa'][$value->id]->nome_cliente ?>" data-registro="<?php echo $data['comandasMesa'][$value->id]->data_registro ?>" title="Ver Pedido">
													<div class="card-body py-2 px-1 text-center">
														<a class="text-warning"><i class="fas fa-file mr-1"></i> Pedido</a>
													</div>
												</div>
					                		</div>
											<?php if ($_SESSION['nivel'] == 1): ?>
												<div class="col-6 mb-2">
													<div class="card h-100 px-0"  href="#modal_enviar_pedido" data-toggle="modal" id="<?php echo $data['comandasMesa'][$value->id]->id ?>" whats="<?php echo $data['comandasMesa'][$value->id]->whatsapp ?>" mesa="<?php echo $value->id ?>" title="Enviar Pedido">
														<div class="card-body py-2 px-1 text-center">
															<a class="text-success"><i class="fas fa-paper-plane mr-1"></i> Enviar</a>
														</div>
													</div>
												</div>
												<div class="col-6 mb-2">
													<div class="card h-100 px-0" href="#modal_fechar_comanda" data-toggle="modal" id="<?php echo $data['comandasMesa'][$value->id]->id ?>" nome="<?php echo $data['comandasMesa'][$value->id]->nome_cliente ?>" total="<?php echo $data['comandas'][$data['comandasMesa'][$value->id]->id] ?>" mesa="<?php echo $value->id ?>" data-registro="<?php echo toBrDateTime($data['comandasMesa'][$value->id]->data_registro) ?>">
														<div class="card-body py-2 px-1 text-center">
															<a class="text-success"><i class="fas fa-check-circle mr-1"></i> Fechar</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="card h-100 px-0" href="#modal_cancelar_comanda" data-toggle="modal" id="<?php echo $data['comandasMesa'][$value->id]->id ?>" nome="<?php echo $data['comandasMesa'][$value->id]->nome_cliente ?>" total="<?php echo $data['comandas'][$data['comandasMesa'][$value->id]->id] ?>" mesa="<?php echo $value->id ?>" data-registro="<?php echo toBrDateTime($data['comandasMesa'][$value->id]->data_registro) ?>" title="Cancelar Comanda">
														<div class="card-body py-2 px-1 text-center">
															<a class="text-danger"><i class="fas fa-ban mr-1"></i> Cancelar</a>
														</div>
													</div>
												</div>
											<?php endif ?>
					                		<div class="col-lg-6 mb-2 my-auto text-back-2 text-right">
												<a class="btn btn-secondary collapseCardOptionsButton" id="<?php echo $value->id ?>" href="#" style="border-radius: 20px">
													Voltar
												</a>	
					                		</div>
					                		<div class="col-12 mb-2 text-back text-center">
												<a class="btn btn-secondary collapseCardOptionsButton mx-auto" id="<?php echo $value->id ?>" href="#" style="border-radius: 20px">
													<!-- <i class="fas fa-angle-right"></i> -->
													Clique para Voltar
												</a>	
					                		</div>

					                		<?php else: ?>
											<div class="col-12 mb-2">
					                			<div class="card h-100 px-0" href="#modal_add_comanda" id="<?php echo $value->id ?>" data-toggle="modal">
													<div class="card-body py-2 px-1 text-center">
														<a class="text-primary"><i class="fas fa-plus mr-1"></i> Adicionar Comanda</a>
													</div>
												</div>
					                		</div>	
					                		<div class="col-12 mb-2 text-center">
												<a class="btn btn-secondary collapseCardOptionsButton mx-auto" id="<?php echo $value->id ?>" href="#" style="border-radius: 20px">
													<!-- <i class="fas fa-angle-right"></i> -->
													Voltar
												</a>	
					                		</div>		
											<?php endif; ?>													
					                	</div>
										
									</div>
								</div>
							</div>
						<?php endforeach ?>
						
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade" id="modal_pedidos" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog modal-xl" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Adicionar Pedidos</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/adicionarPedido/" method="POST" enctype="multpart/form-data">
	            	<input type="hidden" name="id_comanda" value="">
	            	<input type="hidden" name="id_mesa" value="">
	            	<div class="inputs-hidden"></div>
	                <div class="modal-body" style="max-height: 80vh; overflow: auto;">
	                	<div class="row">
	                		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 px-2">
			                	<div class="row">
									<div class="col-lg-10 mb-3 mb-lg-0">
	                					<h4 class="text-center">Pesquisar Produtos</h4>
										<input type="text" class="form-control form-control-user query-input mt-4" placeholder="Digite o nome do Produto..">
									</div>
									<div class="col-12" style="max-height: 297px; overflow-y: auto;">
										<table class="table mt-4">
	                						<tbody id="tbody">
	                							
	                						</tbody>
	                					</table>
									</div>	
								</div>
	                			
	                		</div>	
	                		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4 mt-lg-0">
	                			<div class="row">
	                				<div class="col-12" style="max-height: 350px; overflow-y: auto;">
	                					<h4 class="text-center">Produtos Adicionados</h4>
	                					<table class="table mt-4">
	                						<tbody id="tbody-produtos"></tbody>
	                					</table>
	                				</div>
	                			</div>	                			
	                		</div>		           
	                	</div>
	                	<div class="col-12 order-produtos mt-3">
	                		<div class="row justify-content-end">
	                			<div class="col-md-2 text-right">
	                				<h6>Qtd: <b id="qtd">0</b></h6>
	                			</div>
	                			<div class="col-md-2 text-right">
	                				<h6>Valor: <b id="total">0.00</b></h6>
	                			</div>
	                		</div>
	                	</div>	
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-success">Adicionar <i class="fas fa-check"></i></button>
	                </div>

	            </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal_add_comanda" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Adicionar Comanda</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/addComanda" method="POST" enctype="multpart/form-data">
	                <div class="modal-body">
						<div class="form-group row">
							
							<div class="col-lg-7 mb-3">
								<label>Cliente(Opcional):</label>
								<input type="text" name="cliente" class="form-control form-control-user" placeholder="Nome do Cliente.." >
							</div>
							<div class="col-lg-5 mb-3">
								<label>Mesa:</label>
								<select class="form-control form-control-user select-mesa" disabled="" name="mesa" required="">
									<?php if ($data['mesas']): ?>
										<!-- <option value="" disabled selected>Selecione uma mesa disponível</option> -->
										<?php foreach ($data['mesas'] as $key => $value): ?>
											<?php if ($value->status == 0): ?>
												<option value="<?php echo $value->id ?>"><?php echo $value->descricao ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
							<div class="col-lg-12 mb-3 mb-lg-0">
								<label>Whatsapp(Opcional):</label>
								<input type="tel" name="whatsapp" class="form-control form-control-user phone" placeholder="Digite o número do Whatsapp do Cliente.." autocomplete="off">
							</div>
						</div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-success">Adicionar <i class="fas fa-check"></i></button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal_enviar_pedido" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Enviar Pedido</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/addComanda" method="POST" enctype="multpart/form-data">
	                <div class="modal-body">
						<h4 class="text-center my-4">Escolha abaixo como deseja enviar o pedido para o cliente <i class="fas fa-paper-plane"></i></h4>
	                </div>
	                <div class="modal-footer">
	                   
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal_ver_pedidos" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Ver Pedidos</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/alterPedido/" method="POST" enctype="multpart/form-data">
	            	<input type="hidden" name="total" value="">
	            	<div class="inputs-hidden-alter"></div>
	            	<div class="inputs-hidden-delete"></div>
	                <div class="modal-body">
	                	<div class="row my-2 px-2">
							<div class="col-lg-5">
								<h6>Cliente: <b class="nome_cliente"></b></h6>
							</div>
							<div class="col-lg-3">
								<h6>Comanda: <b class="num_com"></b></h6>
							</div>
							<div class="col-lg-4">
								<h6>Horário: <b class="data"></b></h6>
							</div>
						</div>
						<div class="row mt-3 px-2" style="height: 315px; overflow-y: auto">
							<div class="col-lg-12">
								<table class="table">
            						<tbody class="tbody">
            							
            						</tbody>            						
            					</table>
							</div>
						</div>
						<div class="row mt-4 px-2">
							<div class="col-12 order-pedidos">
								<hr>
		                		<div class="row">
		                			<div class="col-3">
		                				<h6>Qtd: <b class="qtd">0</b></h6>
		                			</div>
		                			<div class="col-9 text-right">
		                				<h6>Valor: <b>R$ </b><b class="total">0.00</b></h6>
		                			</div>
		                		</div>
		                	</div>	
						</div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-success">Salvar Alterações <i class="fas fa-check"></i></button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal_fechar_comanda" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Fechar Comanda</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/fecharComanda" method="POST" enctype="multpart/form-data">
	            	<input type="hidden" name="id_comanda" value="">
	            	<input type="hidden" name="id_mesa" value="">
	            	<input type="hidden" name="total_comanda" value="">
	                <div class="modal-body">
	                	<div class="row">
                            <div class="col-12 my-3 text-center">
                                <h5 class="mb-0"><b>Tem certeza que deseja fechar a comanda <b class="id_comanda"></b> ?</b></h5>
                                <p class="mt-1 text-danger" style="font-size: 15px; font-weight: 700">OBS: A ação não poderá ser desfeita</p>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-12 text-center">
                        		<h6>Mesa: <b class="id_mesa"></b></h6>
                        		<h6>Cliente: <b class="nome"></b></h6>
                        		<h6>Comanda Aberta em: <b class="data"></b></h6>
                        	</div>
                        	<div class="col-lg-12 text-right">
                        		<hr>
                        		<h6 class="float-left mb-0">Total da Comanda: <b class="total-comanda">0.00</b></h6>
                        		Pagar com 
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" checked="" id="customRadioInline2" name="modo_pagamento" class="custom-control-input" value="1">
									<label class="custom-control-label" for="customRadioInline2"><i class="fas fa-dollar-sign"></i> Dinheiro</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline1" name="modo_pagamento" class="custom-control-input" value="2">
									<label class="custom-control-label" for="customRadioInline1"><i class="far fa-credit-card"></i> Cartão</label>
								</div>
							</div>
                        </div>
						
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-success">Confirmar e Fechar <i class="fas fa-check"></i></button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal_cancelar_comanda" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Cancelar Comanda</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/cancelarComanda" method="POST" enctype="multpart/form-data">
	            	<input type="hidden" name="id_comanda" value="">
	            	<input type="hidden" name="id_mesa" value="">
	                <div class="modal-body">
	                	<div class="row">
                            <div class="col-12 my-3 text-center">
                                <h5 class="mb-0"><b>Tem certeza que deseja CANCELAR a comanda <b class="id_comanda"></b> ?</b></h5>
                                <p class="mt-1 text-danger" style="font-size: 15px; font-weight: 700">OBS: Ao cancelar a comanda, todos os pedidos ligados a ela tambme serão cancelados</p>
                            </div>
                        </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Desistir</button>
	                    <button type="submit" class="btn btn-danger">Confirmar Ação <i class="fas fa-check"></i></button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript">
	$(".collapseCardExample").click(function(){
		var id = $(this).attr('id');
		$(".collapseCardOptions").each(function(){
			if ($(this).is( ":visible" )) {
				$(this).fadeOut(200,() => {
					$(this).parent().find('.collapseCardExample').show();
				});	
			}
		});

		$(".collapse-text-" + id).fadeOut(200,() => {
			$('.collapse-options-' + id).show();
		});
	})

	$(".collapseCardOptionsButton").click(function(e){
		var id = $(this).attr('id')
		$(".collapse-options-" + id).fadeOut(200,() => {
			$('.collapse-text-' + id).show();
		});
	});

	function enviarMensagem(numero, id){
		var celular = numero;

		var texto = "*Olá ! Acesse este link para ver os seus pedidos*\n\n<?php echo URLROOT ?>/clientes/" + id;
		texto = window.encodeURIComponent(texto);

		window.open("https://api.whatsapp.com/send?phone=" + celular + "&text=" + texto, "_blank");
		//Obs.. use "_system", no lugar de blank, caso você esteja usando Phonegap / Cordova / Ionic ou qualquer um baseado em webview;
	}

	// ADD Enviar Pedido
	$("#modal_enviar_pedido").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var whatsapp = link.attr('whats');

        $(this).find("[name='mesa']").val(id);
        // $(this).find(".btn-imprimir-pedido").attr('href', ");
        if (whatsapp != '') {
        	$(this).find('.modal-footer').html('<a href="' + "<?php echo URLROOT ?>/mesas/imprimirPedido/" + id + '" target="_blank" style="font-weight: " class="btn btn-info btn-imprimir-pedido"><i class="fas fa-file"></i> Imprimir</a> OU \
	                    <button type="button" onclick="enviarMensagem(+55'+ whatsapp +', ' + id + ')" class="btn btn-success btn-whats"><i class="fab fa-whatsapp"></i> Enviar Por Whatsapp</button>')
        	// $(this).find(".btn-whats").attr('onclick', 'enviarMensagem(55'+whatsapp+', '+id+')');
        }else{
        	$(this).find('.modal-footer').html(' <a href="' + "<?php echo URLROOT ?>/mesas/imprimirPedido/" + id + '" target="_blank" style="font-weight: " class="btn btn-info btn-imprimir-pedido"><i class="fas fa-file"></i> Imprimir</a>')
        }
        

	
	});

	// ADD COMANDA
	$("#modal_add_comanda").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');

		if(link.attr("modal-size")!= undefined){
			$(this).find(".modal-dialog").attr('class', 'modal-dialog '+link.attr("modal-size"))
		} else{
			$(this).find(".modal-dialog").attr('class', 'modal-dialog')
		}

        $(this).find("[name='mesa']").val(id);
        $(this).find("[name='mesa']").attr('readonly');
        $(this).find('form').submit(function(){
        	$(this).find("[name='mesa']").removeAttr('disabled');
        })
	
	});

	// FECHAR COMANDA

	$("#modal_fechar_comanda").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var nome = link.attr('nome');
		var total = link.attr('total');
		var mesa = link.attr('mesa');
		var data = link.attr('data-registro');

        $(this).find('[name="id_comanda"]').val(id);
        $(this).find('[name="id_mesa"]').val(mesa);
        $(this).find('[name="total_comanda"]').val(total);
        $(this).find('.id_comanda').html(id);
        $(this).find('.id_mesa').html(mesa);
        $(this).find('.nome').html(nome);
        $(this).find('.data').html(data);
        $(this).find(".total-comanda").html('R$ ' + (total != '' ? total : 0.00));


	});

	$("#modal_fechar_comanda").on("hidden.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var mesa = link.attr('mesa');

		$(this).find('[name="id_comanda"]').val('');
        $(this).find('[name="total_comanda"]').val('');
        $(this).find('[name="id_mesa"]').val('');
        $(this).find('.id_comanda').html('');
        $(this).find('.id_mesa').html('');
        $(this).find('.nome').html('');
        $(this).find(".total-comanda").html('');

        
	});


	// ENCERRAR COMANDA

	$("#modal_cancelar_comanda").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var nome = link.attr('nome');
		var total = link.attr('total');
		var mesa = link.attr('mesa');
		var data = link.attr('data-registro');

		$(this).find('.id_comanda').html(id);
        $(this).find('[name="id_comanda"]').val(id);
        $(this).find('[name="id_mesa"]').val(mesa);

	});

	// PEDIDOS

	$("#modal_ver_pedidos").on("show.bs.modal", function(e) {
		$("#modal_ver_pedidos .tbody").html('');
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var nome = link.attr('nome');
		var data_registro = link.attr('data-registro');
		var mesa = link.attr('mesa');
		var inputsHidden = $("#modal_ver_pedidos .inputs-hidden-alter");
		

		$.ajax({
            type: "GET",
            url: "getPedido/" + id,  
            data: {},        
            dataType: "json",
            success: function (data) {
            	if (data != false) {
            		var tot = 0.00;
            		data.forEach(function(valor, chave){
            			$("#modal_ver_pedidos .tbody").append('\
            					<tr id_p="' + valor.id_pedido + '">\
									<td>#</td>\
									<td style="width: 60%">' + valor.descricao + '</td>\
									<td style="width: 15%"><input type="number" min="<?php if ($_SESSION['nivel'] != 1): ?>' + valor.quantidade + '<? else: ?>1<? endif; ?>" max="'+(parseInt(valor.quantidade) + parseInt(valor.estoque))+'" class="form-control form-control-sm" onchange="pedidoAlt(this.value , ' + valor.id_pedido + ',' + valor.valor +')" value="' + valor.quantidade + '" required=""></td>\
									<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
									<td style="width: 15%; <?php if ($_SESSION['nivel'] != 1): ?> display: none <?php endif; ?>"><a href="#" class="text-danger" id="' + chave + '" onclick="removePedido(' + valor.id_pedido + ',' + valor.valor + ')" style="border-radius: 25px;" title="Remover Produto"><i class="fa fa-minus"></i></a></td>\
								</tr>');
            			inputsHidden.append('<input type="hidden" name="pedidosAlter[' + valor.id_pedido + ']" value="' + valor.quantidade + '">');

            			tot = parseFloat(tot) + parseFloat(valor.valor) * valor.quantidade;
            		})

            		inputTotal.val(tot.toFixed(2));
	            	$("#modal_ver_pedidos .order-pedidos .total").html(tot.toFixed(2));
	            	$("#modal_ver_pedidos .order-pedidos .qtd").html(data.length);
	            	

            	}else{
            		$("#modal_ver_pedidos .order-pedidos .total").html(0.00);
	            	$("#modal_ver_pedidos .order-pedidos .qtd").html(0);
            	}


            },
            error: function(e) {
            	
            }
        });

		$("#modal_ver_pedidos .nome_cliente").html(nome);
    	$("#modal_ver_pedidos .num_com").html(id);
    	$("#modal_ver_pedidos .data").html(data_registro);
	});

	$("#modal_ver_pedidos").on("hidden.bs.modal", function(e) {
		// inputTotal.val('');
    	$("#modal_ver_pedidos .order-pedidos .total").html(0.00);
    	$("#modal_ver_pedidos .order-pedidos .qtd").html(0);
    	$("#modal_ver_pedidos .nome_cliente").html('');
    	$("#modal_ver_pedidos .num_com").html('');
    	$("#modal_ver_pedidos .data").html('');
	});

	function pedidoAlt(val, id_pedido, valor) {
		var tot = parseFloat($("#modal_ver_pedidos .order-pedidos .total").text());
		var t = $('#modal_ver_pedidos .inputs-hidden-alter [name="pedidosAlter[' + id_pedido + ']"]').val();
		tot = tot - parseFloat(valor * t);
		$("#modal_ver_pedidos .order-pedidos .total").html(tot);

		$('#modal_ver_pedidos .inputs-hidden-alter [name="pedidosAlter[' + id_pedido + ']"]').val(val);

		tot = parseFloat(tot) + parseFloat(valor * val);

		$("#modal_ver_pedidos .order-pedidos .total").html(tot.toFixed(2));

	}

	function removePedido(id_pedido, valor) {
		var tot = parseFloat($("#modal_ver_pedidos .order-pedidos .total").text());
		$('#modal_ver_pedidos .inputs-hidden-delete').append('<input type="hidden" name="pedidosDel[]" value="' + id_pedido + '">');
		var t = $('#modal_ver_pedidos .inputs-hidden-alter [name="pedidosAlter[' + id_pedido + ']"]').val();
		tot = tot - parseFloat(valor * t);

		$("#modal_ver_pedidos .order-pedidos .total").html(tot.toFixed(2));

		var qtd = parseInt($("#modal_ver_pedidos .order-pedidos .qtd").text());
		qtd = qtd - 1;
		$("#modal_ver_pedidos .order-pedidos .qtd").html(qtd);

		$("#modal_ver_pedidos .tbody [id_p='" + id_pedido +"']").remove();


	}

	// PRODUTOS

	var id_comanda;
	var id_mesa;
	var tbody = $("#modal_pedidos #tbody");
	var tbody_p = $("#modal_pedidos #tbody-produtos");
	var pedido = [];
	var notPedidos = [];
	var total = 0.00;
	var inputTotal = $("#modal_ver_pedidos [name='total']");

	function forProdutos() {
		$.ajax({
			type: "GET",
			url: "getProdutos/",
			data: {},
			dataType: "json",
			success: function (data) {

				if (data != false) {
					tbody.html('');

					if (notPedidos.length > 0) {
						data.forEach(function (valor, chave) {
							var aux = 0;
							notPedidos.forEach(function (v, c) {
								if (valor.id == v) {
									aux++;
								}
							});

							if (aux == 0) {
								if (valor.estoque > 0) {
									tbody.append('\
															<tr>\
																<td style="width: 70%">' + valor.descricao + '</td>\
																<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
																<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor + "'" + ',' + valor.estoque + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
															</tr>\
														')

								} else {
									tbody.append('\
															<tr class="bg-danger">\
																<td style="width: 70%">' + valor.descricao + '</td>\
																<td style="width: 30%">Sem estoque !</td>\
															</tr>\
														')
								}

							}
						});


					} else {
						data.forEach(function (valor, chave) {
							if (valor.estoque > 0) {
								tbody.append('\
												<tr>\
													<td style="width: 70%">' + valor.descricao + '</td>\
													<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
													<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor + "'" + ',' + valor.estoque + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
												</tr>\
											');
							} else {
								tbody.append('\
												<tr>\
													<td style="width: 50%">' + valor.descricao + '</td>\
													<td class="text-danger">Sem estoque !</td>\
												</tr>\
											');
							}

						});
					}


				} else {
					//alert('sme nad')
				}
			},
			error: function (e) {

			}
		});
	
	}

	$("#modal_pedidos").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var mesa = link.attr('mesa');

        $(this).find('[name="id_comanda"]').val(id);
        $(this).find('[name="id_mesa"]').val(mesa);
        id_comanda = id;
        id_mesa = mesa;

        forProdutos();
        
	});

	$("#modal_pedidos").on("hidden.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var mesa = link.attr('mesa');
		$(this).find('.inputs-hidden').html('');
        $(this).find('[name="id_comanda"]').val('');
        $(this).find('[name="id_mesa"]').val('');
        id_comanda = 0;
        id_mesa = 0;
        tbody.html('');
        tbody_p.html('');
        setTotal(0);
        setLength(0);
        notPedidos = [];
        pedido = [];
        total = 0.00;
        $(".order-produtos #total").html('R$ ' + 0.00);
		setLength();
        
	});

	$('input.query-input').on('keyup', function(){
		if ($(this).val().length == 0) {
			tbody.html('');
			$.ajax({
	            type: "GET",
	            url: "getProdutos/",  
	            data: {},        
	            dataType: "json",
	            success: function (data) {
	            	
	            	if (data != false) {
	                	tbody.html('');

	                		if (notPedidos.length > 0) {
	                			data.forEach(function(valor, chave){
	                				var aux = 0;
	                				notPedidos.forEach(function(v, c){
	                					if (valor.id == v) {
	                						aux++; 
	                					}
	                				});

									if (aux == 0) {
										if (valor.estoque > 0) {
											tbody.append('\
															<tr>\
																<td style="width: 70%">' + valor.descricao + '</td>\
																<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
																<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor +  "'" + ',' + valor.estoque  + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
															</tr>\
														')

										}else{
											tbody.append('\
															<tr class="bg-danger">\
																<td style="width: 70%">' + valor.descricao + '</td>\
																<td style="width: 30%">Sem estoque !</td>\
															</tr>\
														')
										}

									}
			                    });

	                			
	                		}else{
								data.forEach(function(valor, chave){
									if (valor.estoque > 0) {
										tbody.append('\
													<tr>\
														<td style="width: 70%">' + valor.descricao + '</td>\
														<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
														<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor + "'" + ',' + valor.estoque + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
													</tr>\
												');
									}else{
										tbody.append('\
													<tr>\
														<td style="width: 50%">' + valor.descricao + '</td>\
														<td class="text-danger">Sem estoque !</td>\
													</tr>\
												');
									}
										
			                    });
	                		}	    


					}else{
						//alert('sme nad')
					}
	            },
	            error: function(e) {
	            	
	            }
	        });
		}else{
			tbody.html('');
			$.ajax({
	            type: "GET",
	            url: "getProdutos/" + $(this).val(),  
	            data: {},        
	            dataType: "json",
	            success: function (data) {
	            	if (data != false) {
	                	tbody.html('');
	                		if (notPedidos.length > 0) {
	                			data.forEach(function(valor, chave){
	                				var aux = 0;
	                				notPedidos.forEach(function(v, c){
	                					if (valor.id == v) {
	                						aux++; 
	                					}
	                				});

									if (aux == 0) {
										if (valor.estoque > 0) {
											tbody.append('\
															<tr>\
																<td style="width: 70%">' + valor.descricao + '</td>\
																<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
																<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor +  "'" + ',' + valor.estoque  + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
															</tr>\
														')

										}else{
											tbody.append('\
															<tr class="bg-danger">\
																<td style="width: 70%">' + valor.descricao + '</td>\
																<td style="width: 30%">Sem estoque !</td>\
															</tr>\
														')
										}

									}
			                    });

	                			
	                		}else{
								data.forEach(function(valor, chave){
									if (valor.estoque > 0) {
										tbody.append('\
													<tr>\
														<td style="width: 70%">' + valor.descricao + '</td>\
														<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
														<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor + "'" + ',' + valor.estoque + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
													</tr>\
												');
									}else{
										tbody.append('\
													<tr>\
														<td style="width: 50%">' + valor.descricao + '</td>\
														<td class="text-danger">Sem estoque !</td>\
													</tr>\
												');
									}
										
			                    });
	                		}	    


					}else{
						//alert('sme nad')
					}
	            },
	            error: function(e) {
	            	
	            }
	        });
		}
	});

	function forPedidos() {
		pedido.forEach(function(valor, chave){
			tbody_p.append('<tr>\
								<td>' + (chave+1) + '</td>\
								<td style="width: 60%">' + valor.descricao + '</td>\
								<td style="width: 15%"><input type="number" min="1" max="' + valor.estoque + '" class="form-control form-control-sm input-p" onkeyup="altQtd(this.value , ' + valor.id + ',' + valor.valor + ',' + chave + ',' + valor.estoque +  ')" onchange="altQtd(this.value , ' + valor.id + ',' + valor.valor + ',' + chave + ',' + valor.estoque +  ')" value="' + valor.qtd + '" required=""></td>\
								<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
								<td style="width: 15%"><a href="#" class="text-danger" id="' + chave + '" onclick="removeItem(' + chave + ',' + valor.id + ',' + valor.valor + ')" style="border-radius: 25px;"><i class="fa fa-minus"></i></a></td>\
							</tr>');
		});
	
	}

	function altQtd(val, id_produto, valor, chave, max) {
		if (val >= 1 && val <= max) {
			pedido[chave].qtd = val;
			var t = $('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val();
			setTotal(-(valor * (parseInt(t))))
			$('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val(val)
			setTotal(valor * (parseInt(val)))
		}else{
			$("#modal_pedidos .input-p").val(max);
			val = max;
			pedido[chave].qtd = val;
			var t = $('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val();
			setTotal(-(valor * (parseInt(t))))
			$('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val(val)
			setTotal(valor * (parseInt(val)))
		}
		
		// alert(t);
	
	}

	function addItem(id, id_produto, descricao, valor, estoque){
		
		notPedidos.push(id_produto);
		pedido.push({'id' : id_produto, 'descricao' : descricao, 'valor': valor, 'qtd' : 1, 'estoque' : estoque});
		tbody_p.html('');
		forPedidos();
		setTotal(valor);
		setLength();
		tbody.html('');
		$('input.query-input').val('');

		$("#modal_pedidos .inputs-hidden").append('<input type="hidden" name="pedidos[' + id_produto + ']" value="1">')
		forProdutos();

	}

	function removeItem(id, id_produto, valor) {
		tbody_p.html('');
		var t = $('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val();
		setTotal(-(valor * (parseInt(t))))
		removeArray(id);
		removeArrayNotPedidos(id_produto);
		$('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').remove();
		setLength();
		forPedidos();
		forProdutos();
	
	}

	function removeArray(index) {
	    //const index = pedido.indexOf(element);
	    if (index !== -1) {
	        pedido.splice(index, 1);
	    }
	
	}

	function removeArrayNotPedidos(element) {
	    const index = notPedidos.indexOf(element);
	    if (index !== -1) {
	        notPedidos.splice(index, 1);
	    }
	
	}

	function getTotal() {
		return total.toFixed(2);
	}

	function setTotal(valor) {
		total = (parseFloat(total) + parseFloat(valor));

		$(".order-produtos #total").html('R$ ' + getTotal());
	
	}

	function setLength() {
		$(".order-produtos #qtd").html(pedido.length);
	}

</script>