<?php 
	include 'koneksi.php';
	$id_buku	= $_GET['id_buku'];

	$query = mysqli_query($connect, "DELETE FROM buku WHERE id_buku='$id_buku'");

	if($query)
	{
		header("Location:admin.php");
	}
?>