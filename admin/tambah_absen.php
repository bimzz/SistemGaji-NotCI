<?php
	include 'includes/session.php';

	if(isset($_POST['tambah'])){
		$pegawai = $_POST['pegawai'];
		$tanggal = $_POST['tanggal'];
		$masuk = $_POST['masuk'];
		$masuk = date('H:i:s', strtotime($masuk));
		$pulang = $_POST['pulang'];
		$pulang = date('H:i:s', strtotime($pulang));

		$sql = "SELECT * FROM pegawai WHERE id_pegawai = '$pegawai'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Karyawan tidak ditemukan';
		}
		else{
			$row = $query->fetch_assoc();
			$emp = $row['id'];

			$sql = "SELECT * FROM absen WHERE id_pegawai = '$emp' AND tanggal = '$tanggal'";
			$query = $conn->query($sql);

			if($query->num_rows > 0){
				$_SESSION['error'] = 'Karyawan tersebut sudah absen hari ini';
			}
			else{
				//updates
				$jadwal = $row['id_jadwal'];
				$sql = "SELECT * FROM jadwal WHERE id = '$jadwal'";
				$squery = $conn->query($sql);
				$scherow = $squery->fetch_assoc();
				$logstatus = ($masuk > $scherow['masuk']) ? 0 : 1;
				//
				$sql = "INSERT INTO absen (id_pegawai, tanggal, masuk, pulang, status) VALUES ('$emp', '$tanggal', '$masuk', '$pulang', '$logstatus')";
				if($conn->query($sql)){
					$_SESSION['success'] = 'Absen berhasil di input';
					$id = $conn->insert_id;

					$sql = "SELECT * FROM pegawai LEFT JOIN jadwal ON jadwal.id=pegawai.id_jadwal WHERE pegawai.id = '$emp'";
					$query = $conn->query($sql);
					$srow = $query->fetch_assoc();

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

					$sql = "UPDATE absen SET jam_kerja = '$int' WHERE id = '$id'";
					$conn->query($sql);

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
	
	header('location: absen.php');

?>