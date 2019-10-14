<?php
	include 'includes/session.php';

	if(isset($_POST['hapus'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM jabatan WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Jabatan berhasil di hapus';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location: jabatan.php');
	
?>