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
        Hutang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Pegawai</li>
        <li class="active">Hutang</li>
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
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, hutang.id AS caid, pegawai.id_pegawai AS empid FROM hutang LEFT JOIN pegawai ON pegawai.id=hutang.id_pegawai ORDER BY tanggal_hutang DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                       echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['tanggal_hutang']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['nama']."</td>
                          <td>Rp " .number_format($row['jumlah'], 2,',','.')."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['caid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm hapus btn-flat' data-id='".$row['caid']."'><i class='fa fa-trash'></i> Hapus</button>
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
  <?php include 'includes/hutang_modal.php'; ?>
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
    url: 'daftar_hutang.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.tanggal').html(response.tanggal_hutang);
      $('.nama_pegawai').html(response.nama);
      $('.caid').val(response.caid);
      $('#edit_jumlah').val(response.jumlah);
    }
  });
}
</script>
</body>
</html>