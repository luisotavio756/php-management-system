<?php require_once APPROOT . '/views/inc/header.php'; ?>
	
	<div class="row d-sm-flex align-items-center justify-content-center my-1">
		<div class="col-lg-4 d-none d-lg-block d-xl-none">
			<hr class="bg-info w-50 mr-0" style="height: .1px; border-radius: 10px; box-shadow: 0 0 3px 0px gray !important">
		</div>
		<div class="col-lg-4 text-center">
			<h1 style="font-size: 50px; font-weight: 700" class="text-info text-shadow">Início</h1>
		</div>
		<div class="col-lg-4 d-none d-lg-block d-xl-none">
			<hr class="bg-info w-50 ml-0" style="height: .1px; border-radius: 10px; box-shadow: 0 0 3px 0px gray !important">
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<?php echo flash("caixa"); ?>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Comandas Ativas</div>
							<div class="h5 mb-0 font-weight-bold text-success pulsate"><i class="fas fa-circle"></i> <?php echo count($data['comandas']) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-bookmark fa-3x text-success rotate-n-15"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Comandas Pagas(Hoje)</div>
							<div class="h5 mb-0 font-weight-bold text-info pulsate"><i class="fas fa-circle"></i> <?php echo count($data['comandasClose']) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-check-circle fa-3x text-info rotate-n-15"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Pedidos Pendentes</div>
							<div class="h5 mb-0 font-weight-bold text-warning pulsate"><i class="fas fa-circle"></i> <?php echo $data['pedidosPendentes'] ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-hamburger fa-3x text-warning rotate-n-15"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Clientes (Hoje)</div>
							<div class="h5 mb-0 font-weight-bold text-primary pulsate"><i class="fas fa-circle"></i> <?php echo $data['clientes'] ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-3x text-primary rotate-n-15"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<!-- Pie Chart -->
		<div class="col-lg-4" >
			<div class="card shadow mb-4" >
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 text-center">
					<h6 class="m-0 font-weight-bold"><i class="fas fa-chart-pie"></i> Votações</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-1 pb-1" style="height: 200px !important">
						<canvas id="myPieChart"></canvas>
					</div>
					<div class="mt-3 text-center small">
						<span class="mr-2">
						<i class="fas fa-circle text-success"></i> Votos Sim
						</span>
						<span class="mr-2">
						<i class="fas fa-circle text-danger"></i> Votos Não
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
<!-- Page level plugins -->
<script src="<?php echo URLROOT; ?>/vendor/chart.js/Chart.min.js"></script>

<script src="<?php echo URLROOT; ?>/js/demo/chart-pie-demo.js"></script>
<script type="text/javascript">
	 var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Votos Sim", "Votos Não"],
            datasets: [{
                data: [
                	<?php echo $data['votosNao'] ?>, <?php echo $data['votosSim'] ?>
                ],
                backgroundColor: ['#1cc88a', '#e74a3b'],
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
        },
    });
</script>