<?php
	session_start();
	include 'includes/koneksi.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM admin WHERE username = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Username tidak ditemukan';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Password salah';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input username dan password terlebih dahulu';
	}

	header('location: index.php');

?>