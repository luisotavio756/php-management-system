
<!DOCTYPE html>
<html>
<head>
	<title>Pedido - 5</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom fonts for this template-->
    <link href="<?php echo URLROOT; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo URLROOT; ?>/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?php echo URLROOT; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style type="text/css">
    	.table th, .table td {
    		vertical-align: inherit !important;
    		height: 60px !important;
    		font-size: .9rem !important;
    	}

    	.table .total th{
    		font-weight: 700 !important; 
    	}


    </style>
</head>
<body>
	<div class="container-fluid" style="padding-right: 
	-1.5rem !important; padding-left: -1.5rem !important">
		<div class="row">
			<div class="col-lg-8 mx-auto mt-5" style="min-height: 100vh;">
				<div class="row">
					<div class="col-12">
						<h2 class="text-center text-info"><i class="fas fa-drumstick-bite"></i> <b>Assakabrasa</b> <i class="fas fa-utensils"></i></h3>
					</div>
				</div>
				<?php if ($data['status'] != 1): ?>
					<div class="row">
						<div class="col-12">
							<h3 class="text-center text-info"><b>Olá,</b></h3>
							<h4 class="text-center text-info"><b>bem vindo ao seu pedido !</h4>
						</div>
					</div>
					<?php if ($data['pedido']): ?>
						<div class="row mt-3">
							<div class="col-12">
								<h5 class="text-center">Resumo do <b>Pedido 33</b></h4>
							</div>
						</div>
						<div class="row">
							<div class="col-12 px-0">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Produto</th>
											<th class="text-center">Qtd.</th>
											<th class="text-center">Valor</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$cont = 1;
											$total = 0;
											foreach ($data['pedido'] as $key => $value):
										?>
											<tr>
												<td class="text-center"><?php echo $cont ?></td>
												<td><?php echo $value->descricao ?></td>
												<td class="text-center"><?php echo $value->quantidade ?></td>
												<td class="text-center">R$ <?php echo str_replace('.', ',', $value->valor) ?></td>
											</tr>
										<?php 	
											$total += $value->valor;
											$cont++;
											endforeach; 
										?>
									</tbody>
									<tfoot>
										<tr class="total">
											<th colspan="3" class="text-center text-success">TOTAL:</th>
									
											<th class="text-center text-success">R$ <?php echo str_replace('.', ',', number_format($total, 2)) ?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						
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
			<div class="col-lg-12 bg-danger" style="height: 300px">
				
			</div>
		</div>
	</div>
</body>
</html>