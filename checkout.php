<?php
session_start();

include 'config/koneksi.php';
// jika tidak ada session pelanggan (belum login). maka akan dilarikan ke halaman login.php
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu !');</script>";
	echo "<script>location='login.php';</script>";
}
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
		<h1>Checkout Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor = 1; ?>
				<?php $totalberat = 0; ?>
				<?php $totalbelanja = 0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>

				<!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
				<?php 
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
				 	$pecah = $ambil->fetch_assoc();
				 	$subharga = $pecah["harga_produk"]*$jumlah;
				 	// subberat diperoleh dari berat x jumlah
				 	$subberat = $pecah["berat"] * $jumlah;
				 	// total berat
				 	$totalberat += $subberat;

				 	// echo "<pre>";
				 	// print_r($pecah);
				 	// echo "</pre>";
				?>	 
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama_produk']; ?></td>
					<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
				</tr>

				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
				<?php endforeach ?>
			
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp. <?php echo number_format($totalbelanja); ?></th>
				</tr>
			</tfoot>
		</table>

		<form method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>"
						class="form-control">
					</div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
					<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan'] ?>"
					class="form-control">
				</div>
			</div>
			<!-- <div class="col-md-4">
				<select class="form-control" name="id_ongkir">
					<option value="">Pilih Ongkos Kirim</option>
					<?php
						$ambil = $koneksi->query("SELECT * FROM ongkir");
						while ($perongkir = $ambil->fetch_assoc()) {
					?>
					<option value="<?php echo $perongkir['id_ongkir']; ?>">
						<?php echo $perongkir['nama_kota']; ?> - 
						Rp. <?php echo number_format($perongkir['tarif']); ?>
					</option>
				<?php } ?>
				</select>
			</div> -->
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman (termasuk kode POS)"></textarea>
			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Provinsi</label>
						<select class="form-control" name="nama_provinsi">

						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Distrik</label>
						<select class="form-control" name="nama_distrik">
							
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Ekspedisi</label>
						<select class="form-control" name="nama_ekspedisi">

						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Paket</label>
						<select class="form-control" name="nama_paket">
							
						</select>
					</div>
				</div>
			</div>
			<input type="text" name="total_berat" value="<?php echo $totalberat; ?>">
			<input type="text" name="provinsi">
			<input type="text" name="distrik">
			<input type="text" name="tipe">
			<input type="text" name="kodepos">
			<input type="text" name="ekspedisi">
			<input type="text" name="paket">
			<input type="text" name="ongkir">
			<input type="text" name="estimasi">

			<button class="btn btn-primary" name="checkout">
				<i class="glyphicon glyphicon-export"></i>Checkout
			</button>
		</form>
		<?php
			if (isset($_POST['checkout']))
			{
				$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
				
				$tanggal_pembelian = date('Y-m-d');
				$alamat_pengiriman = $_POST['alamat_pengiriman'];

				$totalberat = $_POST["total_berat"]; 
				$provinsi = $_POST["provinsi"]; 
				$distrik = $_POST["distrik"]; 
				$tipe = $_POST["tipe"]; 
				$kodepos = $_POST["kodepos"]; 
				$ekspedisi = $_POST["ekspedisi"]; 
				$paket = $_POST["paket"]; 
				$ongkir = $_POST["ongkir"]; 
				$estimasi = $_POST["estimasi"];
				

				$total_pembelian = $totalbelanja + $ongkir;
				
				// 1. menyimpan data ke table pembelian
				$koneksi->query("INSERT INTO pembelian 
					(id_pelanggan, tanggal_pembelian, total_pembelian, alamat_pengiriman, totalberat, provinsi, distrik, tipe, kodepos, ekspedisi, paket, ongkir, estimasi) 
					VALUES ('$id_pelanggan', '$tanggal_pembelian', '$total_pembelian', '$alamat_pengiriman', '$totalbera', '$provinsi', '$distrik', '$tipe', '$kodepos', '$ekspedisi', '$paket', '$ongkir','$estimasi')");

				// mendapatkan id_pembelian yang barusan terjadi

				$id_pembelian_barusan = $koneksi->insert_id;

				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
				{
					// mendapatkan data produk berdasarkan id_produk
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
					$perproduk = $ambil->fetch_assoc();

					$nama = $perproduk['nama_produk'];
					$harga = $perproduk['harga_produk'];
					$berat = $perproduk['berat'];

					$subberat = $perproduk['berat']*$jumlah;
					$subharga = $perproduk['harga_produk']*$jumlah;

					$koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, 
						berat, subberat, subharga, jumlah) VALUES 
						('$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$berat', 
						'$subberat', '$subharga', '$jumlah') ");


					// skrip update stok_produk
					$koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah
						WHERE id_produk = '$id_produk' ");
				}

				// mengkosongkan keranjang belanja
				unset($_SESSION['keranjang']);

				// tampilan dialihkan ke halaman nota, nota dari pembelian yang baru.

				echo "<script>alert('pembelian anda sukses !');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
			}
		?>
	</div>
