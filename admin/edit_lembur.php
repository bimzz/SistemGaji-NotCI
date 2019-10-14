<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$tanggal = $_POST['tanggal'];
		$jam = $_POST['jam'];
		$rate = $_POST['rate'];

		$sql = "UPDATE lembur SET jam = '$jam', rate = '$rate', tanggal_lembur = '$tanggal' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data Lembur berhasil di edit';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Edit';
	}

	header('location:lembur.php');

?>