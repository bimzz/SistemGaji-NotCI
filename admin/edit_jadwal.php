<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$masuk = $_POST['masuk'];
		$masuk = date('H:i:s', strtotime($masuk));
		$pulang = $_POST['pulang'];
		$pulang = date('H:i:s', strtotime($pulang));

		$sql = "UPDATE jadwal SET masuk = '$masuk', pulang = '$pulang' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Daftar Jadwal berhasil di edit';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location:jadwal.php');

?>