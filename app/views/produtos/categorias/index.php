<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="h3 mb-2 text-gray-800">Categorias</h1>
		<div class="row">
			<div class="col-12">
				<?php echo flash('categoria'); ?>
			</div>
			<div class="col-12 text-right">
				<a href="#adicionar_Categoria" data-toggle="modal" class="btn btn-success btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Adicionar Categoria</span>
				</a>
			</div>
		</div>
		<div class="card shadow mb-4 mt-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cubes"></i> Lista de Categorias</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Descrição</th>
								<th>Data de Registro</th>
								<th class="text-center">Ação</th>

							</tr>
						</thead>
						<!-- <tfoot>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
							</tr>
						</tfoot> -->
						<tbody>
							<?php foreach ($data['categorias'] as $key => $value): ?>
								<tr>
									<td class="text-center"><?php echo $value->id ?></td>
									<td><?php echo $value->descricao ?></td>
									<td><?php echo $value->data_registro ?></td>
									<td class="text-center">CRUD</td>
								</tr>
																								
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Upload -->
<div class="modal fade" id="adicionar_Categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Categoria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="user" action="<?php echo URLROOT; ?>/produtos/addCategoria" method="POST">
				<div class="modal-body">
						<div class="form-group">
							<label>Descrição da Categoria: <sup style="color: red">*</sup></label>
							<input type="text" name="descricao" class="form-control form-control-user" placeholder="Digite o nome da categoria..." required="">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Adicionar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>