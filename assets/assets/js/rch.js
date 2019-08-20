
	$("#up_passlama").focusout(function(){
		var isi = $(this).val();
		var nama = $(this).attr("nama");
		alert(nama);
		if (isi == "")
		{
			$(this).prop("tooltiptext", nama+"tidak boleh kosong");
			$(this).tooltip();
		}
	});
	
	
	
	// $("#up_passlama").click(function(){
		// var nama = $(this).attr("nama");
		// $(this).attr("title", nama+"tidak boleh kosong");
		// alert(nama);
		// $(this).tooltip();
	// });