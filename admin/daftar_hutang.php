<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, hutang.id AS caid FROM hutang LEFT JOIN pegawai on pegawai.id=hutang.id_pegawai WHERE hutang.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>