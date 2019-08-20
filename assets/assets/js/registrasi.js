var save_method; //for save method string
var table;

table = $('#tabel-registrasi').DataTable({ 
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
		"url": "ajax_list_registrasi/",
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

$("#reg_tambah").click(function(){
	$("#reg_id").val(0);
	$('#modal_registrasi').modal({
		show: true,
		keyboard: false,
		backdrop: 'static'
	});
});

$("#reg_nokitas").change(function(){
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

$("#frm_registrasi").submit(function(e){
	// var dataString = $("#frm_registrasi").serialize();
	e.preventDefault();
	$("#reg_simpan").html("Menyimpan...");
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
			$("#modal_registrasi").modal("hide");
			$("#pesan_info_ok").html(msg);
			$("#reg_simpan").html("Simpan");
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

function hapus_registrasi(id)
{
	// alert(id);
	$("#idSts").val(id);
	$("#jdlKonfirm").html("Konfirmasi hapus data");
	$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
	$("#frmKonfirm").modal({
		show: true,
		keyboard: false,
		backdrop: 'static'
	});
}

function ubah_registrasi(id)
{
	$.ajax({
		type	: "POST",
		url		: "cari",
		data	: "reg_id="+id,
		dataType : "json",				  
		success	: function(data){
			$("#reg_id").val(data.reg_id);
			$("#reg_dok_id").val(data.reg_dok_id);
			$("#reg_sps_id").val(data.reg_sps_id);
				
			$(".inputan").attr("disabled",false);
			$("#modal_registrasi").modal({
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

	$("#isiKonfirm").html("Sedang menghapus data...");
	$(".btn").attr("disabled", true);
	$.ajax({
       type: "GET",
		url: "hapus/"+id,  
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
	"autoApreg": true,
	opens: 'left'
});