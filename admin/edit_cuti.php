<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$tanggal = $_POST['tanggal_cuti'];

		$sql = "UPDATE cuti SET tanggal_cuti = '$tanggal' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data Cuti berhasil di edit';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Edit';
	}

	header('location:cuti.php');

?>