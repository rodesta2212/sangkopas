<?php

class Transaksi {
    private $conn;
    private $table_transaksi = 'transaksi';

    public $id_transaksi;
    public $id_user;
    public $tgl_transaksi;
    public $metode_pembayaran;
    public $total_harga;
    public $status;
    public $id_diskon;
    public $no_meja;

    public function __construct($db) {
		$this->conn = $db;
	}


    function insert() {
        $query = "INSERT INTO {$this->table_transaksi} 
		(id_user, tgl_transaksi, total_harga, status) 
		VALUES(:id_user, :tgl_transaksi, :total_harga, :status)";

        $stmt = $this->conn->prepare($query);
        // produk
        $stmt->bindParam(':id_user', $this->id_user);
		$stmt->bindParam(':tgl_transaksi', $this->tgl_transaksi);
        $stmt->bindParam(':total_harga', $this->total_harga);
        $stmt->bindParam(':status', $this->status);

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
        $new = intval(substr($latest, strlen($key)));
        $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
        return $key . $numb;
	}

    function readAll() {
		$query = "SELECT * FROM {$this->table_produk} ORDER BY id_produk ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_transaksi} WHERE id_user=:id_user LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_user', $this->id_user);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row == ""){
            return true;
        }else{
            $data['id_transaksi'] = $row['id_transaksi'];
            $data['id_user'] = $row['id_user'];
            $data['tgl_transaksi'] = $row['tgl_transaksi'];
            $data['metode_pembayaran'] = $row['metode_pembayaran'];
            $data['total_harga'] = $row['total_harga'];
            $data['status'] = $row['status'];
            $data['id_diskon'] = $row['id_diskon'];
            $data['no_meja'] = $row['no_meja'];
            return $data;
        }

	}

	function update() {
		$query = "UPDATE {$this->table_produk}
			SET
                id_produk = :id_produk,
				nama = :nama,
				kategori = :kategori,
                harga = :harga,
                foto = :foto,
                keterangan = :keterangan
			WHERE
				id_produk = :id_produk";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_produk', $this->id_produk);
		$stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':kategori', $this->kategori);
        $stmt->bindParam(':harga', $this->harga);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':keterangan', $this->keterangan);
        $stmt->bindParam(':id_produk', $this->id_produk);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function updateHarga() {
		$query = "UPDATE transaksi
			SET
                total_harga = :total_harga
			WHERE
				id_transaksi = :id_transaksi";
        $stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_transaksi', $this->id_transaksi_update);
		$stmt->bindParam(':total_harga', $this->total_harga);
	
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