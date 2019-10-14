<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$pegawai = $_POST['pegawai'];
		$jumlah = $_POST['jumlah'];
		
		$sql = "SELECT * FROM pegawai WHERE id_pegawai = '$pegawai'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Id Pegawai Tidak Ditemukan';
		}
		else{
			$row = $query->fetch_assoc();
			$id_pegawai = $row['id'];
			$sql = "INSERT INTO hutang (id_pegawai, tanggal_hutang, jumlah) VALUES ('$id_pegawai', NOW(), '$jumlah')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Data Hutang berhasil ditambahkan';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location: hutang.php');

?>