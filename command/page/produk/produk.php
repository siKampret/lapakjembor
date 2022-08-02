<h2>Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_kategori']; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>Rp. <?php echo $pecah['harga_produk']; ?></td>
			<td><?php echo $pecah['berat']; ?></td>
			<td><img src="foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>
			<td>
				<a href="index.php?page=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i>Rubah</a>
				<a href="index.php?page=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
				<a href="index.php?page=detail_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-info"><i class="glyphicon glyphicon-eye"></i>Detail</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
<a href="index.php?page=tambahproduk" class="btn btn-primary">Tambah Produk</a>