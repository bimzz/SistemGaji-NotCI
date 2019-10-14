<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$masuk = $_POST['masuk'];
		$masuk = date('H:i:s', strtotime($masuk));
		$pulang = $_POST['pulang'];
		$pulang = date('H:i:s', strtotime($pulang));

		$sql = "INSERT INTO jadwal (masuk, pulang) VALUES ('$masuk', '$pulang')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Daftar Jadwal berhasil ditambahkan';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location: jadwal.php');

?>