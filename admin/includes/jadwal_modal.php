<!-- Add -->
<div class="modal fade" id="tambahbaru">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Tambah Daftar Jadwal</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="tambah_jadwal.php">
          		  <div class="form-group">
                  	<label for="masuk" class="col-sm-3 control-label">Jam Masuk</label>

                  	<div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                    	 <input type="text" class="form-control timepicker" id="masuk" name="masuk" required>
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="pulang" class="col-sm-3 control-label">Jam Pulang</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="pulang" name="pulang" required>
                      </div>
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
            	<h4 class="modal-title"><b>Edit Jadwal</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="edit_jadwal.php">
            		<input type="hidden" id="timeid" name="id">
                <div class="form-group">
                    <label for="edit_masuk" class="col-sm-3 control-label">Jam Masuk</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_masuk" name="masuk">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_pulang" class="col-sm-3 control-label">Jam Pulang</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_pulang" name="pulang">
                      </div>
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
            	<h4 class="modal-title"><b>Menghapus...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="hapus_jadwal.php">
            		<input type="hidden" id="del_timeid" name="id">
            		<div class="text-center">
	                	<p>HAPUS DAFTAR JADWAL</p>
	                	<h2 id="del_jadwal" class="bold"></h2>
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


     