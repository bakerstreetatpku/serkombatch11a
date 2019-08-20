var save_method; //for save method string
var table;

table = $('#tabel-pasien').DataTable({ 
	"destroy": true,
	dom: 'Bfrtip',
	lengthMenu: [
		[ 10, 25, 50, -1 ],
		[ '10 rows', '25 rows', '50 rows', 'Show all' ]
	],
	buttons: [
		'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
	],
	// "oLanguage": {
		// "sProcessing": '<center><img src="<?= base_url("assets/");?>assets/img/fb.gif" style="width:2%;"> Loading Data</center>',
	// },
	"responsive": true,
	"sort":false,
	"processing": true, //Feature control the processing indicator.
	"serverSide": true, //Feature control DataTables' server-side processing mode.
	"order": [], //Initial no order.
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": "ajax_list_pasien/",
		"type": "POST"
	},
	//Set column definition initialisation properties.
	"columnDefs": [
	{ 
		"targets": [ -1 ], //last column
		"orderable": false, //set not orderable
	},
	],
	"initComplete": function(settings, json) {
		$("#process").html("<i class='glyphicon glyphicon-search'></i> Process")
		$(".btn").attr("disabled", false);
		$("#isidata").fadeIn();
	}
});

$("#psn_tambah").click(function(){
	$("#psn_id").val(0);
	$('#modal_pasien').modal({
		show: true,
		keyboard: false,
		backdrop: 'static'
	});
});

$("#psn_nokitas").change(function(){
	var isi = $(this).val();
	if (isi == "Prodi")
	{
		$("#inputProdi").show();
		$("#inputFakultas").hide();
	}
	else
	{
		$("#inputProdi").hide();
		$("#inputFakultas").show();
	}
		// alert(isi);
});

$("#frm_pasien").submit(function(e){
	// var dataString = $("#frm_pasien").serialize();
	e.preventDefault();
	$("#psn_simpan").html("Menyimpan...");
	$(".btn").attr("disabled", true);
	$.ajax({
       type: "POST",
		url: "simpan",  
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function(d) 
        {
			var res = JSON.parse(d);
			var msg = "";
			// alert(d+ " - " + res.status);
			if (res.status == 1)
			{
				msg = res.desc;
			}
			else
			{
				msg = res.desc + "["+res.err+"]";
			}
			$("#modal_pasien").modal("hide");
			$("#pesan_info_ok").html(msg);
			$("#psn_simpan").html("Simpan");
			$(".btn").attr("disabled", false);
			$('#info_ok').modal({
				show: true,
				keyboard: false,
				backdrop: 'static'
			});
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	
});

$("#ok_info_ok").click(function(){
	document.location.href="";
});

function hapus_pasien(id, foto)
{
	// alert(id);
	$("#idSts").val(id);
	$("#hapusfoto").val(foto);
	$("#jdlKonfirm").html("Konfirmasi hapus data");
	$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
	$("#frmKonfirm").modal({
		show: true,
		keyboard: false,
		backdrop: 'static'
	});
}

function ubah_pasien(id)
{
	$.ajax({
		type	: "POST",
		url		: "cari",
		data	: "psn_id="+id,
		dataType : "json",				  
		success	: function(data){
			$("#psn_id").val(data.psn_id);
			$("#psn_nama").val(data.psn_nama);
			$("#psn_gelar").val(data.psn_gelar);
			$("#psn_tempat_lahir").val(data.psn_tempat_lahir);
			var tgl = data.psn_tgl_lahir.split("-");
			var tglbaru = tgl[2]+"/"+tgl[1]+"/"+tgl[0];

			$("#psn_tgl_lahir").val(tglbaru);
			$("#psn_jk").val(data.psn_jk);
			$("#psn_jkitas").val(data.psn_jkitas);
			$("#psn_alamat").val(data.psn_alamat);
			$("#psn_nokitas").val(data.psn_nokitas);
			$("#psn_telp").val(data.psn_telp);
			if (data.psn_tgl_masuk != null)
			{
				var tgl_masuks = data.psn_tgl_masuk.split("-");
				var tgl_masuk = tgl_masuks[2]+"/"+tgl_masuks[1]+"/"+tgl_masuks[0];
				$("#psn_tgl_masuk").val(tgl_masuk);
			}
			if (data.psn_nokitas == "Prodi")
			{
				$("#psn_prodi").val(data.psn_nokitas_det);
				$("#inputProdi").show();
				$("#inputFakultas").hide();
			}
			else 
			{
				$("#psn_fakultas").val(data.psn_nokitas_det);
				$("#inputProdi").hide();
				$("#inputFakultas").show();
			}
				
			$(".inputan").attr("disabled",false);
			$("#modal_pasien").modal({
				show: true,
				keyboard: false,
				backdrop: 'static'
			});
			return false;
		}
	});
}

$("#yaKonfirm").click(function(){
	var id = $("#idSts").val();
	var foto = $("#hapusfoto").val();

	$("#isiKonfirm").html("Sedang menghapus data...");
	$(".btn").attr("disabled", true);
	$.ajax({
       type: "GET",
		url: "hapus/"+id+"/"+foto,  
		success: function(d) 
        {
			var res = JSON.parse(d);
			var msg = "";
			if (res.status == 1)
			{
				msg = res.desc;
			}
			else
			{
				msg = res.desc + "["+res.err+"]";
			}
			$("#isiKonfirm").html(msg);
			$(".utama").hide();
			$(".cadangan").show();
			$(".btn").attr("disabled", false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
});

$('.tgl').daterangepicker({
	locale: {
	  format: 'DD/MM/YYYY'
	},
	showDropdowns: true,
	singleDatePicker: true,
	"autoApply": true,
	opens: 'left'
});