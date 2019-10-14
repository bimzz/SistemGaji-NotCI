<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$pegawai = $_POST['pegawai'];
		$tanggal = $_POST['tanggal'];
		$jam = $_POST['jam'];
		$rate = $_POST['rate'];
		$sql = "SELECT * FROM pegawai WHERE id_pegawai = '$pegawai'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Pegawai tidak ditemukan';
		}
		else{
			$row = $query->fetch_assoc();
			$id_pegawai = $row['id'];
			$sql = "INSERT INTO lembur (id_pegawai, tanggal_lembur, jam, rate) VALUES ('$id_pegawai', '$tanggal', '$jam', '$rate')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Data Lembur berhasil ditambahkan';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Error';
	}

	header('location: lembur.php');

?>