<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">LAPORAN</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        <li class="header">MANAJEMEN</li>
        
        <li><a href="absen.php"><i class="fa fa-calendar"></i> <span>Absen</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Pegawai</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pegawai.php"><i class="fa fa-circle-o"></i> Daftar Pegawai</a></li>
            <li><a href="lembur.php"><i class="fa fa-circle-o"></i> Lembur</a></li>
            <li><a href="hutang.php"><i class="fa fa-circle-o"></i> Hutang</a></li>
            <li><a href="jadwal.php"><i class="fa fa-circle-o"></i> Jadwal</a></li>
          </ul>
        </li>
        <li><a href="cuti.php"><i class="fa fa-file-text"></i> Cuti</a></li>
        <li><a href="jabatan.php"><i class="fa fa-suitcase"></i> Jabatan</a></li>
        <li class="header">PRINTABLES</li>
        <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payroll</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>