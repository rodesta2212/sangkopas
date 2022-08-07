<?php
	include("../config.php");
	include_once('../includes/produk.inc.php');
	$config = new Config(); 
	$db = $config->getConnection();
	$produk = new Produk($db);
	$data_makanan = $produk->readAllSnack();
	
	$i = 0;
	foreach($data_makanan as $mak){
		$data[$i]['id_produk'] = $mak['id_produk'];
		$data[$i]['nama'] = $mak['nama'];
		$data[$i]['kategori'] = $mak['kategori'];
		$data[$i]['harga'] = $mak['harga'];
		$data[$i]['hargaRp'] = number_format($mak['harga'],0,',','.');
		$data[$i]['foto'] = $mak['foto'];
		$data[$i]['keterangan'] = $mak['keterangan'];
		$i++;
	}
	echo json_encode($data);
?>