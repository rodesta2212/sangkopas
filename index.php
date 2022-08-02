<!DOCTYPE html>
<html>

<?php
	include("config.php");
	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();
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
					<div class="col-md-6 col-sm-12">
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
					<div class="col-md-6 col-sm-12 text-right">
						<div class="dropdown">
							<a class="btn btn-primary dropdown-toggle" 
								href="#" role="button" data-toggle="dropdown">
								Makanan
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#">Minuman</a>
								<a class="dropdown-item" href="#">Snack</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3 mb-20">
					<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
						<div class="img pb-30">
						<img src="upload/ayamkremes.jpg" alt="gambar1" style="width:300px;">
						</div>
						<div class="content">
							<h3 class="h4">Ayam Kremes (nama produk)</h3>
							<p class="max-width-200">
								<h6>Rp. 15.000 (harga)</h6>
								<br/>
								Ayam Kremes tidak termasuk nasi. (keterangan)
							</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 mb-20">
					<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
						<div class="img pb-30">
						<img src="upload/ayamkremes.jpg" alt="gambar1" style="width:300px;">
						</div>
						<div class="content">
							<h3 class="h4">Ayam Kremes</h3>
							<p class="max-width-200">
								<h6>Rp. 15.000</h6>
								<br/>
								Ayam Kremes tidak termasuk nasi.
							</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 mb-20">
					<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
						<div class="img pb-30">
						<img src="upload/ayamkremes.jpg" alt="gambar1" style="width:300px;">
						</div>
						<div class="content">
							<h3 class="h4">Ayam Kremes</h3>
							<p class="max-width-200">
								<h6>Rp. 15.000</h6>
								<br/>
								Ayam Kremes tidak termasuk nasi.
							</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 mb-20">
					<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
						<div class="img pb-30">
						<img src="upload/ayamkremes.jpg" alt="gambar1" style="width:300px;">
						</div>
						<div class="content">
							<h3 class="h4">Ayam Kremes</h3>
							<p class="max-width-200">
								<h6>Rp. 15.000</h6>
								<br/>
								Ayam Kremes tidak termasuk nasi.
							</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 mb-20">
					<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
						<div class="img pb-30">
						<img src="upload/ayamkremes.jpg" alt="gambar1" style="width:300px;">
						</div>
						<div class="content">
							<h3 class="h4">Ayam Kremes</h3>
							<p class="max-width-200">
								<h6>Rp. 15.000</h6>
								<br/>
								Ayam Kremes tidak termasuk nasi.
							</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 mb-20">
					<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
						<div class="img pb-30">
						<img src="upload/ayamkremes.jpg" alt="gambar1" style="width:300px;">
						</div>
						<div class="content">
							<h3 class="h4">Ayam Kremes</h3>
							<p class="max-width-200">
								<h6>Rp. 15.000</h6>
								<br/>
								Ayam Kremes tidak termasuk nasi.
							</p>
						</div>
					</a>
				</div>
			</div>
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
</body>
</html>