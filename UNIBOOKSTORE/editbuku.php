<?php
	include 'koneksi.php';
    
	$id_buku    = $_GET['id_buku'];
    $kategori    = $_POST['kategori']; 
    $nama_buku    = $_POST['nama_buku']; 
	$harga			= $_POST['harga'];
	$stok			= $_POST['stok'];
    $penerbit        = $_POST['penerbit'];
	$pengarang       = $_POST['pengarang'];

	$sql	= "UPDATE buku SET kategori = '$kategori', nama_buku = '$nama_buku', harga = '$harga', stok = '$stok', penerbit = '$penerbit', pengarang = '$pengarang' WHERE id_buku = '$id_buku';";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:admin.php");
	}
?>