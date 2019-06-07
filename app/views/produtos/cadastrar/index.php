<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="h3 mb-2 text-gray-800">Produtos</h1>
		<div class="row">
			<div class="col-12">
				<?php echo flash('produtos'); ?>
			</div>
			<div class="col-12 text-right">
				<a href="#adicionar_produto" data-toggle="modal" class="btn btn-success btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Adicionar Produto</span>
				</a>
			</div>
		</div>
		<div class="card shadow mb-4 mt-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cubes"></i> Lista de Produtos</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Cod</th>
								<th>Descrição</th>
								<th class="text-center">Estoque</th>
								<th class="text-center">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data['produtos'] as $key => $value): ?>
								<tr>
									<td class="text-center"><?php echo $value->id ?></td>
									<td class="text-center"><?php echo $value->cod ?></td>
									<td><?php echo $value->descricao ?></td>
									<td class="text-center"><?php echo $value->estoque ?></td>
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
<div class="modal fade" id="adicionar_produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Produto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="user" action="<?php echo URLROOT; ?>/produtos/addProduto" method="POST">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-lg-2 mb-3 mb-lg-0">
							<label>Código:</label>
							<input type="tel" name="cod" class="form-control form-control-user" placeholder="Código" required="">
						</div>
						<div class="col-lg-10">
							<label>Descrição:</label>
							<input type="text" name="descricao" class="form-control form-control-user" placeholder="Descrição do produto.." required="">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-4 mb-3 mb-lg-0">
							<label>Categoria:</label>
							<select name="categoria" class="form-control form-control-user" required="">
								<option selected=""></option>
								<?php foreach ($data['categorias'] as $key => $value): ?>
									<option value="<?php echo $value->id ?>"><?php echo $value->descricao ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Valor:</label>
							<input type="tel" name="valor" class="form-control form-control-user" placeholder="R$ Valor" required="">
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Estoque:</label>
							<input type="tel" name="estoque" class="form-control form-control-user" placeholder="Qtd em estoque.." required="">
						</div>
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
