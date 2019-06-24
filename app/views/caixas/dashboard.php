<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php (isset($_SESSION['id_caixa']) ? $h = 200 : $h = 100); ?>
<?php  
	// echo "<pre>";
	// print_r($data);
	
?>
	<div class="row">
		<div class="col-12">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Caixa - Dashboard</h1>
			</div>
		</div>
		<div class="col-12">
			<?php echo flash("caixa"); ?>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Receitas (Hoje)</div>
							<div class="h5 mb-0 font-weight-bold text-success">R$<?php echo str_replace('.',',', number_format($data['receitas'], 2, '.', '')) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Despesas (Hoje)</div>
							<div class="h5 mb-0 font-weight-bold text-danger">R$<?php echo str_replace('.',',', number_format($data['despesas'], 2, '.', '')) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Saldo Inicial(Hoje)</div>
							<div class="h5 mb-0 font-weight-bold text-info">R$<?php echo str_replace('.',',', number_format($data['saldo_inicial'], 2, '.', '')) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Saldo Final(Hoje)</div>
							<div class="h5 mb-0 font-weight-bold text-warning">R$<?php echo str_replace('.',',', number_format($data['saldo_final'], 2, '.', '')) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="text-center" style="position: absolute; z-index: 999; right: 30px; bottom: 40px; width: 180px">
	    <div class="panel-action mb-2" style="display: none;  height: <?= $h ?>px;background-color: #ffffff;border-radius: 10px;box-shadow: -1px 0px 20px 2px #b7b9cc;" class="mb-2 w-100"> 
	        <?php if (isset($_SESSION['id_caixa'])): ?>
		        <div style="height: 25%" class="d-flex align-items-center">
		            <a style="font-size: 16.5px; font-weight: 700" class="btn text-success mx-auto" href="#modal_receita_caixa" data-toggle="modal"><i style="font-size: 13px" class="fa fa-plus"></i> Receita</a>
		        </div>
		        <hr class="my-0 py-0">
		        <div style="height: 25%" class="d-flex align-items-center">
		            <a style=" font-size: 16.5px; font-weight: 700" class="btn text-danger mx-auto" href="#modal_despesa_caixa" data-toggle="modal"><i style="font-size: 13px" class="fa fa-minus"></i> Despesa</a>
		        </div>
		        <hr class="my-0 py-0">
		        <div style="height: 25%" class="d-flex align-items-center">
		            <a style=" font-size: 16.5px; font-weight: 700" class="btn text-info mx-auto" href="#modal_saldo_caixa" data-toggle="modal"><i style="font-size: 13px" class="fas fa-file-excel"></i> Saldo Detalhado</a>
		        </div>
		        <hr class="my-0 py-0">
		        <div style="height: 25%" class="d-flex align-items-center">
		            <a style=" font-size: 16.5px; font-weight: 700" class="btn text-secondary mx-auto" href="#modal_fechar_caixa" data-toggle="modal"><i style="font-size: 13px" class="fa fa-lock"></i> Fechar Caixa</a>
		        </div>
	        <?php else: ?>
	        <hr class="my-0 py-0">
		        <div style="height: 50%" class="d-flex align-items-center">
		            <a style=" font-size: 16.5px; font-weight: 700" class="btn text-success mx-auto" href="#modal_abrir_caixa" data-toggle="modal"><i style="font-size: 13px" class="fa fa-lock"></i> Abrir novo Caixa</a>
		        </div>
		        <div style="height: 50%" class="d-flex align-items-center">
		            <a style=" font-size: 16.5px; font-weight: 700" class="btn text-secondary mx-auto" href="#modal_befores_caixa" data-toggle="modal"><i style="font-size: 13px" class="fas fa-archive"></i> Caixas Anteriores</a>
		        </div>
		    <?php endif; ?>
	    </div>
	    <button id="btn-actions" style="background-color: #496fdc;" type="button" class="btn btn-circle btn-lg"><i style="color: white" class="fas fa-plus"></i></button>
	</div>
    <?php if (!isset($_SESSION['id_caixa'])): ?>
	    <div class="modal fade" id="modal_abrir_caixa" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Abrir Caixa</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <form class="user" action="<?php echo URLROOT; ?>/caixas/openCaixa" method="POST" enctype="multpart/form-data">
	                    <div class="modal-body">
	                        <div class="form-group row">
								<div class="col-lg-12">
									<label>Saldo Inicial:</label>
									<input type="text" name="saldoInicial" class="form-control form-control-user money" placeholder="R$ Digite o Saldo Inicial do Caixa.." required="">
								</div>
							</div>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                        <button type="submit" class="btn btn-info">Confirmar <i class="fas fa-check-circle"></i></button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <div class="modal fade" id="modal_befores_caixa" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Caixas Anteriores</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <form class="user" action="" method="POST" enctype="multpart/form-data">
	                    <div class="modal-body" style="height: 400px; overflow-x:auto;">
	                    	<div id="data-befores-caixa">
		                    	<table class="table" style="font-size: 15px">
		                    		<thead>
		                    			<tr>
		                    				<th class="text-center">#</th>
											<th class="text-center">Data Aberto</th>
											<th class="text-center">Data Fechado</th>
											<th class="text-center">Ações</th>
		                    			</tr>
		                    		</thead>
		                    		<tbody>
		                    			<?php if ($data['caixas']): ?>
			                    			<?php foreach ($data['caixas'] as $key => $value): ?>
			                    				<tr>
				                    				<td class="text-center"><?php echo $value->id ?></td>
													<td class="text-center"><?php echo toBrDateTime($value->data_aberto) ?></td>
													<td class="text-center"><?php echo toBrDateTime($value->data_fechado) ?></td>
													<td class="text-center">
														<a style="border-radius: 30px" id="saldo-detalhado" class="btn btn-info" href="#" cod="<?php echo $value->id ?>" nome="<?php echo $value->nome.' '.$value->sobrenome ?>" data="<?php echo toBrDateTime($value->data_aberto) ?>" sI="<?php echo $value->saldo_inicial ?>" sF="<?php echo $value->saldo_final ?>" title="Mais Ações">Info 
															<i class="fas fa-chevron-circle-right"></i>
															<!-- <i class="fas fa-file-excel"></i> -->
														</a>
													</td>
				                    			</tr>
			                    			<?php endforeach ?>		                    
		                    			<?php endif ?>
		                    		</tbody>
		                    	</table>
	                    	</div>
	                    	<div id="data-befores-movimentos" style="display: none">
	                    		<div class="row mt-2 mb-3">
	                    			<div class="col-4">
	                    				<h6>ID Caixa: <b id="idC"></b></h6>
	                    			</div>
	                    			<div class="col-4">
	                    				<h6>Aberto por: <b id="User">Luis Otávio</b></h6>
	                    			</div>
	                    			<div class="col-4">
	                    				<h6>Data: <b id="Dat"></b></h6>
	                    			</div>
	                    		</div>
	                    		<table class="table table-movimentos" style="font-size: 15px">
		                    		<thead>
		                    			<tr>
		                    				<th class="text-center center">#</th>
											<th>Descrição</th>
											<th class="text-center center">Modo</th>
											<th class="text-center center">Tipo</th>
											<th class="text-center center">Valor</th>
		                    			</tr>
		                    		</thead>
		                    		<tfoot>

		                    		</tfoot>
		                    		<tbody>		                    					           
		                    			
		                    		</tbody>
		                    	</table>
	                    	</div>
	                    	<div id="data-trash-caixa" style="display: none">
	                    		<div class="row">
		                            <div class="col-12 my-3 text-center">
		                                <h5 class="mb-0"><b>Deseja Realmente encerrar este Caixa ?</b></h5>
		                                <p class="mt-1 text-danger" style="font-size: 15px; font-weight: 600">OBS: A ação não poderá ser desfeita</p>
		                            </div>
		                        </div>
	                    	</div>
	                    </div>
	                    <div class="modal-footer">
	                    	<button type="button" class="btn btn-info mr-auto" id="btn-voltar" style="display: none"><i class="fas fa-chevron-circle-left"></i> Voltar</button>
	                        <!-- <button type="button" class="btn btn-danger btn-trash" style="display: none"><i class="fas fa-trash"></i> Apagar Caixa</button> -->
	                    	<a href="#" target="_blank" class="btn btn-success btn-download" style="display: none"><i class="fas fa-file-excel"></i> Download</a>
	                        <button type="button" class="btn btn-secondary btn-back" data-dismiss="modal">Fechar</button>	       
	                        <a href="#" id="btn-trash-caixa" ste="0" class="btn btn-danger" style="display: none"><i class="fas fa-trash"></i></a>
	                        <!-- Confirmar e Apagar Caixa -->
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
    <?php else: ?>
    	<div class="modal fade" id="modal_receita_caixa" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Nova Receita</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>	
	                    <div class="modal-body" style="max-height: 400px; overflow-x:auto;">
	                    	<!-- <nav class="nav-caixa" style="margin-top: -10px">
								<div id="myTab" class="nav nav-tabs" role="tablist">
									<a class="nav-item nav-link active" id="receita_normal" data-toggle="tab" href="#nav-receita-simples" role="tab" aria-controls="nav-receita-simples" aria-selected="true">Receita Normal</a>
									<a class="nav-item nav-link" id="comandas" data-toggle="tab" href="#nav-comandas" role="tab" aria-controls="nav-comandas" aria-selected="false">Comandas</a>
								</div>
							</nav> -->
							<div class="tab-content mt-0" id="nav-tabContent">
								<div class="tab-pane fade show active col-12 pt-3" id="nav-receita-simples" role="tabpanel" aria-labelledby="receita_normal">
									<form class="user receita_normal" action="<?php echo URLROOT; ?>/caixas/insertReceita/" method="POST" enctype="multpart/form-data" >
										<input type="hidden" name="action" value="1">
										<div class="form-group row">
											<div class="col-lg-8 mb-3 mb-lg-0">
												<label>Descrição:</label>
												<input type="tel" name="descricao" class="form-control form-control-user" placeholder="Descreve sobre esta receita.." required="">
												<div class="invalid-feedback"></div>
											</div>
											<div class="col-lg-4">
												<label>Valor:</label>
												<input type="text" name="valor" class="form-control form-control-user money" placeholder="R$ Valor da Receita.." required="">
												<div class="invalid-feedback"></div>
											</div>
											<div class="col-lg-12 text-right mt-4">
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
									</form>
								</div>
								<!-- <div class="tab-pane fade col-12 pt-3" id="nav-comandas" role="tabpanel" aria-labelledby="comandas">
									<form class="user comandas" action="<?php echo URLROOT; ?>/caixas/insertReceita/" method="POST" enctype="multpart/form-data" >
										<input type="hidden" name="action" value="1">
										<div class="form-group row">
											<div class="col-lg-5 mb-3 mb-lg-0">
												<label>Digite o numero da comanda:</label>
												<input style="font-size: 1rem; padding: 1.2rem 1rem" type="tel" name="n_comanda" class="form-control form-control-user" placeholder="N° Comanda.." required="">
											</div>
											<div class="col-lg-3 d-flex align-items-end">
												<a href="#" class="btn btn-info btn-icon-split">
													<span class="icon text-white-50">
														<i class="fas fa-search"></i>
													</span>
													<span class="text">Consultar</span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<h6>Cliente: <b>Luis Otávio Lima Caminha</b></h6>
											</div>
											<div class="col-lg-3">
												<h6>Comanda: <b>123</b></h6>
											</div>
											<div class="col-lg-3">
												<h6>Horário: <b>Hoje as 12:34:34</b></h6>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<table id="table-pro" style="max-height: 85%; overflow-y: auto" class="table table-hover table-striped">
													<thead>
														<tr>
															<th class="text-center">#</th>
															<th>Pedidos</th>
															<th class="text-center">Qtd.</th>
															<th class="text-center">Valor</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th  class="text-center">5</th>
															<th  class="text-center">---------</th>
															<th  class="text-center">---------</th>
															<th  class="text-center">R$ 77,00</th>
														</tr>
													</tfoot>
													<tbody>
														<tr>
															<td class="text-center">1</td>
															<td>Hamburguer</td>
															<td class="text-center">2x</td>
															<td class="text-center">R$ 10,00</td>
														</tr>
														<tr>
															<td class="text-center">2</td>
															<td>Refrigerante Pepsi 1L</td>
															<td class="text-center">2x</td>
															<td class="text-center">R$ 9,00</td>
														</tr>
														<tr>
															<td class="text-center">3</td>
															<td>Bata Frita Porção</td>
															<td class="text-center">2x</td>
															<td class="text-center">R$ 13,00</td>
														</tr>
														<tr>
															<td class="text-center">4</td>
															<td>Cerveja Skol 300ml</td>
															<td class="text-center">2x</td>
															<td class="text-center">R$ 10,00</td>
														</tr>
														<tr>
															<td class="text-center">1</td>
															<td>Cerveja Boemia 300ml</td>
															<td class="text-center">10x</td>
															<td class="text-center">R$ 35,00</td>
														</tr>
													</tbody>
												</table>
											</div>	
										</div>
									</form>
								</div> -->
							</div>	  	             
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                        <button id="button-submit-form" type="button" class="btn btn-success">Confirmar <i class="fas fa-check-circle"></i></button>
	                    </div>
	            </div>
	        </div>
	    </div>
	    <div class="modal fade" id="modal_despesa_caixa" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Nova Despesa</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                 <form class="user" action="<?php echo URLROOT; ?>/caixas/insertDespesa/" method="POST" enctype="multpart/form-data">
	                    <div class="modal-body">
	                        <div class="form-group row">
								<div class="col-lg-8 mb-3 mb-lg-0">
									<label>Descrição:</label>
									<input type="tel" name="descricao" class="form-control form-control-user" placeholder="Descreve sobre esta Despesa.." required="">
								</div>
								<div class="col-lg-4">
									<label>Valor:</label>
									<input type="text" name="valor" class="form-control form-control-user money" placeholder="R$ Valor da Despesa.." required="">
								</div>
								<div class="col-lg-12 text-right mt-4">
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" checked="" id="customRadioInline3" name="modo_pagamento" class="custom-control-input" value="1">
										<label class="custom-control-label" for="customRadioInline3"><i class="fas fa-dollar-sign"></i> Dinheiro</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="customRadioInline4" name="modo_pagamento" class="custom-control-input" value="2">
										<label class="custom-control-label" for="customRadioInline4"><i class="far fa-credit-card"></i> Cartão</label>
									</div>
								</div>
							</div>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                        <button type="submit" class="btn btn-danger">Confirmar <i class="fas fa-check-circle"></i></button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <div class="modal fade" id="modal_fechar_caixa" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Encerrar Caixa</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <form class="user" action="<?php echo URLROOT . '/caixas/closeCaixa/' . $_SESSION['id_caixa'] ?>" method="POST" enctype="multpart/form-data">
	                    <div class="modal-body">
	                        <div class="row">
	                            <div class="col-12 my-3">
	                                <h5 class="mb-0"><b>Deseja Realmente encerrar este Caixa ?</b></h5>
	                                <p class="mt-1" style="font-size: 15px">OBS: A ação não poderá ser desfeita</p>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                        <button type="submit" class="btn btn-info">Confirmar <i class="fas fa-check-circle"></i></button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <div class="modal fade" id="modal_saldo_caixa" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Saldo Detalhado</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                 <form class="user" action="<?php echo URLROOT; ?>/caixas/insertDespesa/" method="POST" enctype="multpart/form-data">
	                    <div class="modal-body" style="max-height: 400px; overflow-x:auto;">
	                    	<table class="table">
	                    		<thead>
	                    			<tr>
	                    				<th class="text-center center">#</th>
										<th>Descrição</th>
										<th class="text-center center">Modo</th>
										<th class="text-center center">Tipo</th>
										<th class="text-center center">Valor</th>
	                    			</tr>
	                    		</thead>
	                    		<tfoot>
	                    			<tr style="background-color: #bfffc2; color: #333">
	                    				<th class="text-center center">---</th>
										<th>Saldo Final</th>
										<th class="text-center center">---</th>
										<th class="text-center center">---</th>
										<th class="text-center center">R$ <?php echo str_replace('.',',', number_format($data['saldo_final'], 2, '.', '')) ?></th>
	                    			</tr>
	                    		</tfoot>
	                    		<tbody>
	                    			<tr>
										<td class="text-center">----</td>
										<td>Saldo Inicial</td>
										<td class="text-center">----</td>
										<td class="text-center">----</td>
										<td class="text-center">R$ <?php echo str_replace('.', ',', $data['saldo_inicial']) ?></td>
									</tr>
	                    			<?php if ($data['movimentos']): ?>
				                    	<?php 
				                    		$cont = 1;
				                    		foreach ($data['movimentos'] as $key => $value) :
				                    	?>
				                    		<tr style="color: <?php echo $value->tipo == 1 ? '#1cc88a' : '#e74a3b'; ?> !important; font-weight: 600">
												<td class="text-center"><?php echo $cont ?></td>
												<td><?php echo $value->descricao ?></td>
												<td class="text-center"><?php echo ($value->modo_pagamento == 1 ? "Dinheiro" : "Cartão") ?></td>
												<td class="text-center"><?php echo ($value->tipo == 1 ? "Receita" : "Despesa") ?></td>
												<td class="text-center"><?php echo $value->tipo == 1 ? '+' : '-'; ?> R$ <?php echo str_replace('.', ',', $value->valor) ?></td>
											</tr>
				                    	<?php 
				                    		$cont++;
				                    		endforeach; 
				                    	?>
	                    			<?php endif ?>
	                    			
	                    		</tbody>
	                    	</table>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	<?php endif; ?>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript">
	var form = 'receita_normal';

	$('#myTab a').on('click', function (e) {
		form = $(this).attr("id");
	})

	$("#button-submit-form").on('click', function(){
		if(verificarInputs()){
			$(".modal-body .tab-content .tab-pane > ." + form).submit();
		}
		
	})

    $(".modal-body .tab-content .tab-pane > ." + form + " input").on("change keyup", function (){
        $(this).removeClass('is-invalid')
        $(this).parent().find('.invalid-feedback').html('')
    })

    function verificarInputs() {
        var $inputs = $(".modal-body .tab-content .tab-pane > ." + form + " input"),
            $button = $("#button-submit-form")
            ;

        var limpos = 0;

        // verificação inicial
        var array = [];
        $inputs.each(function () {
            var $this = $(this);
            var val = $this.val();
            if ($this.val() == '') {
                array.push($this.attr('name'))
            }
            val || limpos++;
            $this.data("val-antigo", val);
        
        });
      
        if (limpos == 0) {
            return true;
        }
        else{
            // alert(JSON.stringify(array))
            array.forEach(function(valor, chave){   
                $('[name="'+ valor +'"]').addClass('is-invalid')
                $('[name="'+ valor +'"]').parent().find('.invalid-feedback').html('Campo Obrigatório')
            });     

            return false;
        }
    
    }
    var link = '#';
    var t = 0;
    $("#modal_befores_caixa  #saldo-detalhado").click(function(){
    	var id = $(this).attr('cod');
    	var nome = $(this).attr('nome');
    	var date = $(this).attr('data');
    	var sI = $(this).attr('sI');
    	var sF = $(this).attr('sF');

    	$.ajax({
            type: 'GET',
            url: 'getMovimentos/' + id,
            dataType: 'json',

	        // Antes de carregar os registros, mostra para o usuário que está
	        // sendo carregado.
	        beforeSend: function(xhr) {
	            

	        },
	        // Após carregar, coloca a lista dentro do select de cidades.
	        success: function(data) {
	        	var data_movimentos;
	        	if (data != false) {
	        		$("#data-befores-caixa, #modal_befores_caixa .btn-back").hide();

	        		for (var i = 0; i <= data.length - 1; i++) {
	        			data_movimentos +=
	        			'<tr style="color: ' + (data[i].tipo == 1 ? "#1cc88a" : "#e74a3b") + ' !important; font-weight: 600">\
							<td class="text-center">' + (i + 1) + '</td>\
							<td>' + data[i].descricao + '</td>\
							<td class="text-center">' + (data[i].modo_pagamento == 1 ? "Cartão" : "Dinheiro") + '</td>\
							<td class="text-center">' + (data[i].tipo == 1 ? "Receita" : "Despesa") + '</td>\
							<td class="text-center">' + (data[i].tipo == 1 ? "+ " : "- ") + data[i].valor +'</td>\
						</tr>';
	        		}
	        		//Data Caixa

	        		$("#modal_befores_caixa #idC").html(id);
	        		$("#modal_befores_caixa #User").html(nome);
	        		$("#modal_befores_caixa #Dat").html(date);

	        		//Saldos
	        		$("#data-befores-movimentos .table-movimentos tbody").append(
	        							'<tr>\
											<td class="text-center">----</td>\
											<td>Saldo Inicial</td>\
											<td class="text-center">----</td>\
											<td class="text-center">----</td>\
											<td class="text-center">R$ ' + sI + '</td>\
										</tr>');

	        		$("#data-befores-movimentos .table-movimentos tfoot").append(
	        							'<tr style="background-color: #bfffc2; color: #333">\
											<td class="text-center">----</td>\
											<td>Saldo Final</td>\
											<td class="text-center">----</td>\
											<td class="text-center">----</td>\
											<td class="text-center">R$ ' + sF + '</td>\
										</tr>');

	        		//Set
	        		$("#data-befores-movimentos .table-movimentos tbody").append(data_movimentos);
	        		$("#data-befores-movimentos").fadeIn();
	        		$("#modal_befores_caixa #btn-voltar, #modal_befores_caixa .btn-download, #modal_befores_caixa #btn-trash-caixa").fadeIn();
	        		$("#modal_befores_caixa .btn-download").attr("href", "<?php echo URLROOT ?>" + "/caixas/pdf/" + id + "/Caixa");
	        		link = "<?php echo URLROOT ?>" + "/caixas/deleteCaixa/" + id;
	        		

	        	}else{
	        		$("#data-befores-caixa, #modal_befores_caixa .btn-back").hide();
	        		//Data Caixa

	        		$("#modal_befores_caixa #idC").html(id);
	        		$("#modal_befores_caixa #User").html(nome);
	        		$("#modal_befores_caixa #Dat").html(date);

	        		//Saldos
	        		$("#data-befores-movimentos .table-movimentos tbody").append(
	        							'<tr>\
											<td class="text-center">----</td>\
											<td>Saldo Inicial</td>\
											<td class="text-center">----</td>\
											<td class="text-center">----</td>\
											<td class="text-center">R$ ' + sI + '</td>\
										</tr>');

	        		$("#data-befores-movimentos .table-movimentos tfoot").append(
	        							'<tr style="background-color: #bfffc2; color: #333">\
											<td class="text-center">----</td>\
											<td>Saldo Final</td>\
											<td class="text-center">----</td>\
											<td class="text-center">----</td>\
											<td class="text-center">R$ ' + sF + '</td>\
										</tr>');
	        		//Set
	        		$("#data-befores-movimentos .table-movimentos tbody").append(data_movimentos);
	        		$("#data-befores-movimentos").fadeIn();
	        		$("#modal_befores_caixa #btn-voltar, #modal_befores_caixa .btn-download, #modal_befores_caixa #btn-trash-caixa").fadeIn();
	        		$("#modal_befores_caixa .btn-download").attr("href", "<?php echo URLROOT ?>" + "/caixas/pdf/" + id + "/Caixa");
	        		link = "<?php echo URLROOT ?>" + "/caixas/deleteCaixa/" + id;
	        	}
	        },
	        error: function (e) {
	            //called when there is an error
	            console.log(e.message);
	        }
	    });

    })

    $("#modal_befores_caixa #btn-voltar").click(function(){
    	//Data Caixa

    	$("#modal_befores_caixa #idC").html('');
		$("#modal_befores_caixa #User").html('');
		$("#modal_befores_caixa #Dat").html('');

		//Saldos
    	$("#data-befores-movimentos .table-movimentos tbody").html('');
    	$("#data-befores-movimentos .table-movimentos tfoot").html('');

    	//Reset
    	$("#data-befores-caixa, #modal_befores_caixa .btn-back").fadeIn();
    	$("#data-befores-movimentos, #modal_befores_caixa #btn-voltar, #modal_befores_caixa .btn-download, #modal_befores_caixa #btn-trash-caixa, #data-trash-caixa").hide();
    	$("#modal_befores_caixa .btn-download").fadeOut();
        $("#modal_befores_caixa .btn-download").attr("href", "#");
        $("#modal_befores_caixa #btn-trash-caixa").attr("href", "#");
        // $("#modal_befores_caixa .btn-confim-trash").attr("href", "#");
        $("#modal_befores_caixa #btn-trash-caixa").html('<i class="fas fa-trash"></i>').attr('ste', 0);
        // $("#modal_befores_caixa .btn-trash").addClass("btn-trash").removeClass("btn-confim-trash");
        link = "#";

    })

	$('#modal_befores_caixa').on('hidden.bs.modal', function(e){ 
        //Data Caixa

    	$("#modal_befores_caixa #idC").html('');
		$("#modal_befores_caixa #User").html('');
		$("#modal_befores_caixa #Dat").html('');

		//Saldos
    	$("#data-befores-movimentos .table-movimentos tbody").html('');
    	$("#data-befores-movimentos .table-movimentos tfoot").html('');

    	//Reset
    	$("#data-befores-caixa, #modal_befores_caixa .btn-back").fadeIn();
    	$("#data-befores-movimentos, #modal_befores_caixa #btn-voltar, #modal_befores_caixa .btn-download, #modal_befores_caixa #btn-trash-caixa").hide();
    	$("#modal_befores_caixa .btn-download").fadeOut();
        $("#modal_befores_caixa .btn-download").attr("href", "#");
        $("#modal_befores_caixa #btn-trash-caixa").attr("href", "#");
        $("#modal_befores_caixa #btn-trash-caixa").html('<i class="fas fa-trash"></i>').attr('ste', 0);
        // $("#modal_befores_caixa .btn-trash").addClass("btn-trash").removeClass("btn-confim-trash");
        link = "#";
    });

	


    $("#btn-trash-caixa").on('click', function(){
    	var ste = $(this).attr('ste');

    	if (ste == 0) {
    		$("#modal_befores_caixa #btn-trash-caixa").append(' Confirmar e Apagar Caixa ?');
    		$(this).attr('ste', 1);
    	}else{
    		$("#modal_befores_caixa #btn-trash-caixa").attr("href", link);
    	}
   
    })

</script>