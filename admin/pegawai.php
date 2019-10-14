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
        Daftar Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Pegawai</li>
        <li class="active">Daftar Pegawai</li>
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
                  <th>ID Pegawai</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Jadwal</th>
                  <th>Bergabung Sejak</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, pegawai.id AS empid FROM pegawai LEFT JOIN jabatan ON jabatan.id=pegawai.id_jabatan LEFT JOIN jadwal ON jadwal.id=pegawai.id_jadwal";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['id_pegawai']; ?></td>
                          <td><img src="<?php echo (!empty($row['foto']))? '../images/'.$row['foto']:'../images/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_foto" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['empid']; ?>"><span class="fa fa-edit"></span></a></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $row['deskripsi']; ?></td>
                          <td><?php echo date('h:i A', strtotime($row['masuk'])).' - '.date('h:i A', strtotime($row['pulang'])); ?></td>
                          <td><?php echo date('M d, Y', strtotime($row['tanggal_bergabung'])) ?></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm hapus btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i> Hapus</button>
                          </td>
                        </tr>
                      <?php
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
  <?php include 'includes/pegawai_modal.php'; ?>
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

  $('.foto').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'daftar_pegawai.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.id_pegawai').html(response.id_pegawai);
      $('.del_nama_pegawai').html(response.nama);
      $('#nama_pegawai').html(response.nama);
      $('#edit_nama').val(response.nama);
      $('#edit_alamat').val(response.alamat);
      $('#datepicker_edit').val(response.tanggal_lahir);
      $('#edit_no_telp').val(response.no_telp);
      $('#kelamin_val').val(response.kelamin).html(response.kelamin);
      $('#jabatan_val').val(response.id_jabatan).html(response.deskripsi);
      $('#jadwal_val').val(response.id_jadwal).html(response.masuk+' - '+response.pulang);
    }
  });
}
</script>
</body>
</html>