
<div class="inner">
<div class="row">
<div class="col-lg-12">
        <br />
		<div class = "col-md-2 col-xs-12">
			<div class = "form-group">
				<a href="#" class="btn btn-primary btn-block" id="pdk_tambah"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Tambah Data</a>
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
				Data Kriteria PolyDokter
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabel-polydokter" width="100%" style="font-size:120%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Dokter</th>
								<th>Poly</th>
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
	<div class="modal fade" id="modal_polydokter" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Form PolyDokter</h3>
				</div>
				<form role="form  col-lg-6" name="PolyDokter" id="frm_polydokter">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="pdk_id" name="pdk_id" value="">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Dokter</label>
								<select class="form-control" name="pdk_dok_id" id="pdk_dok_id">
							<?php foreach($dokter as $item) { ?>
									<option value="<?=$item->dok_id;?>"><?=$item->dok_nama;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Poly</label>
								<select class="form-control" name="pdk_ply_id" id="pdk_ply_id">
							<?php foreach($poly as $item) { ?>
									<option value="<?=$item->ply_id;?>"><?=$item->ply_nama;?></option>
							<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="pdk_simpan" class="btn btn-primary">Simpan</a>
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
	<script src="<?= base_url("assets/"); ?>assets/js/polydokter.js"></script>