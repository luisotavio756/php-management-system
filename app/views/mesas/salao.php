<?php require_once APPROOT . '/views/inc/header.php'; ?>
	<style type="text/css">
		table tbody td{
			padding-left: 5px !important;
    		padding-top: 7px !important;
    		vertical-align: baseline !important;
    		font-weight: 700;
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
							<div class="col-xl-4 col-md-6 mb-4">
								<div class="card border-left-<?php echo $value->status == 1 ? 'danger' : 'success' ?> shadow h-100 py-2">
									<div class="card-body">

										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $value->descricao ?>
												<?php echo $value->status == 1 && !empty($value->id_comanda) ? " --- Comanda <b>$value->id_comanda</b>" : "" ?> </div>
												<p class="my-0 text-<?php echo $value->status == 1 ? 'danger' : 'success' ?>"><?php echo $value->status == 1 ? 'Ocupada' : 'Disponível' ?></p>

											</div>
											<div class="col-auto">
												<div class="dropdown no-arrow">
													<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end">
														<?php if ($value->status == 1): ?>
															<a class="dropdown-item" href="#modal_pedidos" data-toggle="modal" id="<?php echo $value->id_comanda ?>" mesa="<?php echo $value->id ?>">Comanda Ativa</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Ver Pedido</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Fechar Comanda</a>
														<?php else: ?>
															<a class="dropdown-item" href="#modal_add_comanda" id="<?php echo $value->id ?>" data-toggle="modal">Adicionar Comanda</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Ultimas Comandas</a>
														<?php endif; ?>
													</div>
												</div>
											</div>
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
	                <h5 class="modal-title" id="exampleModalLabel">Adicionar Comanda</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="<?php echo URLROOT ?>/mesas/adicionarPedido/" method="POST" enctype="multpart/form-data">
	            	<input type="hidden" name="id_comanda" value="">
	            	<input type="hidden" name="id_mesa" value="">
	            	<div class="inputs-hidden"></div>
	                <div class="modal-body" style="height: 470px">
	                	<div class="row">
	                		<div class="col-6 px-2">
			                	<div class="row">
									<div class="col-lg-10 mb-3 mb-lg-0">
	                					<h4 class="text-center">Produtos</h4>
										<input type="text" class="form-control form-control-user query-input mt-4" placeholder="Digite o nome do Produto..">
									</div>
									<div class="col-11" style="height: 297px; overflow-y: auto;">
										<table class="table mt-4">
	                						<tbody id="tbody">
	                							
	                						</tbody>
	                					</table>
									</div>	
								</div>
	                			
	                		</div>	
	                		<div class="col-6">
	                			<div class="row">
	                				<div class="col-12" style="height: 350px; overflow-y: auto;">
	                				<h4 class="text-center">Pedidos</h4>
	                					<table class="table mt-4">
	                						<tbody id="tbody-produtos">
	               							
	                						</tbody>
	                						
	                					</table>
	                				</div>
	                			</div>	                			
	                		</div>		           
	                	</div>
	                	<div class="col-6 order-produtos" style="position: absolute;bottom: 0px;right: 0px;">
	                		<div class="row">
	                			<div class="col-2">
	                				<h6>Qtd: <b id="qtd"></b></h6>
	                			</div>
	                			<div class="col-9 text-right">
	                				<h6>Valor: <b id="total"></b></h6>
	                			</div>
	                		</div>
	                	</div>	
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-warning">Salvar Alterações <i class="fas fa-edit"></i></button>
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
							<!-- <div class="col-lg-3 mb-3 mb-lg-0">
								<label>Num:</label>
								<input type="number" min="0" name="num" class="form-control form-control-user" placeholder="Código" required="">
							</div> -->
							<div class="col-lg-7">
								<label>Cliente(Opcional):</label>
								<input type="text" name="cliente" class="form-control form-control-user" placeholder="Nome do Cliente.." >
							</div>
							<div class="col-lg-5">
								<label>Mesa:</label>
								<select class="form-control form-control-user" disabled="" name="mesa" required="">
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


<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript">
	var id_comanda;
	var id_mesa;
	var tbody = $("#tbody");
	var tbody_p = $("#tbody-produtos");
	var pedido = [];
	var notPedidos = [];
	var total = 0.00;
	// forPedidos();

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

	$("#modal_pedidos").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');
		var mesa = link.attr('mesa');

        $(this).find('[name="id_comanda"]').val(id);
        $(this).find('[name="id_mesa"]').val(mesa);
        id_comanda = id;
        id_mesa = mesa;
        
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
        
	});


	$('input.query-input').on('keyup', function(){
		if ($(this).val().length == 0) {
			tbody.html('');
		}else{
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
										tbody.append('\
														<tr>\
															<td style="width: 70%">' + valor.descricao + '</td>\
															<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
															<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor + "'" + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
														</tr>\
													')

									}
			                    });

	                			
	                		}else{
								data.forEach(function(valor, chave){
									tbody.append('\
													<tr>\
														<td style="width: 70%">' + valor.descricao + '</td>\
														<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
														<td>' + '<a href="#" class="btn btn-success btn-xs" onclick="addItem(' + chave + ',' + valor.id + ',' + "'" + valor.descricao + "'" + ',' + "'" + valor.valor + "'" + ')" style="border-radius: 25px;"><i class="fa fa-plus"></i></a>' + '</td>\
													</tr>\
												');	
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
								<td style="width: 15%"><input type="number" min="1" class="form-control form-control-sm" onchange="altQtd(this.value , ' + valor.id + ',' + valor.valor + ',' + chave +  ')" value="' + valor.qtd + '" required=""></td>\
								<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
								<td style="width: 15%"><a href="#" class="text-danger" id="' + chave + '" onclick="removeItem(' + chave + ',' + valor.id + ',' + valor.valor + ')" style="border-radius: 25px;"><i class="fa fa-minus"></i></a></td>\
							</tr>');
		});
	
	}

	function altQtd(val, id_produto, valor, chave) {
		pedido[chave].qtd = val;
		var t = $('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val();
		setTotal(-(valor * (parseInt(t))))
		$('#modal_pedidos .inputs-hidden [name="pedidos[' + id_produto + ']"]').val(val)
		setTotal(valor * (parseInt(val)))
		
		// alert(t);
	}

	function addItem(id, id_produto, descricao, valor){
		
		notPedidos.push(id_produto);
		pedido.push({'id' : id_produto, 'descricao' : descricao, 'valor': valor, 'qtd' : 1});
		tbody_p.html('');
		forPedidos();
		setTotal(valor);
		setLength();
		tbody.html('');
		$('input.query-input').val('');

		$("#modal_pedidos .inputs-hidden").append('<input type="hidden" name="pedidos[' + id_produto + ']" value="1">')

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