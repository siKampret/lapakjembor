<?php  

$id_foto = $_GET['idfoto'];
$id_produk = $_GET['idproduk'];

// ambil dulu datanya
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto = '$id_foto' ");
$detailfoto = $ambilfoto->fetch_assoc();

$namafilefoto = $detailfoto['nama_foto_produk'];
// hapus foto dari folder
unlink("foto_produk/".$namafilefoto);

// menghapus data di mysql
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto = '$id_foto' ");

	echo "<script>alert('Foto produk terhapus'); </script>";
	echo "<script>location='index.php?page=detail_produk&id=$id_produk';</script>";


// echo "<pre>";
// print_r($detailfoto);
// echo "</pre>";
?>