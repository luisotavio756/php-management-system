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
					<?php echo flash('mesas'); ?>
				</div>
				<!-- <div class="col-12 text-right">
					<a href="#adicionar_mesa" data-toggle="modal" class="btn btn-success btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-plus"></i>
						</span>
						<span class="text">Adicionar Mesa</span>
					</a>
				</div> -->
				<div class="col-12 mt-4">
					<div class="row">
						<?php foreach ($data['mesas'] as $key => $value): ?>
							<div class="col-xl-4 col-md-6 mb-4">
								<div class="card border-left-<?php echo $value->status == 1 ? 'danger' : 'success' ?> shadow h-100 py-2">
									<div class="card-body">

										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $value->descricao ?></div>
												<p class="my-0 text-<?php echo $value->status == 1 ? 'danger' : 'success' ?>"><?php echo $value->status == 1 ? 'Ocupada' : 'Disponível' ?></p>

											</div>
											<div class="col-auto">
												<div class="dropdown no-arrow">
													<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end">
														<?php if ($value->status == 1): ?>
															<a class="dropdown-item" href="#">Comanda Ativa</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Link 2</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Link 3</a>
														<?php else: ?>
															<a class="dropdown-item" href="#modal_add_comanda" data-toggle="modal">Adicionar Comanda</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Ultimas Comandas</a>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="#">Link 3</a>
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
	<div class="modal fade" id="modal_add_comanda" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog modal-xl" role="document" style="">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Adicionar Comanda</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="" method="post" enctype="multpart/form-data">
	            	<div class="inputs-hidden">
	            		
	            	</div>
	                <div class="modal-body" style="height: 470px">
	                	<div class="row">
	                		<div class="col-6 px-2">
			                	<div class="row">
									<div class="col-lg-10 mb-3 mb-lg-0">
	                					<h4 class="text-center">Produtos</h4>
										<input type="text" min="0" name="num" class="form-control query-input mt-4" placeholder="Digite o nome do Produto.." required="">
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


<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript">
	// $("#modal_add_comanda").modal('show');
	var tbody = $("#tbody");
	var tbody_p = $("#tbody-produtos");
	var pedido = [];
	var total = 0.00;
	forPedidos();
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

						data.forEach(function(valor, chave){
							tbody.append('\
											<tr>\
												<td style="width: 70%">' + valor.descricao + '</td>\
												<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
												<td><a href="#" class="btn btn-success btn-xs add-item" id="' + chave + '" style="border-radius: 25px;"><i class="fa fa-plus"></i></a></td>\
											</tr>\
										')
	                    });

						$(".add-item").click(function(){
							var id = $(this).attr('id');
							pedido.push({id : id, descricao : data[id].descricao, valor: data[id].valor});
							tbody_p.html('');

							forPedidos();
							setTotal(data[id].valor);
							setLength();
							tbody.html('');
							$('input.query-input').val('');

							//alert(JSON.stringify(pedido));

						})



					}else{
						alert('sme nad')
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
								<td style="width: 15%"><input type="number" min="1" class="form-control form-control-sm" value="1" required=""></td>\
								<td style="width: 25%" class="text-center">R$ ' + valor.valor + '</td>\
								<td style="width: 15%"><a href="#" class="text-danger" id="' + chave + '" onclick="removeItem(' + chave + ')" style="border-radius: 25px;"><i class="fa fa-minus"></i></a></td>\
							</tr>');
		});
	
	}

	function removeItem(id) {
		tbody_p.html('');
		setTotal(-pedido[id].valor);
		removeArray(id);
		setLength();
		forPedidos();
	
	}

	function removeArray(index) {
	    //const index = pedido.indexOf(element);
	    if (index !== -1) {
	        pedido.splice(index, 1);
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