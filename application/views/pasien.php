
<div class="inner">
<div class="row">
<div class="col-lg-12">
        <br />
		<div class = "col-md-2 col-xs-12">
			<div class = "form-group">
				<a href="#" class="btn btn-primary btn-block" id="psn_tambah"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Tambah Data</a>
			</div>
		</div>
		<div class = "col-md-2 col-xs-12">
			<div class = "form-group">
				<a href="" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i> &nbsp;&nbsp;&nbsp; Refresh</a>
			</div>
		</div>
        <br />
        <br />
</div>
</div>
<div class="row" id="isidata">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Data Kriteria Pasien
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-pasien" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Foto</th>
								<th>Nama</th>
								<th>Telp</th>
								<th>TTL</th>
								<th>JK</th>
								<th>No Kitas</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="3" align="center">Tidak ada data</td>
							</tr>
						</tbody>
					</table>			
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	
<!-- Bootstrap modal -->
	<div class="modal fade" id="modal_pasien" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form Pasien</h3>
				</div>
				<form role="form  col-lg-6" name="Pasien" id="frm_pasien">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="psn_id" name="psn_id" value="">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Gelar</label>
								<select class="form-control" name="psn_gelar" id="psn_gelar">
							<?php foreach($gelar as $item) { ?>
									<option value="<?=$item;?>"><?=$item;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="psn_nama" id="psn_nama" placeholder="Nama" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" class="form-control" name="psn_tempat_lahir" id="psn_tempat_lahir" placeholder="Tempat Lahir" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="text" class="form-control tgl" name="psn_tgl_lahir" id="psn_tgl_lahir" placeholder="Tanggal Lahir" value="<?=date("d/m/Y", strtotime("2003-01-01"));?>"0>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select class="form-control" name="psn_jk" id="psn_jk">
							<?php foreach($jk as $item) { ?>
									<option value="<?=$item;?>"><?=$item;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis Kartu Identitas</label>
								<select class="form-control" name="psn_jkitas" id="psn_jkitas">
							<?php foreach($jkitas as $item) { ?>
									<option value="<?=$item;?>"><?=$item;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>No Kitas</label>
								<input type="text" class="form-control" name="psn_nokitas" id="psn_nokitas" placeholder="No Kitas" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Telp</label>
								<input type="text" class="form-control" name="psn_telp" id="psn_telp" placeholder="Telp" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" name="psn_alamat" id="psn_alamat" placeholder="Alamat" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" class="form-control" name="psn_foto" id="psn_foto">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="psn_simpan" class="btn btn-primary">Simpan</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
	
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url("assets/"); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/buttons.flash.min.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/jszip.min.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/pdfmake.min.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/vfs_fonts.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
	<script src="<?= base_url("assets/"); ?>assets/plugins/datatables/buttons.print.min.js"></script>
	<!-- daterangepicker -->
    <script src="<?= base_url("assets/"); ?>assets/plugins/daterangepicker/moment.js"></script>
    <script src="<?= base_url("assets/"); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    
	<!-- Custom Java Script -->
	<script src="<?= base_url("assets/"); ?>assets/js/pasien.js"></script>