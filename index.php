<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/produk.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();

	$Produk = new Produk($db);
?>

<!-- header -->
<?php include("header.php"); ?>

<body>
	<!-- head navbar -->
	<?php include("head-navbar.php"); ?>

	<!-- right sidebar -->
	<?php include("right-sidebar.php"); ?>

	<!-- left sidebar -->
	<?php include("left-sidebar.php"); ?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<?php if ($_SESSION['role'] != 'pelanggan'): ?>
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Selamat Datang
							<?php if ($_SESSION['role'] == 'admin'): ?>
								Admin
							<?php elseif ($_SESSION['role'] == 'kasir'): ?>
								Kasir
							<?php else: ?>
								Pelanggan
							<?php endif; ?>
							<div class="weight-600 font-30 text-blue"><?php echo $_SESSION['nama']; ?></div>
						</h4>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if ($_SESSION['role'] == 'pelanggan'): ?>
			<div class="page-header">
				<div class="row">
					<div class="col-12">
						<div class="title">
							<h4>Daftar Produk</h4>
						</div>
						<!-- <nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									Dashboard
								</li>
							</ol>
						</nav> -->
					</div>
					<div class="col-12">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-semua-tab" data-toggle="pill" href="#pills-semua" role="tab" aria-controls="pills-semua" aria-selected="true">Semua</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-makanan-tab" data-toggle="pill" href="#pills-makanan" role="tab" aria-controls="pills-makanan" aria-selected="false">Makanan</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-minuman-tab" data-toggle="pill" href="#pills-minuman" role="tab" aria-controls="pills-minuman" aria-selected="false">Minuman</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-snack-tab" data-toggle="pill" href="#pills-snack" role="tab" aria-controls="pills-snack" aria-selected="false">Minuman</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
			<form method="POST" enctype="multipart/form-data">
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-semua" role="tabpanel" aria-labelledby="pills-semua-tab">
						<div class="row">
							<?php $Produks = $Produk->readAll(); while ($row = $Produks->fetch(PDO::FETCH_ASSOC)) : ?>
								<div class="col-md-3 mb-20">
									<div class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
										<img src="upload/<?=$row['foto']?>" alt="<?=$row['foto']?>" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4"><?=ucwords($row['nama'])?></h3>
											<p class="max-width-200">
												<h6>Rp. <?=number_format($row['harga'],0,',','.')?></h6>
												<br/>
												<?=$row['keterangan']?>
											</p>
											<input id="jumlah" type="text" value="0" name="jumlah[]">
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-makanan" role="tabpanel" aria-labelledby="pills-makanan-tab">
						<div class="row">
							<?php $Produks = $Produk->readAllMakanan(); while ($row = $Produks->fetch(PDO::FETCH_ASSOC)) : ?>
								<div class="col-md-3 mb-20">
									<div class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
										<img src="upload/<?=$row['foto']?>" alt="<?=$row['foto']?>" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4"><?=ucwords($row['nama'])?></h3>
											<p class="max-width-200">
												<h6>Rp. <?=number_format($row['harga'],0,',','.')?></h6>
												<br/>
												<?=$row['keterangan']?>
											</p>
											<input id="jumlah" type="text" value="0" name="jumlah[]">
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-minuman" role="tabpanel" aria-labelledby="pills-minuman-tab">
						<div class="row">
							<?php $Produks = $Produk->readAllMinuman(); while ($row = $Produks->fetch(PDO::FETCH_ASSOC)) : ?>
								<div class="col-md-3 mb-20">
									<div class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
										<img src="upload/<?=$row['foto']?>" alt="<?=$row['foto']?>" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4"><?=ucwords($row['nama'])?></h3>
											<p class="max-width-200">
												<h6>Rp. <?=number_format($row['harga'],0,',','.')?></h6>
												<br/>
												<?=$row['keterangan']?>
											</p>
											<input id="jumlah" type="text" value="0" name="jumlah[]">
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-snack" role="tabpanel" aria-labelledby="pills-snack-tab">
						<div class="row">
							<?php $Produks = $Produk->readAllSnack(); while ($row = $Produks->fetch(PDO::FETCH_ASSOC)) : ?>
								<div class="col-md-3 mb-20">
									<div class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
										<img src="upload/<?=$row['foto']?>" alt="<?=$row['foto']?>" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4"><?=ucwords($row['nama'])?></h3>
											<p class="max-width-200">
												<h6>Rp. <?=number_format($row['harga'],0,',','.')?></h6>
												<br/>
												<?=$row['keterangan']?>
											</p>
											<input id="jumlah" type="text" value="0" name="jumlah[]">
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</form>
			<?php endif; ?>

			<!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
	<!-- bootstrap-touchspin js -->
	<script src="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
	<script src="vendors/scripts/advanced-components.js"></script>
	<script>
		$("input[name='jumlah[]']").TouchSpin({
			min: 0,
			max: 100
		});
	</script>
</body>
</html>