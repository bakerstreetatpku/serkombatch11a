
<div class="inner">
<div class="row">
<div class="col-lg-12">
        <br />
		<div class = "col-md-2 col-xs-12">
			<div class = "form-group">
				<a href="#" class="btn btn-primary btn-block" id="sdk_tambah"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Tambah Data</a>
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
				Data Kriteria SpesialisDokter
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-spesialisdokter" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Dokter</th>
								<th>Spesialis</th>
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
	<div class="modal fade" id="modal_spesialisdokter" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form SpesialisDokter</h3>
				</div>
				<form role="form  col-lg-6" name="SpesialisDokter" id="frm_spesialisdokter">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="sdk_id" name="sdk_id" value="">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Dokter</label>
								<select class="form-control" name="sdk_dok_id" id="sdk_dok_id">
							<?php foreach($dokter as $item) { ?>
									<option value="<?=$item->dok_id;?>"><?=$item->dok_nama;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Spesialis</label>
								<select class="form-control" name="sdk_sps_id" id="sdk_sps_id">
							<?php foreach($spesialis as $item) { ?>
									<option value="<?=$item->sps_id;?>"><?=$item->sps_nama;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="sdk_simpan" class="btn btn-primary">Simpan</a>
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
	<script src="<?= base_url("assets/"); ?>assets/js/spesialisdokter.js"></script>