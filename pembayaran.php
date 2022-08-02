<?php
session_start();
include 'config/koneksi.php';


// jika tida ada session pelanggan (belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
}


// mendapatkan id_pembelian dari URL
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem' ");
$detpem = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detpem);
// print_r($_SESSION);
// echo "</pre>";

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) 
{
	echo "<script>alert('Hayo ! mau ngapain anda ?!');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Belanja</title>
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim bukti pembayaran anda disini</p>
	<div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]); ?></strong></div>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Pembeli</label>
			<input type="text" name="nama" class="form-control">
		</div>
		<div class="form-group">
			<label>Nama Bank</label>
			<input type="text" name="bank" class="form-control">
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" name="jumlah" class="form-control" min="1">
		</div>
		<div class="form-group">
			<label>Bukti Pembayaran</label>
			<input type="file" name="bukti" class="form-control">
			<p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
		</div>
		<button class="btn btn-primary" name="kirim">Kirim</button>
	</form>
</div>

<?php 
// jika tombol kirim di klik
	if (isset($_POST['kirim'])) 
	{
		// upload bukti foto pembayaran
		$namabukti = $_FILES["bukti"]["name"];
		$lokasibukti = $_FILES["bukti"]["tmp_name"];
		$namafiks = date("YmdHis"). $namabukti;
		move_uploaded_file($lokasibukti, "buktipembayaran/$namafiks");

		$nama = $_POST['nama'];
		$bank = $_POST['bank'];
		$jumlah = $_POST['jumlah'];
		$tanggal = date('Y-m-d');

		// simpan data pembayaran
		$koneksi->query("INSERT INTO pembayaran (id_pembelian, nama, bank, jumlah, tanggal, bukti) 
			VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

		// update data pembelian dari pending, menjadi sudah kirim pembayaran
		$koneksi->query("UPDATE pembelian SET status_pembelian = 'sudah kirim pembayaran' WHERE id_pembelian = 
			'$idpem' ");

		echo "<script>alert('Terimakasih sudah mengirim bukti pembayaran anda');</script>";
		echo "<script>location='index.php';</script>";
	}
?>
</body>
</html>