</section>
<!-- <pre><?php //print_r($_SESSION['pelanggan']) ?></pre>
<pre><?php //print_r($_SESSION['keranjang']) ?></pre> -->

<script type="text/javascript" src="style/js/jquery.min.js"></script>
<script type="text/javascript" src="style/js/bootstrap.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				type:'post',
				url:'dataprovinsi.php',
				success:function(hasil_provinsi)
				{
					$("select[name=nama_provinsi]").html(hasil_provinsi);
				}
			});

			$("select[name=nama_provinsi]").on("change",function(){
				//ambil id_provinsi yang dipilih
				var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
				$.ajax({
					type:'post',
					url:'datadistrik.php',
					data:'id_provinsi='+id_provinsi_terpilih,
					success:function(hasil_distrik)
					{
						$("select[name=nama_distrik]").html(hasil_distrik);
					}
				});
			});

			$.ajax({
				type:'post',
				url:'dataekspedisi.php',
				success:function(hasil_eskpedisi)
				{
					$("select[name=nama_ekspedisi]").html(hasil_eskpedisi);
				}
			});

			$("select[name=nama_ekspedisi]").on("change",function(){
				//mendapatkan data ongkos kirim 

				//mendapatkan ekspedisi yang dipilih
				var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
			
				//mendapatkan id_distrik yang dipilih
				var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");

				//mendapatkan total_berat
				var total_berat = $("input[name=total_berat]").val();
				$.ajax({
					type:'post',
					url:'datapaket.php',
					data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
					success:function(hasil_paket)
					{
						// console.log(hasil_paket);
						$("select[name=nama_paket]").html(hasil_paket);

						//letakkan nama ekspedisi terpilih di input ekspedisi
						$("input[name=ekspedisi]").val(ekspedisi_terpilih);
					}
				});
			});
			$("select[name=nama_distrik]").on("change",function(){
				var prov = $("option:selected",this).attr("nama_provinsi");
				var dist = $("option:selected",this).attr("nama_distrik");
				var tipe = $("option:selected",this).attr("tipe_distrik");
				var kodepos = $("option:selected",this).attr("kodepos");
				
				$("input[name=provinsi]").val(prov);
				$("input[name=distrik]").val(dist);
				$("input[name=tipe]").val(tipe);
				$("input[name=kodepos]").val(kodepos);
			});

			$("select[name=nama_paket]").on("change",function(){
				var paket = $("option:selected",this).attr("paket");
				var ongkir = $("option:selected",this).attr("ongkir");
				var etd = $("option:selected",this).attr("etd");

				$("input[name=paket]").val(paket);
				$("input[name=ongkir]").val(ongkir);
				$("input[name=estimasi]").val(etd);
			});
		});
	</script>
</body>
</html>