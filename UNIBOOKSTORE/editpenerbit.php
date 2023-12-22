<?php
	include 'koneksi.php';
    
	$id_penerbit    = $_GET['id_penerbit'];
    $nama_penerbit  = $_POST['nama_penerbit']; 
	$alamat			= $_POST['alamat'];
	$kota			= $_POST['kota'];
    $telepon        = $_POST['telepon'];

	$sql	= "UPDATE penerbit SET nama_penerbit = '$nama_penerbit', alamat = '$alamat', kota = '$kota', telepon = '$telepon' WHERE id_penerbit = '$id_penerbit';";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:admin.php");
	}
?>