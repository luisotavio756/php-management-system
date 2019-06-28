<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
  .toggle.ios .toggle-handle { border-radius: 20rem; }
</style>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="h3 mb-2 text-gray-800">Configurações</h1>
			<div class="row">
				<div class="col-12">
					<?php echo flash('configs'); ?>
				</div>
			</div>
			<div class="card shadow mb-4 mt-3">
		<!-- 		<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cubes"></i> Lista de Usuarios</h6>
				</div> -->
				<div class="card-body">
					<form class="user" action="<?php echo URLROOT ?>/configuracoes/update/1" method="POST" enctype="multpart/form-data" autocomplete="off">
						<input type="hidden" name="maps" value="">
						<div class="form-row my-2">
							<div class="form-group col-lg-6">
								<label class="">Email: </label>	
								<input type="email" name="email" class="form-control form-control-user" placeholder="Digite o email da sua empresa.." value="<?php echo $data['configs']->email ?>">
							</div>
							<div class="form-group col-lg-6">
								<label class="">Telefone: </label>	
								<input type="text" name="telefone" class="form-control form-control-user" placeholder="Digite o Telefone da sua empresa.." value="<?php echo $data['configs']->telefone ?>">
							</div>
						</div>
						<div class="form-row my-2">
							<div class="form-group col-lg-6">
								<label class="">Endereço: </label>	
								<input type="text" name="endereco" class="form-control form-control-user" placeholder="Digite o Endereço da sua empresa.." value="<?php echo $data['configs']->endereco ?>">
							</div>
						</div>
						<div class="form-row my-2">
							<div class="form-group col-lg-4">
								<label class="">Instagram: </label>	
								<input type="text" name="instagram" class="form-control form-control-user" placeholder="Digite o link do Instagram.." value="<?php echo $data['configs']->instagram ?>">
							</div>
							<div class="form-group col-lg-4">
								<label class="">Facebook: </label>	
								<input type="text" name="facebook" class="form-control form-control-user" placeholder="Digite o link do Facebook.." value="<?php echo $data['configs']->facebook ?>">
							</div>
							<div class="form-group col-lg-4">
								<label class="">Whatsapp: </label>	
								<input type="text" name="whatsapp" class="form-control form-control-user phone" placeholder="Digite o numero do whatsapp.." value="<?php echo $data['configs']->whatsapp ?>">
							</div>
						</div>
						<div class="form-row my-2">
							<div class="form-group col-lg-12">
								<label class="">Google Maps: </label>	
								<textarea type="url" name="url" class="form-control" placeholder="Digite o link do Google Maps.."><iframe src="<?php echo $data['configs']->maps ?>" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></textarea>
							</div>
						</div>
						<div class="form-row my-2">
							<div class="form-group col-lg-12">
								<label>Retirar pedidos do Estoque:</label>
								<?php if ($data['configs']->debitarEstoque == 1): ?>
									<input type="checkbox" name="estoque" checked data-toggle="toggle" data-style="ios" data-on="Sim <i class='fas fa-check'></i>" data-off="Não <i class='fas fa-times'></i>" data-onstyle="success" data-offstyle="danger">
								<?php else: ?>
									<input type="checkbox" name="estoque" data-toggle="toggle" data-style="ios" data-on="Sim <i class='fas fa-check'></i>" data-off="Não <i class='fas fa-times'></i>" data-onstyle="success" data-offstyle="danger">
								<?php endif; ?>
							</div>
						</div>
						<div class="form-row my-2">
							<div class="form-group col-12">
								<textarea name="descricao" class="form-control" rows="3"><?php echo $data['configs']->descricaoEmpresa ?></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 text-right">
								<hr>
								<button type="button" onclick="teste()" class="btn btn-success btn-submit">Salvar Alterações <i class="fas fa-check"></i></button>
							</div>
						</div>
						<div class="teste d-none"></div>
						<!-- <div class="form-group row align-itens-center">
							<label class="col-lg-3" style="font-size: 1.2rem">Debitar pedidos do Estoque: </label>	
							<div class="col-lg-8">
								<input type="checkbox" checked data-toggle="toggle" data-style="ios" data-on="Sim <i class='fas fa-check'></i>" data-off="Não <i class='fas fa-times'></i>" data-onstyle="success" data-offstyle="danger">	
							</div>
							<div class="col-12"><hr></div>
						</div> -->
					</form>
				</div>
			</div>
		</div>
	</div>
	
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
<script type="text/javascript">
	function teste() {
		var html = $('[name="url"]').val()
		$(".teste").html(html);
		var iframe = $(".teste iframe").attr('src');
		// alert(iframe)
		$('[name="maps"]').val(iframe);
		$(".btn-submit").attr('type', 'submit');
	}
</script>