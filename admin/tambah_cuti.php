<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$pegawai = $_POST['pegawai'];
		$tanggal_cuti = $_POST['tanggal_cuti'];

		$sql = "SELECT * FROM pegawai WHERE id_pegawai = '$pegawai'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Karyawan tidak ditemukan';
		}
		else{
			$row = $query->fetch_assoc();
			$emp = $row['id'];

			$sql = "SELECT * FROM cuti WHERE id_pegawai = '$emp' AND tanggal_cuti = '$tanggal_cuti'";
			$query = $conn->query($sql);

			if($query->num_rows > 0){
				$_SESSION['error'] = 'Karyawan tersebut sudah cuti pada hari ini';
			}
			else{
				//
				$sql = "INSERT INTO absen (id_pegawai, tanggal, masuk, pulang, status, jam_kerja) VALUES ('$emp', '$tanggal_cuti',
				'00:00:00','00:00:00','0','0'); INSERT INTO cuti (id_pegawai, tanggal_cuti) VALUES ('$emp', '$tanggal_cuti');";
				if($conn->multi_query($sql)){
					$_SESSION['success'] = 'Cuti berhasil di input';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
		}
	}
	else{
		$_SESSION['error'] = 'Isi Form terlebih dahulu';
	}
	
	header('location: cuti.php');

?>