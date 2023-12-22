<?php
	include 'koneksi.php';

    $id_penerbit    = $_POST['id_penerbit'];
    $nama_penerbit    = $_POST['nama_penerbit']; 
	$alamat			= $_POST['alamat'];
	$kota			= $_POST['kota'];
    $telepon        = $_POST['telepon'];

    mysqli_query($connect, "INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `kota`, `telepon`) VALUES ('$id_penerbit', '$nama_penerbit', '$alamat', '$kota', '$telepon')");
    header("location:admin.php");
		
?>