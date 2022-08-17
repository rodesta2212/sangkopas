<?php
    include("config.php");
    include_once('includes/produk.inc.php');

    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("header.php"); ?>
<body>
    <?php include("head-navbar.php"); ?>

    <!-- right sidebar -->
    <?php include("right-sidebar.php"); ?>

    <!-- left sidebar -->
    <?php include("left-sidebar.php"); ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">

            <?php if ($_SESSION['role'] == 'pelanggan'): ?>
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                            <div class="title">
                                <h4>List Transaksi</h4>
                            </div>
                        </div>
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
    <!-- bootstrap-touchspin js -->
    <script src="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
    <script src="vendors/scripts/advanced-components.js"></script>
    <script>
        $("input[name='jumlah']").TouchSpin({
            min: 0,
            max: 100
        });
    </script>
</body>
</html>