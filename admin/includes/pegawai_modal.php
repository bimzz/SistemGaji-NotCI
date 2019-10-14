<!-- Add -->
<div class="modal fade" id="tambahbaru">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Tambah Karyawan</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="tambah_pegawai.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="nama" class="col-sm-3 control-label">Nama</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nama" name="nama" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="alamat" class="col-sm-3 control-label">Alamat</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="alamat" id="alamat"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="datepicker_add" class="col-sm-3 control-label">Tanggal Lahir</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="tanggal_lahir">
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="col-sm-3 control-label">Telepon</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="no_telp" name="no_telp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="kelamin" class="col-sm-3 control-label">Kelamin</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="kelamin" id="kelamin" required>
                        <option value="" selected>- Pilih -</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jabatan" class="col-sm-3 control-label">Jabatan</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="jabatan" id="jabatan" required>
                        <option value="" selected>- Pilih -</option>
                        <?php
                          $sql = "SELECT * FROM jabatan";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['deskripsi']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jadwal" class="col-sm-3 control-label">Jadwal</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="jadwal" name="jadwal" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM jadwal";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['masuk'].' - '.$srow['pulang']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" name="foto" id="foto"><b>Ukuran Max 2Mb</b>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="tambah"><i class="fa fa-save"></i> Simpan</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="id_pegawai"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="edit_pegawai.php">
            		<input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="edit_nama" class="col-sm-3 control-label">Nama</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_nama" name="nama">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_alamat" class="col-sm-3 control-label">Alamat</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="alamat" id="edit_alamat"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Tanggal Lahir</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="tanggal_lahir">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_no_telp" class="col-sm-3 control-label">Telepon</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_no_telp" name="no_telp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_kelamin" class="col-sm-3 control-label">Kelamin</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="kelamin" id="edit_kelamin">
                        <option selected id="kelamin_val"></option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_jabatan" class="col-sm-3 control-label">Jabatan</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="jabatan" id="edit_jabatan">
                        <option selected id="jabatan_val"></option>
                        <?php
                          $sql = "SELECT * FROM jabatan";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['deskripsi']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_jadwal" class="col-sm-3 control-label">Jadwal</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_jadwal" name="jadwal">
                        <option selected id="jadwal_val"></option>
                        <?php
                          $sql = "SELECT * FROM jadwal";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['masuk'].' - '.$srow['pulang']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Edit</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="id_pegawai"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="hapus_pegawai.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>HAPUS PEGAWAI</p>
	                	<h2 class="bold del_nama_pegawai"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="hapus"><i class="fa fa-trash"></i> Hapus</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_foto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_nama_pegawai"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="edit_foto_pegawai.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="foto" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" id="foto" name="foto" required><b>Ukuran Max 2Mb</b>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Edit</button>
              </form>
            </div>
        </div>
    </div>
</div>    