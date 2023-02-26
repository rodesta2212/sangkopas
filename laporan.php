<!DOCTYPE html>
<html>

<?php
	include("config.php");
    include_once('includes/transaksi.inc.php');
    include_once('includes/transaksi_detail.inc.php');
    $config = new Config(); 
    $db = $config->getConnection();

    $Transaksi = new Transaksi($db);
    $TransaksiDetail = new TransaksiDetail($db);
    session_start();
    $Transaksi->id_user =  $_SESSION['id_user'];
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
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <form action="laporan_search.php" method="GET" class="col-5 px-0">
                            <div class="input-group mb-3">
                                <input type="date" name="tanggal1" class="form-control" >
                                <div class="col-1 d-flex align-items-center border">-</div>
                                <input type="date" name="tanggal2" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info btn-sm">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="h5 mb-0">Laporan Grafik</div>
                        <div id="bar-transaksi"></div>
                    </div>
                </div>
            </div>
            <script>
                Morris.Bar({
                    element: 'bar-transaksi',
                    data: [
                        <?php $Grafik = $Transaksi->LaporanGrafik(); while ($row = $Grafik->fetch(PDO::FETCH_ASSOC)) : ?>
                            { x: '<?=$row['tgl_transaksi']?>', data1: <?=$row['jml_transaksi']?> },
                        <?php endwhile; ?>
                    ],
                    xkey: 'x',
                    ykeys: ['data1'],
                    labels: ['Transaksi'],
                    // barColors: ["#0000FF"]
                });
            </script>
            <div class="page-header">
                <div class="pd-20">
					<h4 class="text-center h4"><i class="dw dw-analytics1"></i> Laporan</h4>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tgl Transaksi</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; $Transaksi = $Transaksi->get_laporan_penjualan(); while ($row = $Transaksi->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['tgl_transaksi'] ?></td>
                                <td><?= $row['id_transaksi'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= number_format($row['subtotal'],0,',','.') ?></td>
                                <td><?= $row['potongan'] == null ? "0" : $row['potongan'] ?></td>
                                <td><?= number_format($row['subtotal'] - $row['potongan'],0,',','.')?></td>
                            </tr>
                        <?php $no++; endwhile; ?>
                        <?php if ($no == 0): ?>
                            <tr>
                                <td class="text-center" colspan="7">Belum Ada Transaksi</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            
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