<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, pegawai.id as empid FROM pegawai LEFT JOIN jabatan ON jabatan.id=pegawai.id_jabatan LEFT JOIN jadwal ON jadwal.id=pegawai.id_jadwal WHERE pegawai.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>