<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
require_once("koneksi.php");
$q = intval($_GET['kode']);
$val = $_GET['jml'];
	  
		  $query = "SELECT * from brg WHERE KODE_BRG = $q";
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
		$jumlah_harga = $data['HRG_SUP'] * $val;
        date_default_timezone_set("Asia/Jakarta");
					  $id = 'FBMG'.date('dmy').'-'.$data['SUP'];
					  $edit = date('Y-m-d');
					 
		$query1 = "INSERT INTO detail_po_sem (id_po, kode_brg, nama_brg, hrg_sup, jml_brg, total, tgl_edit)
				VALUES ('$id', '$data[KODE_BRG]', '$data[NAMA_BRG]', $data[HRG_SUP], $val, $jumlah_harga, '$edit')";
		$result1 = mysqli_query($connect_db, $query1);
	// periska query apakah ada error
  if(!$result1){
      die ("Query gagal dijalankan: ".mysqli_errno($connect_db).
           " - ".mysqli_error($connect_db));
  }
				
	
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
 <th>JUMLAH</th>
 <th>Pilihan</th>
 </tr>";
      
	  
		  $query2 = "SELECT * FROM detail_po_sem where id_po='$id'";
			$result2 = mysqli_query($connect_db, $query2);
	// periska query apakah ada error
  if(!$result2){
      die ("Query gagal dijalankan: ".mysqli_errno($connect_db).
           " - ".mysqli_error($connect_db));
  }

      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($data1 = mysqli_fetch_assoc($result2))
      {
        // mencetak / menampilkan data
        echo "<tr>";
        echo "<td>$no</td>"; //menampilkan no urut
        echo "<td>$data1[id_po]</td>"; //menampilkan data nim
        echo "<td>$data1[kode_brg]</td>"; //menampilkan data nama
        echo "<td>$data1[nama_brg]</td>"; //menampilkan data fakultas
		echo "<td>$data1[hrg_sup]</td>";
		echo "<td>$data1[jml_brg]</td>";
		echo "<td>$data1[total]</td>";
       
        // membuat link untuk mengedit dan menghapus data
        echo '<td>
			<div class="clear"> 
			<button type="button" onclick="keranjang(this."$data[KODE_BRG]",this."$data[JML_BARANG]")">Change Content</button>
        </td>';
        echo "</tr>";
        $no++; // menambah nilai nomor urut
      }
	  echo "</table>";
        ?>
</body>
</html>