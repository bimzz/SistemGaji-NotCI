<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Nama Pegawai</th>
                  <th>ID Pegawai</th>
                  <th>Jam Kerja</th>
                  <th>Lembur</th>
                  <th>Hutang</th>
                  <th>Total Gaji</th>
                </thead>
                <tbody>
                  <?php

                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    $sql = "SELECT *, SUM(jam_kerja) AS total_jam_kerja, COUNT(jam_kerja) AS hari_kerja, absen.id_pegawai AS empid FROM absen LEFT JOIN pegawai ON pegawai.id=absen.id_pegawai LEFT JOIN jabatan ON jabatan.id=pegawai.id_jabatan WHERE tanggal BETWEEN '$from' AND '$to' GROUP BY absen.id_pegawai";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $casql = "SELECT *, SUM(jumlah) AS jumlah_hutang FROM hutang WHERE id_pegawai='$empid' AND tanggal_hutang BETWEEN '$from' AND '$to'";
                      
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $hutang = $carow['jumlah_hutang'];

                      $hutangsql = "SELECT *, SUM(jam) AS jam_lembur FROM lembur WHERE id_pegawai='$empid' AND tanggal_lembur BETWEEN '$from' AND '$to'";

                      $hutangquery = $conn->query($hutangsql);
                      $hutangrow = $hutangquery->fetch_assoc();
                      $jam_lembur = $hutangrow['jam_lembur'];
                      $rate = $hutangrow['rate'];

                      $lembur = $jam_lembur * $rate;
                      $gajiperjam = $row['gaji'] / 173;
                      $hari_kerja = $row['hari_kerja'];
                      $gajikotor = $hari_kerja * $row['total_jam_kerja'] * $gajiperjam;
                      $total = $gajikotor - $hutang;

                      echo "
                        <tr>
                          <td>".$row['nama']."</td>
                          <td>".$row['id_pegawai']."</td>
                          <td>".$row['total_jam_kerja']."</td>
                          <td>Rp ".number_format($lembur, 2,',','.')."</td>
                          <td>Rp ".number_format($hutang, 2,',','.')."</td>
                          <td>Rp ".number_format($total, 2,',','.')."</td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'payroll.php?range='+range;
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payslip_generate.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'position_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#posid').val(response.id);
      $('#edit_title').val(response.description);
      $('#edit_rate').val(response.rate);
      $('#del_posid').val(response.id);
      $('#del_position').html(response.description);
    }
  });
}


</script>
</body>
</html>
