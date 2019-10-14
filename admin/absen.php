<?php include 'includes/session.php'; ?>
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
        Absensi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Absensi</li>
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
              <a href="#tambahbaru" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Tanggal</th>
                  <th>Id Pegawai</th>
                  <th>Nama</th>
                  <th>Masuk</th>
                  <th>Pulang</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, pegawai.id_pegawai AS empid, absen.id AS attid FROM absen LEFT JOIN pegawai ON pegawai.id=absen.id_pegawai ORDER BY absen.tanggal DESC, absen.masuk DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $status = ($row['status'])?'<span class="label label-warning pull-right">tepat waktu</span>':'<span class="label label-danger pull-right">terlambat</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['tanggal']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['nama']."</td>
                          <td>".date('h:i A', strtotime($row['masuk'])).$status."</td>
                          <td>".date('h:i A', strtotime($row['pulang']))."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat hapus' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Hapus</button>
                          </td>
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
  <?php include 'includes/absen_modal.php'; ?>
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

  $('.hapus').click(function(e){
    e.preventDefault();
    $('#hapus').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'daftar_absen.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.tanggal);
      $('#tanggal_absen').html(response.tanggal);
      $('#edit_masuk').val(response.masuk);
      $('#edit_pulang').val(response.pulang);
      $('#attid').val(response.attid);
      $('#nama_pegawai').html(response.nama);
      $('#del_attid').val(response.attid);
      $('#del_nama_pegawai').html(response.nama);
    }
  });
}
</script>
</body>
</html>
