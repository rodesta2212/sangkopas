<?php
    include("config.php");
    include_once('includes/transaksi.inc.php');
    include_once('includes/transaksi_detail.inc.php');
    include_once('includes/diskon.inc.php');
    $config = new Config(); 
    $db = $config->getConnection();

	$Transaksi = new Transaksi($db);
	$TransaksiDetail = new TransaksiDetail($db);
    $Diskon = new Diskon($db);
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

            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir'): ?>
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                            <div class="title">
                                <h4>List Transaksi</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="page-header">
                    <?php $Transaksi = $Transaksi->readAllTransaksi(); while ($row = $Transaksi->fetch(PDO::FETCH_ASSOC)) : ?>
                        <div class="card mb-2">

                            <div class="card-header row mx-0">
                                <div class="col-6">
                                    <h4>Kode Transaksi : <?= $row['id_transaksi'] ?></h4>
                                </div>
                                <div class="col-6">
                                    <h4 class="float-right">Tanggal Transaksi : <?= $row['tgl_transaksi'] ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#verifikasiModal<?= $row['id_transaksi'] ?>">Verifikasi</button>
                                <div class="row mb-1">
                                    <div class="col">
                                        <h4>Status Transaksi : <?= ucwords($row['status']) ?></h4>
                                    </div>
                                    <div class="col">
                                    <h4>Metode Pembayaran : <?= $row['metode_pembayaran'] != "" ? ucwords($row['metode_pembayaran']) : "-" ?></h4>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Item</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $subtotal = 0;
                                            $TransaksiDetail->id_transaksi = $row['id_transaksi'];
                                            foreach($TransaksiDetail->readAll() as $item)
                                        :?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $item['nama'] ?></td>
                                            <td><?= number_format($item['harga'],0,'.','.'); ?></td>
                                            <td><?= $item['jumlah'] ?></td>
                                            <td><?= number_format($item['jumlah'] * $item['harga'],0,'.','.') ?></td>
                                        </tr>
                                        <?php 
                                            $subtotal += $item['jumlah']*$item['harga'];
                                            $i++;
                                            endforeach; 
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right">Sub Total Item</td>
                                            <td><?= number_format($subtotal,0,'.','.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">Diskon</td>
                                            <td><?= number_format($row['potongan'],0,'.','.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">Total</td>
                                            <?php if($row['id_diskon'] != 0):?>
                                                <td><?= number_format($subtotal-$row['potongan'],0,'.','.'); ?></td>
                                            <?php else:?>
                                                    <td><?= number_format($subtotal,0,'.','.'); ?></td>
                                            <?php endif;?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal fade" id="verifikasiModal<?= $row['id_transaksi'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <form action="transaksi_verifikasi.php" method="POST" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verikasi Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="id_transaksi">Id Transaksi</label>
                                            <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" value="<?= $row['id_transaksi'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="metode_pembayaran">Metode Pembayaran</label>
                                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                                                <option value="Tunai">Tunai</option>
                                                <option value="Non Tunai">Non Tunai</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="diskon">Diskon</label>
                                            <select name="diskon" id="diskon" class="form-control">
                                                <option value="0">Pilih Diskon</option>
                                                <?php foreach($Diskon->readAll() as $d):?>
                                                    <option value="<?= $d['id_diskon'] ?>"><?= $d['nama'] ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="lunas">Lunas</option>
                                                <option value="belum lunas">Belum Lunas</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_meja">Nomor Meja</label>
                                            <input type="number" class="form-control" id="no_meja" name="no_meja">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
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