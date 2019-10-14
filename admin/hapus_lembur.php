<?php
	include 'includes/session.php';

	if(isset($_POST['hapus'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM lembur WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Daftar lembur berhasil dihapus';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location: lembur.php');
	
?>