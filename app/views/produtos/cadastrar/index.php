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
								<th>Descrição</th>
								<th class="text-center">Estoque</th>
								<th class="text-center">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data['produtos'] as $key => $value): ?>
								<tr>
									<td class="text-center"><?php echo $value->id_produto ?></td>
									<td><?php echo $value->descricao ?></td>
									<td class="text-center"><?php echo $value->estoque ?></td>
									<td class="text-center">
										<a class="btn btn-warning btn-circle btn-sm" href="<?php echo URLROOT ?>/produtos/alterProduto/<?php echo $value->id_produto ?>" id="<?php echo $value->id_produto ?>" data-toggle="modal" data-placement="top" data-target="#modal_editar" title="Editar Produto" modal-size="modal-lg">
											<i class="fas fa-edit"></i>
										</a>
										<a class="btn btn-info btn-circle btn-sm" href="#" id="<?php echo $value->id_produto ?>" data-toggle="modal" data-placement="top" data-target="#modal_info" title="Informações do Produto">
											<i class="fas fa-info"></i>
										</a>
										<a class="btn btn-danger btn-circle btn-sm" href="<?php echo URLROOT ?>/produtos/deleteProduto/<?php echo $value->id_produto ?>" data-toggle="modal" data-placement="top" data-target="#modal_excluir" title="Excluir Produto" text="Deseja Realmente excluir este Produto ?">
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
						<div class="col-lg-12">
							<label>Descrição:</label>
							<input type="text" name="descricao" class="form-control form-control-user" placeholder="Descrição do produto.." required="">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-4 mb-3 mb-lg-0">
							<label>Categoria:</label>
							<select name="categoria" class="form-control form-control-user" required="">
								<option value="0" disabled selected>Selecione uma Categoria</option>
								<?php foreach ($data['categorias'] as $key => $value): ?>
									<option value="<?php echo $value->id ?>"><?php echo $value->descricao ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Valor:</label>
							<input type="tel"  min="0" name="valor" class="form-control form-control-user money" placeholder="R$ Valor" required="">
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Estoque:</label>
							<input type="number" min="1" name="estoque" class="form-control form-control-user" placeholder="Qtd em estoque.." required="">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success button-submit-form" class="btn btn-success">Adicionar</button>
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
						<div class="col-lg-12">
							<label>Descrição:</label>
							<input type="text" name="descricao" class="form-control form-control-user" placeholder="Descrição do produto.." required="">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-4 mb-3 mb-lg-0">
							<label>Categoria:</label>
							<select name="categoria" class="form-control form-control-user" required="">
								<option value="" disabled>Selecione uma Categoria</option>
								<?php foreach ($data['categorias'] as $key => $value): ?>
									<option value="<?php echo $value->id ?>"><?php echo $value->descricao ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Valor:</label>
							<input type="tel" min="0" name="valor" class="form-control form-control-user money" placeholder="R$ Valor" required="">
						</div>
						<div class="col-lg-3 mb-3 mb-lg-0">
							<label>Estoque:</label>
							<input type="number"  min="1" name="estoque" class="form-control form-control-user" placeholder="Qtd em estoque.." required="">
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning button-submit-form">Salvar Alterações <i class="fas fa-edit"></i></button>
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
					<div class="col-lg-7">
						<label class="m-0 font-weight-bold text-info">Descrição:</label>
						<p class="descricao"></p>
					</div>
					<div class="col-lg-2">
						<label class="m-0 font-weight-bold text-info">Valor:</label>
						<p class="valor"></p>
					</div>
					<div class="col-lg-3">
						<label class="m-0 font-weight-bold text-info">Estoque:</label><br>
						<p class="estoque">45</p>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-3">
						<label class="m-0 font-weight-bold text-info">Data:</label><br>
						<p class="data"></p>
					</div>
					<div class="col-lg-3">
						<label class="m-0 font-weight-bold text-info">Horário:</label><br>
						<p class="horario"></p>
					</div>
					<div class="col-lg-3">
						<label class="m-0 font-weight-bold text-info">Categoria:</label><br>
						<p class="categoria"></p>
					</div>
					<div class="col-lg-3">
						<label class="m-0 font-weight-bold text-info">Usuário:</label><br>
						<p class="usuario"></p>
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
	foreach ($data['produtos'] as $key => $value) {
		$data_json[$value->id_produto]['id'] = $value->id_produto;
		$data_json[$value->id_produto]['descricao'] = $value->descricao;
		$data_json[$value->id_produto]['id_categoria'] = $value->id_categoria;
		$data_json[$value->id_produto]['descricao_categoria'] = $value->descricao_categoria;
		$data_json[$value->id_produto]['valor'] = $value->valor;
		$data_json[$value->id_produto]['estoque'] = $value->estoque;
		$data_json[$value->id_produto]['data'] = breakDateTime($value->data_registro);
		$data_json[$value->id_produto]['nome_usuario'] = $value->nome;
	}

	// echo "<pre>";
	// print_r($data_json);

	$data_json = json_encode($data_json);


?>

<script type="text/javascript">
	var data = JSON.parse('<?php echo $data_json ?>');

	$("#modal_info").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');

		// alert(JSON.stringify(data[id].data))
		if(link.attr("modal-size")!= undefined){
			$(this).find(".modal-dialog").attr('class', 'modal-dialog '+link.attr("modal-size"))
		} else{
			$(this).find(".modal-dialog").attr('class', 'modal-dialog modal-lg')
		}

		// $(this).find("form").attr("action", link.attr("href"));
		$(this).find(".modal-title").html(link.attr("title"));
		$(this).find(".descricao").html(data[id].descricao)
		$(this).find(".categoria").html(data[id].descricao_categoria)
		$(this).find(".valor").html("R$ " + data[id].valor)
		$(this).find(".estoque").html(data[id].estoque)
		$(this).find(".data").html(data[id].data.data)
		$(this).find(".horario").html(data[id].data.horario)
		$(this).find(".usuario").html(data[id].nome_usuario)


	});

	$("#modal_editar").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		var id = link.attr('id');

		if(link.attr("modal-size")!= undefined){
			$(this).find(".modal-dialog").attr('class', 'modal-dialog '+link.attr("modal-size"))
		} else{
			$(this).find(".modal-dialog").attr('class', 'modal-dialog modal-lg')
		}

		$(this).find("form").attr("action", link.attr("href"));
		$(this).find(".modal-title").html(link.attr("title"));
        $(this).find("[name='descricao']").val(data[id].descricao)
        $(this).find("[name='categoria']").val(data[id].id_categoria)
        $(this).find("[name='valor']").val(data[id].valor)
        $(this).find("[name='estoque']").val(data[id].estoque)


	});

	$("#adicionar_produto .button-submit-form").click(function(){
		if (verificarInputs('adicionar_produto')) {
			$(this).attr('type', 'submit');
		}
	})

	$("#modal_editar .button-submit-form").click(function(){
		if (verificarInputs('modal_editar')) {
			$(this).attr('type', 'submit');
		}
	})

	$("#adicionar_produto .modal-body input, #adicionar_produto .modal-body select, #modal_editar .modal-body input, #modal_editar .modal-body select").on("change keyup", function (){
        $(this).removeClass('is-invalid')
        $(this).parent().find('.invalid-feedback').html('')
    })


    function verificarInputs(inputs) {
    	
        var $inputs = $("#"+inputs+" .modal-body input, #"+inputs+" .modal-body select"),
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
</script>