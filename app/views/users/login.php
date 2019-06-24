<?php  

	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo SITENAME; ?> - Login</title>
		<!-- Custom fonts for this template-->
		<link href="<?php echo URLROOT; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<!-- Custom styles for this template-->
		<link href="<?php echo URLROOT; ?>/css/sb-admin-2.css" rel="stylesheet">
		<style type="text/css">
			body{
				background-image: url('../img/img2.jpg') !important;

				
				/* Full height */
				height: 100% !important;

				/* Center and scale the image nicely */
				background-position: center !important;
				background-repeat: no-repeat !important;
				background-size: cover !important;

			}

			.card{

    			background-color: rgba(255, 255, 255, 1);
    			box-shadow: 0px 0px 10px 1px white !important;

			}

			input, button{
				box-shadow: 0px 0px 8px 0px #0000005e;

			}

			/*GOOGLE SANS*/


			@font-face {
			font-family: 'Product Sans Regular';
			font-style: normal;
			font-weight: normal;
			src: local('Product Sans Regular'), url('../public/fontes/google-sans/ProductSans-Regular.woff') format('woff');
			}


			@font-face {
			font-family: 'Product Sans Black Regular';
			font-style: normal;
			font-weight: normal;
			src: local('Product Sans Black Regular'), url('../public/fontes/google-sans/ProductSans-Black.woff') format('woff');
			}

			@font-face {
			font-family: 'Product Sans Bold';
			font-style: normal;
			font-weight: normal;
			src: local('Product Sans Bold'), url('../public/fontes/google-sans/ProductSans-Bold.woff') format('woff');
			}


			.google-sans{
				font-family: 'Product Sans Regular' !important;
				font-size: 2rem;
				font-weight: 500;
				text-shadow: 4px 1px 30px #0000008c;

			}

			body{
				font-family: 'Product Sans Regular' !important;
			}
		</style>
	</head>
	<body class="bg-gradient-primary" style="display: flex; align-content: center !important; align-items: center; height: 100vh !important">
		<div class="container">
			<!-- Outer Row -->

			<div class="row justify-content-center">
				<div class="col-xl-10 col-lg-12 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-6 d-none d-lg-block">
									<img src="../img/img1.jpg" class="img-fluid">
								</div>
								<div class="col-lg-6 d-flex align-items-center align-content-center">
									<div class="p-4 p-md-5 w-100">
										<?php flash('login'); ?>
										<div class="text-center">
											<h1 class="h4 google-sans mb-4">Bem Vindo!</h1>
										</div>
										<form class="user" action="<?php echo URLROOT; ?>/users/login" method="POST">
											<div class="form-group my-3">
												<input type="email" name="email"  class="form-control form-control-user <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Digite seu Email..." value="<?php echo $data['email'] ?>">
												<span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

											</div>
											<div class="form-group my-3">
												<input type="password" name="senha" class="form-control form-control-user <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="exampleInputPassword" placeholder="Senha"  value="<?php echo $data['password'] ?>">
												<span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
											</div>
											<!-- <div class="form-group">
												<div class="custom-control custom-checkbox small">
													<input type="checkbox" class="custom-control-input" id="customCheck">
													<label class="custom-control-label" for="customCheck">Remember Me</label>
												</div>
											</div> -->
											<button style="background-color: #eca225; color: white; font-size: 16px; padding: 0.5rem 1rem;" type="submit" class="btn btn-user btn-block mt-4">
												Entrar
											</button>
											<hr>
											<!-- <a href="index.html" class="btn btn-google btn-user btn-block">
											<i class="fab fa-google fa-fw"></i> Login with Google
											</a>
											<a href="index.html" class="btn btn-facebook btn-user btn-block">
											<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
											</a> -->
										</form>
										<!-- <hr> -->
<!-- 										<div class="text-center">
											<a class="small" href="forgot-password.html">Forgot Password?</a>
										</div> -->
										<!-- <div class="text-center">
											<a class="small" href="<?php echo URLROOT ?>/users/register">Crie uma conta!</a>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bootstrap core JavaScript-->
		<script src="<?php echo URLROOT; ?>/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo URLROOT; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Core plugin JavaScript-->
		<script src="<?php echo URLROOT; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
		<!-- Custom scripts for all pages-->
		<script src="<?php echo URLROOT; ?>/js/sb-admin-2.min.js"></script>
	</body>
</html>