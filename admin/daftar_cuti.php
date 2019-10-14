<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, cuti.id as attid FROM cuti LEFT JOIN pegawai ON pegawai.id=cuti.id_pegawai WHERE cuti.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>