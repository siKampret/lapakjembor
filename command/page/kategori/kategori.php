<h3>Data Kategori</h3>
<hr>

<?php
$semuadata = array();  
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc())
{
	$semuadata[] = $tiap;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php foreach ($semuadata as $key => $value): ?> 
		
		
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $value['nama_kategori']; ?></td>
			<td>
				<a href="" class="btn btn-warning btn-sm">Rubah</a>
				<a href="" class="btn btn-danger btn-sm">Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php endforeach ?>
	</tbody>
</table>

<a href="index.php?page=tambah_kategori" class="btn btn-default">Tambah Kategori</a>