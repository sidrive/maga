<html>
	<head>
		<title>Membuat form pilihan merek kendaraan</title>
		<script type="text/javascript" src="jquery-1.6.1.min.js">//memanggil jquery</script>
		
		<script type="text/javascript" src="ajax.js">//memanggil script ajax</script>
	</head>
	<body>
		<form id="form_post">
<input type="text" name="nama" id="nama">
<input type="text" name="alamat" id="alamat">
</form>
<button id="kirim"> Kirim </button>
<span id="return_message"> </span>
<script>
    $(document).ready(function(){
        $('#kirim').click(function(){
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/maga/tambah.php",
                data: $('#form_post').serialize(),
                error:function(){
                    alert('Error\nGagal request data');
                },
                success: function (result) {
                    $('#return_message').html(result);
                }
            });
        });
    });
</script>
	</body>
</html>