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
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("header.php"); ?>
</head>
<body>
    <?php include("head-navbar.php"); ?>

    <!-- right sidebar -->
    <?php include("right-sidebar.php"); ?>
    
    <!-- left sidebar -->
    <?php include("left-sidebar.php"); ?>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="page-header">
                <div class="pd-20">
					<h4 class="text-center h4"><i class="dw dw-analytics1"></i> Laporan Kunjungan</h4>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Jumlah Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; $Transaksi = $Transaksi->get_laporan_kunjungan(); while ($row = $Transaksi->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
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
</body>
</html>