<?php  
$id_produk = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori
	WHERE id_produk = '$id_produk' ");
$detailproduk = $ambil->fetch_assoc();

$fotoproduk = array();
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk = '$id_produk' ");
while ($tiap = $ambilfoto->fetch_assoc()) 
{
	$fotoproduk[] = $tiap;
}

// echo "<pre>";
// print_r($detailproduk);
// print_r($fotoproduk);
// echo "</pre>";
?>
<h2>Detail Produk</h2>

<table class="table">
	<tr>
		<th>Kategori</th>
		<td><?php echo $detailproduk['nama_kategori']; ?></td>
	</tr>
	<tr>
		<th>Produk</th>
		<td><?php echo $detailproduk['nama_produk']; ?></td>
	</tr>
	<tr>
		<th>Harga</th>
		<td>Rp. <?php echo number_format($detailproduk['harga_produk']); ?></td>
	</tr>
	<tr>
		<th>Berat</th>
		<td><?php echo $detailproduk['berat']; ?> Gr</td>
	</tr>
	<tr>
		<th>Deskripsi</th>
		<td><?php echo $detailproduk['deskripsi_produk']; ?></td>
	</tr>
	<tr>
		<th>Stok</th>
		<td><?php echo $detailproduk['stok_produk']; ?></td>
	</tr>
</table>

<div class="row">
	<?php foreach ($fotoproduk as $key => $value): ?> 

	<div class="col-md-3">
		<img src="foto_produk/<?php echo $value['nama_foto_produk'] ?>" class="img-responsive">
		<a href="index.php?page=hapusfotoproduk&idfoto=<?php echo $value['id_produk_foto'] ?>&idproduk=<?php echo $id_produk ?>" class="btn btn-danger">Hapus</a>
	</div>
<?php endforeach ?>
</div>


<hr>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>File Foto</label>
		<input type="file" name="fotoprodak" class="form-control">
	</div>
	<button class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
</form>

<?php  
if (isset($_POST['simpan'])) 
{
	$lokasifoto = $_FILES['fotoprodak']['tmp_name'];
	$namafoto = $_FILES['fotoprodak']['name'];

	$namafoto =date('YmdHis').$namafoto;

	//upload
	move_uploaded_file($lokasifoto, 'foto_produk/'.$namafoto);

	$koneksi->query("INSERT INTO produk_foto (id_produk, nama_foto_produk) 
		VALUES ('$id_produk', '$namafoto')");

	echo "<script>alert('Foto produk berhasil disimpan'); </script>";
	echo "<script>location='index.php?page=detail_produk&id=$id_produk';</script>";

}
?>