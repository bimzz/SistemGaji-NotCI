<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$tanggal = $_POST['edit_tanggal'];
		$masuk = $_POST['edit_masuk'];
		$masuk = date('H:i:s', strtotime($masuk));
		$pulang = $_POST['edit_pulang'];
		$pulang = date('H:i:s', strtotime($pulang));

		$sql = "UPDATE absen SET tanggal = '$tanggal', masuk = '$masuk', pulang = '$pulang' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Absen berhasil di edit';

			$sql = "SELECT * FROM absen WHERE id = '$id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			$emp = $row['id_pegawai'];

			$sql = "SELECT * FROM pegawai LEFT JOIN jadwal ON jadwal.id=pegawai.id_jadwal WHERE pegawai.id = '$emp'";
			$query = $conn->query($sql);
			$srow = $query->fetch_assoc();

			//updates
			$logstatus = ($masuk > $srow['masuk']) ? 0 : 1;
			//

			if($srow['masuk'] > $masuk){
				$masuk = $srow['masuk'];
			}

			if($srow['pulang'] < $pulang){
				$pulang = $srow['pulang'];
			}

			$masuk = new DateTime($masuk);
			$pulang = new DateTime($pulang);
			$interval = $masuk->diff($pulang);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}

			$sql = "UPDATE absen SET jam_kerja = '$int', status = '$logstatus' WHERE id = '$id'";
			$conn->query($sql);
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Isi form terlebih dahulu';
	}

	header('location:absen.php');

?>