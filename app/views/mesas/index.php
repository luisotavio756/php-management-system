<?php require_once APPROOT . '/views/inc/header.php'; ?>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="h3 mb-2 text-gray-800">Mesas</h1>
			<div class="row">
				<div class="col-12">
					<?php echo flash('mesas'); ?>
				</div>
				<div class="col-12 text-right">
					<a href="#adicionar_mesa" data-toggle="modal" class="btn btn-success btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-plus"></i>
						</span>
						<span class="text">Adicionar Mesa</span>
					</a>
				</div>
			</div>
			<div class="card shadow mb-4 mt-3">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cubes"></i> Lista de Mesas</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Descrição</th>
									<th class="text-center">Status</th>
									<th class="text-center">Ações</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data['mesas'] as $key => $value): ?>
									<tr>
										<td class="text-center"><?php echo $value->id ?></td>
										<td><?php echo $value->descricao ?></td>
										<td class="text-center">
											<?php 
												echo $value->status == 1 ? '<span class="badge badge-pill badge-danger p-1">Ocupada</span>' : '<span class="badge badge-pill badge-success p-1">Disponível</span>' 
											?>
												
										</td>
										<td class="text-center">
											<a class="btn btn-secondary btn-circle btn-sm" href="#" id="<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_comandas" title="Comandas da Mesa">
												<i class="fas fa-bookmark"></i>
											</a>
											<a class="btn btn-warning btn-circle btn-sm" href="<?php echo URLROOT ?>/mesas/alterMesa/<?php echo $value->id ?>" id="<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_editar" title="Editar Mesa" modal-size="modal-lg">
												<i class="fas fa-edit"></i>
											</a>
											<a class="btn btn-info btn-circle btn-sm" href="#" id="<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_info" title="Informações da Mesa">
												<i class="fas fa-info"></i>
											</a>
											<a class="btn btn-danger btn-circle btn-sm" href="<?php echo URLROOT ?>/mesas/deleteMesa/<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_excluir" title="Excluir Mesa" text="Deseja Realmente excluir esta Mesa ?">
												<i class="fas fa-trash"></i>
											</a>

										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="adicionar_mesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Adicionar Mesa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="user" action="<?php echo URLROOT; ?>/mesas/add/" method="POST">
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-lg-3 mb-3 mb-lg-0">
								<label>Número:</label>
								<input type="number" min="0" name="num" class="form-control form-control-user" placeholder="Nº" required="">
							</div>
							<div class="col-lg-9">
								<label>Descrição:</label>
								<input type="text" name="descricao" class="form-control form-control-user" placeholder="Ex: Mesa 1.." required="">
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
	<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form class="user" action="" method="post" enctype="multpart/form-data">
	                <div class="modal-body">
	                	<div class="form-group row">
	                		<div class="col-lg-3 mb-3 mb-lg-0">
								<label>Número:</label>
								<input type="number" min="0" name="num" class="form-control form-control-user" placeholder="Nº" required="">
							</div>
							<div class="col-lg-9">
								<label>Descrição:</label>
								<input type="text" name="descricao" class="form-control form-control-user" placeholder="Ex: Mesa 1.." required="">
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

<?php  
	$data_json = array();
	foreach ($data['mesas'] as $key => $value) {
		$data_json[$value->id]['id'] = $value->id;
		$data_json[$value->id]['descricao'] = $value->descricao;
	}

	$data_json = json_encode($data_json);


?>

<script type="text/javascript">
	var data = JSON.parse('<?php echo $data_json ?>');

	$("#modal_editar").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');

		if(link.attr("modal-size")!= undefined){
			$(this).find(".modal-dialog").attr('class', 'modal-dialog '+link.attr("modal-size"))
		} else{
			$(this).find(".modal-dialog").attr('class', 'modal-dialog')
		}

		$(this).find("form").attr("action", link.attr("href"));
		$(this).find(".modal-title").html(link.attr("title"));
		$(this).find("[name='num']").val(data[id].id)
        $(this).find("[name='descricao']").val(data[id].descricao)

	});
</script>