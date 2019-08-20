
<div class="inner">
<div class="row">
<div class="col-lg-12">
        <br />
		<div class = "col-md-2 col-xs-12">
			<div class = "form-group">
				<a href="#" class="btn btn-primary btn-block" id="dok_tambah"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Tambah Data</a>
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
				Data Kriteria Dokter
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-dokter" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Foto</th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Telp</th>
								<th>TTL</th>
								<th>JK</th>
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
	<div class="modal fade" id="modal_dokter" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form Dokter</h3>
				</div>
				<form role="form  col-lg-6" name="Dokter" id="frm_dokter">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="dok_id" name="dok_id" value="">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis</label>
								<select class="form-control" name="dok_jenis" id="dok_jenis">
							<?php foreach($jenis as $item) { ?>
									<option value="<?=$item;?>"><?=$item;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="dok_nama" id="dok_nama" placeholder="Nama" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" class="form-control" name="dok_tempat_lahir" id="dok_tempat_lahir" placeholder="Tempat Lahir" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="text" class="form-control tgl" name="dok_tgl_lahir" id="dok_tgl_lahir" placeholder="Tanggal Lahir" value="<?=date("d/m/Y", strtotime("2003-01-01"));?>"0>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select class="form-control" name="dok_jk" id="dok_jk">
							<?php foreach($jk as $item) { ?>
									<option value="<?=$item;?>"><?=$item;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>NIP</label>
								<input type="text" class="form-control" name="dok_nip" id="dok_nip" placeholder="NIP" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Telp</label>
								<input type="text" class="form-control" name="dok_telp" id="dok_telp" placeholder="Telp" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" name="dok_alamat" id="dok_alamat" placeholder="Alamat" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" class="form-control" name="dok_foto" id="dok_foto">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="dok_simpan" class="btn btn-primary">Simpan</a>
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
	<script src="<?= base_url("assets/"); ?>assets/js/dokter.js"></script>