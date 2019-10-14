<!-- Add -->
<div class="modal fade" id="tambahbaru">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Tambah Daftar Hutang Pegawai</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="tambah_hutang.php">
          		  <div class="form-group">
                  	<label for="pegawai" class="col-sm-3 control-label">Id Pegawai</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="pegawai" name="pegawai" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="jumlah" name="jumlah" required>
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
            	<h4 class="modal-title"><b><span class="date"></span> - <span class="nama_pegawai"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="edit_hutang.php">
            		<input type="hidden" class="caid" name="id">
                <div class="form-group">
                    <label for="edit_jumlah" class="col-sm-3 control-label">Jumlah</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_jumlah" name="jumlah" required>
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
            	<h4 class="modal-title"><b><span class="tanggal"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="hapus_hutang.php">
            		<input type="hidden" class="caid" name="id">
            		<div class="text-center">
	                	<p>HAPUS DATA HUTANG</p>
	                	<h2 class="nama_pegawai bold"></h2>
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