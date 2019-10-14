<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tanggal_lahir = $_POST['tanggal_lahir'];
		$no_telp = $_POST['no_telp'];
		$kelamin = $_POST['kelamin'];
		$jabatan = $_POST['jabatan'];
		$jadwal = $_POST['jadwal'];
		$filename = $_FILES['foto']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$id_pegawai = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO pegawai (id_pegawai, nama, alamat, tanggal_lahir, no_telp, kelamin, id_jabatan, id_jadwal, foto, tanggal_bergabung) VALUES ('$id_pegawai', '$nama', '$alamat', '$tanggal_lahir', '$no_telp', '$kelamin', '$jabatan', '$jadwal', '$filename', NOW())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Data Karyawan berhasil ditambahkan';
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