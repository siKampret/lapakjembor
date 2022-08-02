<?php
session_start();
include 'config/koneksi.php';

// mendapatkan id dari url
$id_produk = $_GET['id'];

// query untuk mengambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
$detail = $ambil->fetch_assoc();

echo "<pre>";
print_r($detail);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lapak Djemboer</title>
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
</head>	
<body>

<!-- menu.php -->
<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="command/foto_produk/<?php echo $detail['foto_produk']; ?>" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail['nama_produk']; ?></h2>
				<h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4>
				<h5><strong>Stok Produk: </strong><?php echo $detail['stok_produk']; ?></h5>
				<p><?php echo $detail['deskripsi_produk']; ?></p>

					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input type="number" name="jumlah" class="form-control" max="<?php echo $detail['stok_produk']; ?>">
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
							</div>
						</div>
					</form>

							<?php
								// jika ada tombol beli
							if (isset($_POST['beli']))
							{
								// mendapatkan jumlah yang diinputkan
								$jumlah = $_POST['jumlah'];
								// masukkan di keranjang belanja
								$_SESSION['keranjang'][$id_produk] = $jumlah;

								echo "<script>alert('Produk telah masuk ke keranjang belanja anda !');</script>";
								echo "<script>location='keranjang.php';</script>";
							}
							?>
			</div>
		</div>
	</div>
</section>


</body>
</html>