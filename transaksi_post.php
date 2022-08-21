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

    $arr_produk = $_POST['produk'];
    $new = array_filter($arr_produk, function ($var) {
        return ($var['qty'] > 0);
    });
    if($Transaksi->getNewId() == 1){
        $id_transaksi = date('ymd')."001";
    }else{
        $id_transaksi = $Transaksi->getNewId();
    }
    $Transaksi->id_user =  $_SESSION['id_user'];
    $cek_transaksi = $Transaksi->readOne();

    $Transaksi->status =  "belum bayar";
    $Transaksi->tgl_transaksi =  date('Y-m-d');
    if($cek_transaksi != 1) {
        foreach($new as $n){
            $TransaksiDetail->id_produk =  $n['id_produk'];
            $cek_detail_transaksi = $TransaksiDetail->readOneByProduk();
            $Produk->id_produk = $n['id_produk'];
            $Produk->readOne(); 
            if($cek_detail_transaksi['status'] != 0){
                $TransaksiDetail->id_transaksi_detail =  $cek_detail_transaksi['id_transaksi_detail'];
                $TransaksiDetail->jumlah =  $n['qty'] + $cek_detail_transaksi['jumlah'];
                $TransaksiDetail->updateJumlah();
                $Transaksi->id_transaksi = $cek_transaksi['id_transaksi'];
                $Transaksi->total_harga = $cek_transaksi['total_harga'] +  ($n['qty'] * $Produk->harga);
                $Transaksi->updateHarga();
                header("Location: index.php");
            }else{
                $TransaksiDetail->id_transaksi_detail = $TransaksiDetail->getNewId();
                $TransaksiDetail->id_transaksi =  $cek_transaksi['id_transaksi'];
                $TransaksiDetail->id_produk =  $n['id_produk'];
                $TransaksiDetail->harga =  $Produk->harga;
                $TransaksiDetail->jumlah =  $n['qty'];
                $TransaksiDetail->insert();
                $Transaksi->id_transaksi = $cek_transaksi['id_transaksi'];
                $Transaksi->total_harga = $cek_transaksi['total_harga'] +  ($n['qty'] * $Produk->harga);
                $Transaksi->updateHarga();
                header("Location: index.php");
            }
        }
    }else{
        $Transaksi->id_transaksi = $id_transaksi;
        $Transaksi->insert();
        $sub_total_produk = 0;
        foreach($new as $n) {
            $Produk->id_produk = $n['id_produk'];
            $Produk->readOne(); 
            $cek_transaksi = $Transaksi->readOne();
            $TransaksiDetail->id_transaksi_detail = $TransaksiDetail->getNewId();
            $TransaksiDetail->id_transaksi = $id_transaksi;
            $TransaksiDetail->id_produk =  $n['id_produk'];
            $TransaksiDetail->harga =  $Produk->harga;
            $TransaksiDetail->jumlah =  $n['qty'];
            $TransaksiDetail->insert();
            $sub_total_produk += $n['qty'] * $Produk->harga;
        }
        $Transaksi->total_harga = $sub_total_produk;
        $Transaksi->updateHarga();
        
        header("Location: transaksi_list.php?id=".$id_user."");
    }
    
    print('<pre>');print_r($new);
    // exit();

    // if($_POST && $jumlah_barang > 0){
    //     $Transaksi->id_user =  $_SESSION['id_user'];
    //     $Transaksi->tgl_transaksi =  date('Y-m-d');
    //     $Transaksi->total_harga = 0;
    //     
    //     $Produk->id_produk = $id_produk;
    //     $Produk->readOne();
    //     $cek_transaksi = $Transaksi->readOne();
    
    //     if($cek_transaksi != 1){
    //         $TransaksiDetail->id_produk =  $id_produk;
    //         $cek_detail_transaksi = $TransaksiDetail->readOneByProduk();
    //         // print('<pre>');print_r($cek_detail_transaksi);exit();
    //         if($cek_detail_transaksi['status'] != 0){
    //             $TransaksiDetail->id_transaksi_detail =  $cek_detail_transaksi['id_transaksi_detail'];
    //             $TransaksiDetail->jumlah =  $jumlah_barang + $cek_detail_transaksi['jumlah'];
    //             $TransaksiDetail->updateJumlah();
    //             $Transaksi->id_transaksi_update = $cek_transaksi['id_transaksi'];
    //             $Transaksi->total_harga = $cek_transaksi['total_harga'] +  ($jumlah_barang * $Produk->harga);
    //             $Transaksi->updateHarga();
    //             header("Location: index.php");
    //         }else{
    //             $TransaksiDetail->id_transaksi =  $cek_transaksi['id_transaksi'];
    //             $TransaksiDetail->id_produk =  $id_produk;
    //             $TransaksiDetail->harga =  $Produk->harga;
    //             $TransaksiDetail->jumlah =  $jumlah_barang;
    //             $TransaksiDetail->insert();
    //             $Transaksi->id_transaksi_update = $cek_transaksi['id_transaksi'];
    //             $Transaksi->total_harga = $cek_transaksi['total_harga'] +  ($jumlah_barang * $Produk->harga);
    //             $Transaksi->updateHarga();
    //             header("Location: index.php");
    //         }
    //     }else{
    //         $Transaksi->insert();
    //         $last_id = $Transaksi->getNewID();
    //         $TransaksiDetail->id_transaksi =  $last_id;
    //         $TransaksiDetail->id_produk =  $id_produk;
    //         $TransaksiDetail->harga =  $Produk->harga;
    //         $TransaksiDetail->jumlah =  $jumlah_barang;
    //         $TransaksiDetail->insert();
    //         $Transaksi->id_transaksi_update = $last_id;
    //         $Transaksi->total_harga = $Produk->harga;
    //         $Transaksi->updateHarga();
    //         header("Location: index.php");
    //     }
    // }else{
    // }