<?php
	if(isset($_POST['pegawai'])){
		$output = array('error'=>false);

		include 'koneksi.php';
		include 'timezone.php';

		$pegawai = $_POST['pegawai'];
		$status = $_POST['status'];

		$sql = "SELECT * FROM pegawai WHERE id_pegawai = '$pegawai'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];

			$date_now = date('Y-m-d');

			if($status == 'masuk'){
				$sql = "SELECT * FROM absen WHERE id_pegawai = '$id' AND tanggal = '$date_now' AND masuk IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'Anda Telah Absen Masuk Hari Ini';
				}
				else{
					//updates
					$sched = $row['id_jadwal'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM jadwal WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['masuk']) ? 0 : 1;
					//
					$sql = "INSERT INTO absen (id_pegawai, tanggal, masuk, status) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($conn->query($sql)){
						$output['message'] = 'Berhasil Absen: '.$row['nama'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, absen.id AS uid FROM absen LEFT JOIN pegawai ON pegawai.id=absen.id_pegawai WHERE absen.id_pegawai = '$id' AND tanggal = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'Timeout';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['pulang'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'Anda Telah Absen Pulang';
					}
					else{
						
						$sql = "UPDATE absen SET pulang = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Berhasil Absen: '.$row['nama'];

							$sql = "SELECT * FROM absen WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['masuk'];
							$time_out = $urow['pulang'];

							$sql = "SELECT * FROM pegawai LEFT JOIN jadwal ON jadwal.id=pegawai.id_jadwal WHERE pegawai.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['masuk'] > $urow['masuk']){
								$time_in = $srow['masuk'];
							}

							if($srow['pulang'] < $urow['pulang']){
								$time_out = $srow['pulang'];
							}

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE absen SET jam_kerja = '$int' WHERE id = '".$row['uid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Id Pegawai tidak ditemukan';
		}
		
	}
	
	echo json_encode($output);

?>