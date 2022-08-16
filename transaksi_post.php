<?php
    include("config.php");
    include_once('includes/produk.inc.php');
    include_once('includes/transaksi.inc.php');
    include_once('includes/transaksi_detail.inc.php');
    session_start();
    $id_user = $_SESSION['id_user'];
    $config = new Config(); 
    $db = $config->getConnection();
    $Produk = new Produk($db);
    $Transaksi = new Transaksi($db);
    $TransaksiDetail = new TransaksiDetail($db);

    $id_produk = $_POST["id_produk"];
    $jumlah_barang = $_POST["jumlah"];

    if($_POST && $jumlah_barang > 0){
        $Transaksi->id_user =  $_SESSION['id_user'];
        $Transaksi->tgl_transaksi =  date('Y-m-d');
        $Transaksi->total_harga = 0;
        $Transaksi->status =  "belum bayar";
        $Produk->id_produk = $id_produk;
        $Produk->readOne();
        $cek_transaksi = $Transaksi->readOne();
    
        if($cek_transaksi != 1){
            $TransaksiDetail->id_produk =  $id_produk;
            $cek_detail_transaksi = $TransaksiDetail->readOneByProduk();
            if($cek_detail_transaksi != ""){
                echo "here";
            }else{
                echo "here2";
            }
            print('<pre>');print_r($cek_detail_transaksi);exit();
            // $TransaksiDetail->id_transaksi =  $cek_transaksi['id_transaksi'];
            // $TransaksiDetail->harga =  $Produk->harga;
            // $TransaksiDetail->jumlah =  $jumlah_barang;
            // $TransaksiDetail->insert();
            // header("Location: index.php");
        }else{
            $Transaksi->insert();
            $last_id = $Transaksi->getNewID();
            $TransaksiDetail->id_transaksi =  $last_id;
            $TransaksiDetail->id_produk =  $id_produk;
            $TransaksiDetail->harga =  $Produk->harga;
            $TransaksiDetail->jumlah =  $jumlah_barang;
            $TransaksiDetail->insert();
            $Transaksi->id_transaksi_update = $last_id;
            $Transaksi->total_harga = $Produk->harga;
            $Transaksi->updateHarga();
            header("Location: index.php");
        }
    }else{
        // return false;
    }