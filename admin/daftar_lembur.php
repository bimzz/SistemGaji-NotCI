<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, lembur.id AS otid FROM lembur LEFT JOIN pegawai on pegawai.id=lembur.id_pegawai WHERE lembur.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>