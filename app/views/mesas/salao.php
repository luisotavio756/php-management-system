<?php require_once APPROOT . '/views/inc/header.php'; ?>
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
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-<?php echo $value->status == 1 ? 'danger' : 'success' ?> shadow h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $value->descricao ?></div>
												<p class="my-0 text-<?php echo $value->status == 1 ? 'danger' : 'success' ?>"><?php echo $value->status == 1 ? 'Ocupada' : 'Disponível' ?></p>

											</div>
											<div class="col-auto">
												<i class="fas fa-bookmark fa-2x text-gray-300"></i>
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



<?php require_once APPROOT . '/views/inc/footer.php'; ?>
