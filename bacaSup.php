<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
require_once("koneksi.php");
$q = intval($_GET['kode']);
	  
		  $query = "SELECT * FROM SUP WHERE KODE_SUP = '".$q."'";
			$result = mysqli_query($connect_db, $query);
	// periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($connect_db).
           " - ".mysqli_error($connect_db));
  }

      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      $data = mysqli_fetch_assoc($result);
      
        // mencetak / menampilkan data
        echo $data['NAMA_SUP'];
        ?>
</body>
</html>