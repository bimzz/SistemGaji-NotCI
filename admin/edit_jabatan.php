<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$rate = $_POST['rate'];

		$sql = "UPDATE jabatan SET deskripsi = '$title', gaji = '$rate' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Jabatan berhasil di edit';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Isi form terlebih dahulu';
	}

	header('location:jabatan.php');

?>