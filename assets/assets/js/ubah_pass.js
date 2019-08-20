$("#up_infoalert").hide();


$("#up_simpan").click(function(){
	$('#up_simpan').text('Menyimpan...'); //change button text
	$('.btn').attr('disabled',true); //set button enable 
	$.ajax({
        url : "login/ubah_pass",
        type: "POST",
        data: $('#frm_ubahpass').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#up_infoalert").removeClass("alert-danger");
                $("#up_infoalert").addClass("alert-success");
				$("#up_pesan").html(data.pesan);
				$("#up_infoalert").fadeIn();
				setTimeout(function(){
					document.location.href='';
				}, 2000);
            }
			else{
                $("#up_infoalert").removeClass("alert-success");
                $("#up_infoalert").addClass("alert-danger");
				$("#up_pesan").html(data.pesan);
				$("#up_infoalert").fadeIn().delay(2000).fadeOut();
			}
			$('#up_simpan').text('Simpan'); //change button text
			$('.btn').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(jqXHR+ " - " + textStatus + " - " +errorThrown);
            $('#up_simpan').text('Simpan'); //change button text
			$('.btn').attr('disabled',false); //set button enable 

        }
    });
})