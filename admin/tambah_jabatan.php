<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$title = $_POST['title'];
		$rate = $_POST['rate'];

		$sql = "INSERT INTO jabatan (deskripsi, gaji) VALUES ('$title', '$rate')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Jabatan Berhasil Ditambahkan';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Isi Form terlebih dahulu';
	}

	header('location: jabatan.php');

?>