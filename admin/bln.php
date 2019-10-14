<?php include 'includes/koneksi.php';?>
<form action="bln.php" method="get">
Bulan
<select name="bulan">
<?php
$bulan=array("Pilih","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$jlh_bln=count($bulan);
for($c=1; $c<$jlh_bln; $c+=1){
  echo"<option value= $c> $bulan[$c] </option>";
}
?>
</select>
Tahun
<select name="tahun">
<?php
$mulai= date('Y') - 50;
for($i = $mulai;$i<$mulai + 100;$i++){
    $sel = $i == date('Y') ? ' selected="selected"' : '';
    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
}
?>
</select>
<input type="submit">
<table id="example1" class="table table-bordered">
                <thead>
                  <th>Nama Pegawai</th>
                  <th>ID Pegawai</th>
                  <th>Gaji Bulanan</th>
                  <th>Jam Kerja</th>
                  <th>Pinjaman</th>
                  <th>Total Gaji</th>
                </thead>
                <tbody>
                	 <?php
                    if(isset($_GET['bulan'],$_GET['tahun'])){
                      $bulan = $_GET['bulan'];
                      $tahun = $_GET['tahun'];
                    }

                    $sql = "Select pegawai.nama,pegawai.id_pegawai,absen.tanggal,jabatan.gaji,hutang.jumlah,lembur.jam,lembur.rate from pegawai,jabatan,absen,hutang,lembur where pegawai.id=jabatan.id and pegawai.id=absen.id_pegawai and pegawai.id=hutang.id_pegawai and pegawai.id=lembur.id_pegawai and month(absen.tanggal)='$bulan' and year(absen.tanggal)='$tahun' group by id_pegawai";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $id_pegawai = $row['id_pegawai'];
                      $nama = $row['nama'];
                      $gajibln = $row['gaji'];
                      $jam_kerja = $row['jam_kerja'];
                      $pinjaman = $row['jumlah'];
                    

                      echo "
                        <tr>
                          <td>".$row['nama']."</td>
                          <td>".$row['id_pegawai']."</td>
                          <td>".number_format($gajibln, 2)."</td>
                          <td>".$row['jam_kerja']."</td>
                          <td>".$row['jumlah']."</td>
                          <td></td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>