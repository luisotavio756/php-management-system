<?php require_once APPROOT . '/views/inc/header.php'; ?>
	<div class="jumbotron jumbotron-fluid text-center">
		<div class="container">
			<h1 class="display-3"><?= $data['title']; ?></h1>
			<p class="lead">
				<?php echo $data['descricao'] ?>
			</p>
		</div>
	</div>
	
<?php require_once APPROOT . '/views/inc/footer.php'; ?>