<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$jumlah = $_POST['jumlah'];
		
		$sql = "UPDATE hutang SET jumlah = '$jumlah' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data Hutang berhasil diedit';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location:hutang.php');

?>