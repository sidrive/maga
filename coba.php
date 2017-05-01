<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
require_once("koneksi.php");
$q = intval($_GET['kode']);


echo "<div class='container'>
    <h1>Tabel Data Barang </h1>
    <br/>
	<div class='bodycontainer scrollable'>
    <table class='table table-condensed table-hover' >
      <tr class='info'>
 <th>No</th>
 <th>Kode Barang</th>
 <th>Nama Barang</th>
 <th>Barcode</th>
 <th>JUMLAH</th>
 <th>JUMLAH</th>
 <th>Pilihan</th>
 </tr>";
      
	  
		  $query = "SELECT * FROM brg where SUP='$_GET[kode]' ORDER BY JML_BARANG DESC";
			$result = mysqli_query($connect_db, $query);
	// periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($connect_db).
           " - ".mysqli_error($connect_db));
  }

      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($data = mysqli_fetch_assoc($result))
      {
        // mencetak / menampilkan data
        echo "<tr>";
        echo "<td>$no</td>"; //menampilkan no urut
        echo "<td>$data[KODE_BRG]</td>"; //menampilkan data nim
        echo "<td>$data[NAMA_BRG]</td>"; //menampilkan data nama
        echo "<td>$data[BARCODE]</td>"; //menampilkan data fakultas
		echo "<td>$data[JML_BARANG]</td>";
		echo "<td><form name='edit'><input type='number_format' style='width:25px' name='jmledit'/></form></td>";
       
        // membuat link untuk mengedit dan menghapus data
        echo '<td>
			<div class="clear"> 
			<button type="button" onclick="keranJang('.$data['KODE_BRG'].','.$data['JML_BARANG'].')">Change Content</button>
			</td>';
        echo "</tr>";
        $no++; // menambah nilai nomor urut
      }
	  echo "</table>";
      ?>
	  
	  
</body>
</html>