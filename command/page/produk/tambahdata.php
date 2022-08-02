<?php  
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}

echo "<pre>";
print_r($datakategori);
echo "</pre>";
?>
<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>

			<option value="<?php echo $value['id_kategori']; ?>"><?php echo $value['nama_kategori']; ?></option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama_produk" class="form-control">
	</div>
	<div class="form-group">
		<label>Harga Produk</label>
		<input type="number" name="harga_produk" class="form-control">
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" name="berat" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi_produk" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Stok Produk</label>
		<input type="number" name="stok_produk" class="form-control">
	</div>
	<div class="form-group">
		<label>Foto Produk</label>
		<div class="letak-input" style="margin-bottom: 10px">
			<input type="file" name="foto_produk[]" class="form-control">
		</div>
			<span class="btn btn-primary btn-tambah">
				<i class="fa fa-plus"></i>
		</span>
	</div>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>

<?php
	if (isset($_POST['simpan']))
	{

		$namanamafoto = $_FILES['foto_produk']['name'];
		$lokasilokasifoto = $_FILES['foto_produk']['tmp_name'];
		move_uploaded_file($lokasilokasifoto[0], "foto_produk/". $namanamafoto[0]);
		$koneksi -> query("INSERT INTO produk (nama_produk,harga_produk,berat,foto_produk,deskripsi_produk,stok_produk,id_kategori) 
			VALUES ('$_POST[nama_produk]','$_POST[harga_produk]','$_POST[berat]','$namanamafoto[0]','$_POST[deskripsi_produk]','$_POST[stok_produk]',$_POST[id_kategori])");

		// mendapatkan id_produk barusan
		$id_produk_barusan = $koneksi->insert_id;

		foreach ($namanamafoto as $key => $tiap_nama) 
		{
			$tiap_lokasi = $lokasilokasifoto[$key];

			move_uploaded_file($tiap_lokasi, "foto_produk/".$tiap_nama);

			//simpan ke mysql (tapi kita perlu tau id produknya berapa)
			$koneksi->query("INSERT INTO produk_foto (id_produk, nama_foto_produk) 
				VALUES ('$id_produk_barusan', '$tiap_nama')");
		}

		echo '<div class="alert alert-info">Data Tersimpan</div>'; 
		echo '<meta http-equiv="refresh" content="1;url=index.php?page=produk">';

		echo "<pre>";
		print_r($_FILES["foto_produk"]);
		echo "</pre>";
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-tambah").on("click",function(){
			$(".letak-input").append("<input type='file' name='foto_produk[]' class='form-control'>");
		})
	})
</script>