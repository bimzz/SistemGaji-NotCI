<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$empid = $_POST['id'];
		$filename = $_FILES['foto']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE pegawai SET foto = '$filename' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Foto Pegawai berhasil diupdate';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location: pegawai.php');
?>