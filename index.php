<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/produk.inc.php');
	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); 
	$db = $config->getConnection();
	$produk = new Produk($db);
	$data_produk = $produk->readAll();
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
						<ul class="nav nav-pills">
							<li class="nav-item">
								<a class="nav-link active" id="menuSemua" href="#" onclick="semua()">Semua</a>
							</li>
							<li class="nav-item"> 
								<a class="nav-link" id="menuMakanan" href="#" onclick="makanan()">Makanan</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="menuMinuman" href="#" onclick="minuman()">Minuman</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="menuSnack" href="#" onclick="snack()">Snack</a>
							</li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-12 text-right">
						<a class="btn btn-success" href="#">Keranjang</a>
					</div>
				</div>
			</div>

			<div class="row" id="semua">
				<?php foreach($data_produk as $dp):?>
					<div class="col-md-3 mb-20">
						<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
							<div class="img pb-30">
							<img src="upload/<?= $dp['foto']?>" alt="foto_produk" style="width:300px;">
							</div>
							<div class="content">
								<h3 class="h4"><?= $dp['nama'] ?></h3>
								<p class="max-width-200">
									<h6>Rp. <?= number_format($dp['harga'],0,',','.')?></h6>
									<br/>
									<?= $dp['keterangan'] ?>
								</p>
							</div>
						</a>
					</div>
				<?php endforeach;?>
			</div>
			<div class="row d-none" id="makanan">
				makanan
			</div>
			<div class="row d-none" id="minuman">
				minuman
			</div>
			<div class="row d-none" id="snack">
				snack
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script>
	
			const semua = () => {
				$('#menuSemua').addClass('active');
				$('#menuMakanan').removeClass('active');
				$('#menuMinuman').removeClass('active');
				$('#menuSnack').removeClass('active');
				$('#semua').removeClass('d-none')
				$('#makanan').addClass('d-none')
				$('#minuman').addClass('d-none')
				$('#makanan').empty();
				$('#minuman').empty();
				$('#snack').empty();
			}

			const makanan = () => {
				$('#menuSemua').removeClass('active');
				$('#menuMakanan').addClass('active');
				$('#menuMinuman').removeClass('active');
				$('#menuSnack').removeClass('active');
				$('#semua').addClass('d-none')
				$('#makanan').removeClass('d-none')
				$('#minuman').addClass('d-none')
				$.ajax({
					url : "./pelanggan/get_produk_makanan.php",
					dataType: "JSON",
					success: function(res){
						let html = '';
						$('#makanan').empty();
						$('#minuman').empty();
						$('#snack').empty();
						$.each(res, function(key, val){
							html += `<div class="col-md-3 mb-20">
										<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
											<img src="upload/${val.foto}" alt="foto_produk" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4">${val.nama}</h3>
											<p class="max-width-200">
												<h6>Rp. ${val.hargaRp}</h6>
												<br/>
												${val.keterangan}
												<button type="button" class="btn btn-sm btn-success btn-block">Beli</button>
											</p>
										</div>
										</a>
									</div>`
						})
						$('#makanan').append(html);
					}
				})
			}

			const minuman = () => {
				$('#menuSemua').removeClass('active');
				$('#menuMakanan').removeClass('active');
				$('#menuMinuman').addClass('active');
				$('#menuSnack').removeClass('active');
				$('#semua').addClass('d-none')
				$('#makanan').addClass('d-none')
				$('#minuman').removeClass('d-none')
				$.ajax({
					url : "./pelanggan/get_produk_minuman.php",
					dataType: "JSON",
					success: function(res){
						let html = '';
						$('#makanan').empty();
						$('#minuman').empty();
						$('#snack').empty();
						$.each(res, function(key, val){
							html += `<div class="col-md-3 mb-20">
										<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
											<img src="upload/${val.foto}" alt="foto_produk" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4">${val.nama}</h3>
											<p class="max-width-200">
												<h6>Rp. ${val.hargaRp}</h6>
												<br/>
												${val.keterangan}
											</p>
										</div>
										</a>
									</div>`
						})
						$('#minuman').append(html);
					}
				})
			}
	
			const snack = () => {
				$('#menuSemua').removeClass('active');
				$('#menuMakanan').removeClass('active');
				$('#menuMinuman').removeClass('active');
				$('#menuSnack').addClass('active');
				$('#semua').addClass('d-none')
				$('#makanan').addClass('d-none')
				$('#minuman').addClass('d-none')
				$('#snack').removeClass('d-none')
				$.ajax({
					url : "./pelanggan/get_produk_snack.php",
					dataType: "JSON",
					success: function(res){
						let html = '';
						$('#makanan').empty();
						$('#minuman').empty();
						$('#snack').empty();
						$.each(res, function(key, val){
							html += `<div class="col-md-3 mb-20">
										<a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
										<div class="img pb-30">
											<img src="upload/${val.foto}" alt="foto_produk" style="width:300px;">
										</div>
										<div class="content">
											<h3 class="h4">${val.nama}</h3>
											<p class="max-width-200">
												<h6>Rp. ${val.hargaRp}</h6>
												<br/>
												${val.keterangan}
												<button type="button" class="btn btn-sm btn-success btn-block">Beli</button>
											</p>
										</div>
										</a>
									</div>`
						})
						$('#snack').append(html);
					}
				})
			}
	
	</script>
</body>
</html>