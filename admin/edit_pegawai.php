<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tanggal_lahir = $_POST['tanggal_lahir'];
		$no_telp = $_POST['no_telp'];
		$kelamin = $_POST['kelamin'];
		$jabatan = $_POST['jabatan'];
		$jadwal = $_POST['jadwal'];
		
		$sql = "UPDATE pegawai SET nama = '$nama', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', no_telp = '$no_telp', kelamin = '$kelamin', id_jabatan = '$jabatan', id_jadwal = '$jadwal' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data Pegawai Berhasil di update';
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