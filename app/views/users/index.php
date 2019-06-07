<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
		<div class="row">
			<div class="col-12">
				<?php echo flash('users'); ?>
			</div>
			<div class="col-12 text-right">
				<a href="#adicionar_Usuario" data-toggle="modal" class="btn btn-success btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Adicionar Usuario</span>
				</a>
			</div>
		</div>
		<div class="card shadow mb-4 mt-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cubes"></i> Lista de Usuarios</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Nome</th>
								<th>Email</th>
								<th class="text-center">Nível</th>
								<th class="text-center">Status</th>
								<th class="text-center">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data['users'] as $key => $value): ?>
								<tr>
									<td class="text-center"><?php echo $value->id ?></td>
									<td><?php echo $value->nome . " " . $value->sobrenome ?></td>
									<td><?php echo $value->email ?></td>
									<td class="text-center"><?php echo $value->nivel == 1 ? 'Administrador' : 'Funcionário';?></td>
									<td class="text-center"><?php echo $value->status == 1 ? 'Ativo' : 'Inativo'; ?></td>
									<td class="text-center">
										<a class="btn btn-warning btn-circle btn-sm" href="<?php echo URLROOT ?>/users/updateUser/<?php echo $value->id ?>" id="<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_editar" title="Editar Usuario" modal-size="modal-lg">
											<i class="fas fa-edit"></i>
										</a>
										<a class="btn btn-info btn-circle btn-sm" href="#" id="<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_info" title="Informações do Usuario">
											<i class="fas fa-info"></i>
										</a>
										<a class="btn btn-danger btn-circle btn-sm" href="<?php echo URLROOT ?>/users/deleteUser/<?php echo $value->id ?>" data-toggle="modal" data-placement="top" data-target="#modal_excluir" title="Excluir Usuario" text="Deseja Realmente excluir este Usuário ?">
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
<div class="modal fade" id="adicionar_Usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="user" action="<?php echo URLROOT; ?>/users/addUser" method="POST">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-lg-4 mb-3 mb-lg-0">
							<label>Nome:</label>
							<input type="tel" name="nome" class="form-control form-control-user" placeholder="Seu Nome.." required="">
						</div>
						<div class="col-lg-3">
							<label>Sobrenome:</label>
							<input type="text" name="sobrenome" class="form-control form-control-user" placeholder="Seu Sobrenome.." required="">
						</div>
						<div class="col-lg-5">
							<label>Email:</label>
							<input type="email" name="email" class="form-control form-control-user" placeholder="Seu Email.." required="">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Nivel:</label>
							<select name="nivel" class="form-control" required="">
								<option selected=""></option>
								<option value="1">Administrador</option>
								<option value="2">Funcionário</option>
							</select>
						</div>
						<div class="col-lg-2 mb-3 mb-lg-0">
							<label>Status:</label>
							<select name="status" class="form-control" required="">
								<option selected=""></option>
								<option value="1">Ativo</option>
								<option value="0">Inativo</option>
							</select>
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Senha:</label>
							<input type="password" name="senha" class="form-control form-control-user" placeholder="Digite uma Senha.." required="">
						</div>
						<div class="col-lg-3">
							<label>Confirme a senha:</label>
							<input type="password" name="confirm_senha" class="form-control form-control-user" placeholder="Confirme a Senha.." required="">
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
    <div class="modal-dialog modal-lg" role="document">
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
						<div class="col-lg-4 mb-3 mb-lg-0">
							<label>Nome:</label>
							<input type="tel" name="nome" class="form-control form-control-user" placeholder="Seu Nome.." required="">
						</div>
						<div class="col-lg-3">
							<label>Sobrenome:</label>
							<input type="text" name="sobrenome" class="form-control form-control-user" placeholder="Seu Sobrenome.." required="">
						</div>
						<div class="col-lg-5">
							<label>Email:</label>
							<input type="email" name="email" class="form-control form-control-user" placeholder="Seu Email.." required="">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Nivel:</label>
							<select name="nivel" class="form-control" required="">
								<option selected=""></option>
								<option value="1">Administrador</option>
								<option value="2">Funcionário</option>
							</select>
						</div>
						<div class="col-lg-2 mb-3 mb-lg-0">
							<label>Status:</label>
							<select name="status" class="form-control" required="">
								<option selected=""></option>
								<option value="1">Ativo</option>
								<option value="0">Inativo</option>
							</select>
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
<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
					<div class="col-lg-6">
						<label class="m-0 font-weight-bold text-info">Nome:</label>
						<p class="nome"></p>
					</div>
					<div class="col-lg-6">
						<label class="m-0 font-weight-bold text-info">Email:</label>
						<p class="email"></p>
					</div>
					<div class="col-lg-6">
						<label class="m-0 font-weight-bold text-info">Nivel:</label>
						<p class="nivel"></p>
					</div>
					<div class="col-lg-6">
						<label class="m-0 font-weight-bold text-info">Status:</label><br>
						<h5 class="status"></h5>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>

<?php  
	$data_json = array();
	foreach ($data['users'] as $key => $value) {
		$data_json[$value->id]['id'] = $value->id;
		$data_json[$value->id]['nome'] = $value->nome;
		$data_json[$value->id]['sobrenome'] = $value->sobrenome;
		$data_json[$value->id]['email'] = $value->email;
		$data_json[$value->id]['nivel'] = $value->nivel;
		$data_json[$value->id]['status'] = $value->status;
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
        $(this).find("[name='nome']").val(data[id].nome)
        $(this).find("[name='sobrenome']").val(data[id].sobrenome)
        $(this).find("[name='email']").val(data[id].email)
        $(this).find("[name='nivel']").val(data[id].nivel)
        $(this).find("[name='status']").val(data[id].status)

    });

    $("#modal_info").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        var id = link.attr('id');

        if(link.attr("modal-size")!= undefined){
            $(this).find(".modal-dialog").attr('class', 'modal-dialog '+link.attr("modal-size"))
        } else{
            $(this).find(".modal-dialog").attr('class', 'modal-dialog')
        }

        // $(this).find("form").attr("action", link.attr("href"));
        $(this).find(".modal-title").html(link.attr("title"));
        $(this).find(".nome").html(data[id].nome + data[id].sobrenome)
        $(this).find(".email").html(data[id].email)
        $(this).find(".nivel").html(data[id].nivel == 1 ? 'Administrador' : 'Funcionário')
        $(this).find(".status").html(data[id].status == 1 ? '<span class="badge badge-primary">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>')
       
    });
</script>
