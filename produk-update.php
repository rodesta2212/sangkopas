<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/produk.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'pelanggan') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Produk = new Produk($db);
	$Produk->id_produk = $id;
	$Produk->readOne();
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

    <?php
        // post img
		if(isset($_FILES['foto'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['foto']['name']);
			$file_size =$_FILES['foto']['size'];
			$file_tmp =$_FILES['foto']['tmp_name'];
			$file_type=$_FILES['foto']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");

			if(in_array($file_extension,$extensions)=== false){
				$errors[]="extension not allowed, please choose a JPEG, JPG, PNG, or PDF file.";
			}

			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}

			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
			}else{
				print_r($errors);
			}
		}

		if($_POST){
			// update
			$Produk->id_produk = $_POST["id_produk"];
            $Produk->nama = $_POST["nama"];
            $Produk->kategori = $_POST["kategori"];
            $Produk->harga = $_POST["harga"];
            $Produk->keterangan = $_POST["keterangan"];

			// post name img
			if (!empty($_FILES['foto']['name'])){
				$Produk->foto = $_FILES['foto']['name'];
			} else{
				$Produk->foto = $Produk->foto;
			}

			if ($Produk->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='produk.php'</script>";
			} else {
				echo '<script language="javascript">';
                echo 'alert("Data Gagal Terkirim")';
                echo '</script>';
			}
		}
	?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Update Ujian</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
                        <!-- hidden -->
                        <input type="hidden" name="id_produk" value="<?php echo $Produk->id_produk; ?>">
                        <!-- hidden -->
                        <div style="padding-right:15px;">
                            <!-- <a href="ujian-create"> -->
                                <button type="submit" class="btn btn-success float-right">Simpan</button>
                            <!-- </a> -->
                        </div>
                        <!-- horizontal Basic Forms Start -->
                        <div class="pd-20 mb-30">
                                <div class="form-group">
                                    <label>Nama Ujian</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $Produk->nama; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nilai Lulus</label>
                                    <input type="number" class="form-control" name="nilai_lulus" value="<?php echo $Produk->nilai_lulus; ?>">
                                </div>
                        </div>
					</form>
				</div>
				<!-- Simple Datatable End -->
			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
