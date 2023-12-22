<?php
	include 'koneksi.php';

    $id_buku    = $_POST['id_buku'];
    $kategori    = $_POST['kategori']; 
    $nama_buku    = $_POST['nama_buku']; 
	$harga			= $_POST['harga'];
	$stok			= $_POST['stok'];
    $penerbit        = $_POST['penerbit'];
    $pengarang        = $_POST['pengarang'];

    mysqli_query($connect, "INSERT INTO `buku` (`id_buku`, `kategori`, `nama_buku`, `harga`, `stok`, `penerbit`,`pengarang`) VALUES ('$id_buku', '$kategori', '$nama_buku', '$harga', '$stok', '$penerbit','$pengarang')");
    header("location:admin.php");
		
?>