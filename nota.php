<?php
session_start();
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
</head>
<body>

<!-- menu.php -->
<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		
		<!-- nota disini copas aja dari nota yang ada di admin -->
		<h2>Detail Pembelian</h2>

<?php
	$ambil = $koneksi->query ("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = 
								pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]' ");
	$detail = $ambil->fetch_assoc();
?>

<!-- <pre><?php // print_r($detail); ?></pre> -->

<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain.
pelanggan yang beli harus pelanggan yang login -->
<?php 
// mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];

// mendapatkan id_pelanggan yang login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli !== $idpelangganyanglogin)
{
	echo "<script>alert('Hayo mau ngapain anda !');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian: <?php echo $detail['id_pembelian']; ?></strong><br>
		Tanggal: <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?><br>
		Total: Rp. <?php echo number_format($detail['total_pembelian']); ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
		<p>
			<?php echo $detail['telepon_pelanggan']; ?><br>
			<?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['tipe']; ?> <?php echo $detail['distrik']; ?> <?php echo $detail['provinsi']; ?></strong><br>
		Ongkos Kirim: Rp. <?php echo number_format($detail['ongkir']); ?> <br>
		Ekspedisi : <?php echo $detail['ekspedisi']; ?> <?php echo $detail['paket']; ?> <?php echo $detail['estimasi']; ?><br>
		Alamat: <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga Produk</th>
			<th>Berat</th>
			<th>Jumlah</th>
			<th>Subberat</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi -> query ("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]' "); ?>
		<?php while ($pecah = $ambil -> fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format ($pecah['harga']); ?></td>
			<td><?php echo $pecah['berat']; ?> Kg</td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['subberat']; ?> Kg</td>
			<td>Rp. <?php echo number_format ($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?> 
	</tbody>
</table>


<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran ke NO. Rekening:<strong> xxx-xxx-xxxx</strong> atas nama Adit<br>
				Total Belanja: Rp. <strong><?php echo number_format($detail['total_pembelian']); ?></strong>
			</p>
		</div>
	</div>
</div>

	</div>
</section>
</body>
</html>