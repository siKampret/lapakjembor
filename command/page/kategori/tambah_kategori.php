<h2>Tambah Kategori</h2>

<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" name="nama_kategori" class="form-control">
	</div>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>

<?php
	if (isset($_POST['simpan'])) 
	{
	  	$koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$_POST[nama_kategori]')");

	  	echo "<script>alert('Tambah kategori berhasil');</script>";
	  	echo "<script>location='index.php?page=kategori'</script>";
	}  
?>