function kirim_form(){
	$('#pesan_kirim').html('Loading ...');
	$('#pesan_kirim').slideDown('slow');
	
	var nama   = $('#txt_nama').val();
	var gender = $('#gender').val();
	var alamat = $('#txt_alamat').val();
	var agama  = $('input[name=agama]:checked').val();
	var hoby   = $('input[name=hoby]:checked').map(function(){
						return $(this).val();
				 }).get();
	$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : 'http://localhost:8080/maga/tambah.php',
		type     : 'POST',
		dataType : 'html',
		data     : 'nama='+nama+'&gender='+gender+'&alamat='+alamat+'&agama='+agama+'&hoby='+hoby,
		success  : function(respons){
			$('#pesan_kirim').html(respons);
		},
	})
}