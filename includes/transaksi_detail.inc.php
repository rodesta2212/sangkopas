<?php

class TransaksiDetail {
    private $conn;
    private $table_transaksi_detail = 'transaksi_detail';

    public $id_transaksi_detail;
    public $id_transaksi;
    public $id_produk;
    public $harga;
    public $jumlah;

    public function __construct($db) {
		$this->conn = $db;
	}

    function insert() {
        $query = "INSERT INTO {$this->table_transaksi_detail} 
		(id_transaksi, id_produk, harga, jumlah) 
		VALUES(:id_transaksi, :id_produk, :harga, :jumlah)";

        $stmt = $this->conn->prepare($query);
        // produk
        $stmt->bindParam(':id_transaksi', $this->id_transaksi);
		$stmt->bindParam(':id_produk', $this->id_produk);
        $stmt->bindParam(':harga', $this->harga);
        $stmt->bindParam(':jumlah', $this->jumlah);

		if ($stmt->execute()) {
            // var_dump($stmt);
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT MAX(id_transaksi) AS code FROM {$this->table_transaksi} ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function genCode($latest, $key, $chars = 0) {
        $new = intval(substr($latest, strlen($key))) + 1;
        $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
        return $key . $numb;
	}

    function readAll() {
		$query = "SELECT * FROM {$this->table_produk} ORDER BY id_produk ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOneByProduk() {
		$query = "SELECT * FROM {$this->table_transaksi_detail} WHERE id_produk=:id_produk LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_produk', $this->id_produk);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($row != ""){
			$data['status'] = 1;
			$data['id_transaksi_detail'] = $row['id_transaksi_detail'];
			$data['id_transaksi'] = $row['id_transaksi'];
			$data['id_produk'] = $row['id_produk'];
			$data['harga'] = $row['harga'];
			$data['jumlah'] = $row['jumlah'];
		}else{
			$data['status'] = 0;
		}

        return $data;
	}

	function updateJumlah() {
		$query = "UPDATE {$this->table_transaksi_detail}
			SET
                jumlah = :jumlah
			WHERE
			id_transaksi_detail = :id_transaksi_detail";
        $stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':id_transaksi_detail', $this->id_transaksi_detail);
		$stmt->bindParam(':jumlah', $this->jumlah);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

    function delete() {
		$query = "DELETE FROM {$this->table_produk} WHERE id_produk = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_produk);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
    }
}