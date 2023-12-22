<?php 
	include 'koneksi.php';
	$id_penerbit	= $_GET['id_penerbit'];

	$query = mysqli_query($connect, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");

	if($query)
	{
		header("Location:admin.php");
	}
?>