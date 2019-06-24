<?php require_once APPROOT . '/views/inc/header.php'; ?>

	<style type="text/css">
		.perfil .nav-link {
		    padding: 0.9rem 1rem;
		    color: #333333a8 !important;
		}

		.perfil .nav-link.active {
		    color: white !important;
		    background-color: #375ece;
		}

		.avatar-upload {
			position: relative;
			max-width: 250px;
		}
		.avatar-upload .avatar-edit {
			position: absolute;
			right: 20px;
			z-index: 1;
			top: 10px;
		}
		.avatar-upload .avatar-edit input {
			display: none;
		}
		.avatar-upload .avatar-edit input + label {
			display: flex;
			align-items: center;
			align-content: center;
			width: 35px;
			height: 35px;

			border-radius: 100%;
			background: #FFFFFF;
			border: 1px solid transparent;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
			cursor: pointer;
			font-weight: normal;
			transition: all 0.2s ease-in-out;
		}
		.avatar-upload .avatar-edit input + label:hover {
			background: #f1f1f1;
			border-color: #d6d6d6;
		}

		.avatar-upload .avatar-preview {
			width: 250px;
			height: 250px;
			position: relative;
			border-radius: 100%;
			border: 6px solid #F8F8F8;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
		}
		.avatar-upload .avatar-preview > div {
			width: 100%;
			height: 100%;
			border-radius: 100%;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
		}
	</style>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="h3 mb-2 text-gray-800">Perfil do Usuário</h1>
			<div class="row">
				<div class="col-12">
					<?php echo flash('perfil'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-lg-4">
			<div class="nav flex-column nav-pills shadow perfil" style="background-color: white; border-radius: 10px" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-portrait"></i> Foto do Perfil</a>
				<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-user-cog"></i> Dados Pessoais</a>
				<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-key"></i> Alterar Senha</a>
			</div>
		</div>
		<div class="mt-3 mt-lg-0 col-lg-8 shadow py-3 px-4" style="background-color: white; border-radius: 10px">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<div class="col-lg-12">
						<form action="<?php echo URLROOT; ?>/users/updateImg/<?php echo $data['user']->id ?>" method="POST" enctype="multipart/form-data">
						    <div class="avatar-upload mx-auto">
						        <div class="avatar-edit">
						            <input type='file' id="imageUpload" name="imagem" accept=".png, .jpg, .jpeg" />
						            <label for="imageUpload" class="text-center mx-auto"><i class="fas fa-edit mx-auto"></i></label>
						        </div>
						        <div class="avatar-preview">
						            <div id="imagePreview" style="background-image: url('<?php echo URLROOT."/img/users/".$_SESSION['img'] ?>');">
						            </div>
						        </div>
						    </div>
						    <div class="form-group row mt-2">
						    	<div class="col-lg-6 mx-auto">
									<button type="submit" style="border-radius: 20px" class="btn btn-block btn-success">Salvar Foto</button>
								</div>
						    </div>							
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<form class="user" action="<?php echo URLROOT; ?>/users/updateUser/<?php echo $data['user']->id ?>" method="POST">
						<input type="hidden" name="acao" value="perfil">
						<input type="hidden" name="nivel" value="<?php echo $data['user']->nivel ?>">
						<input type="hidden" name="status" value="<?php echo $data['user']->status ?>">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Nome:</label>
								<input type="tel" name="nome" class="form-control form-control-user" placeholder="Seu Nome.." value="<?php echo $data['user']->nome ?>" required="">
							</div>
							<div class="col-lg-6">
								<label>Sobrenome:</label>
								<input type="text" name="sobrenome" class="form-control form-control-user" placeholder="Seu Sobrenome.." value="<?php echo $data['user']->sobrenome ?>" required="">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-12">
								<label>Email:</label>
								<input type="email" name="email" class="form-control form-control-user" placeholder="Seu Email.." value="<?php echo $data['user']->email ?>" required="">
							</div>
						</div>
						<div class="form-group row mt-4">
							<div class="col-lg-12">
								<button type="submit" style="border-radius: 20px" class="btn btn-block btn-success">Salvar Alterações</button>
							</div>
						</div>
					</form>
				</div>	
				<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
					<form class="user mx-auto" action="<?php echo URLROOT; ?>/users/updateSenha/<?php echo $data['user']->id ?>" method="POST">	
						<div class="form-group row">
							<div class="col-lg-12 mb-3">
								<label>Senha Atual:</label>
								<input type="password" name="senha" class="form-control form-control-user" placeholder="Digite sua Senha.." required="">
							</div>
							<div class="col-lg-6 mb-3">
								<label>Nova senha:</label>
								<input type="password" name="new_senha" class="form-control form-control-user" placeholder="Digite sua nova Senha.." required="">
							</div>
							<div class="col-lg-6 mb-3">
								<label>Confirme a nova senha:</label>
								<input type="password" name="confirm_new_senha" class="form-control form-control-user" placeholder="Confirme sua nova Senha.." required="">
							</div>
						</div>
						<div class="form-group row mt-4">
							<div class="col-lg-12">
								<button type="submit" style="border-radius: 20px" class="btn btn-block btn-success">Salvar Alterações</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript">
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function(e) {
	            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
	            $('#imagePreview').hide();
	            $('#imagePreview').fadeIn(650);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$("#imageUpload").change(function() {
	    readURL(this);
	});
</script>
	

