<?php 
	require_once("koneksi.php");
    require_once "user.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if(!$user->isLoggedIn()){
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser(); ?>
	
<!DOCTYPE html>
<html>
<head>

</head>

<body>

<?php

$id = $_GET['kode'];
		 	
	echo "<div class='container'>
    <h1>Tabel Detail PO </h1>
    <br/>
	<div class='bodycontainer scrollable'>
    <table class='table table-condensed table-hover' >
      <tr class='info'>
 <th>No</th>
 <th>Kode Barang</th>
 <th>Barcode</th>
 <th>Nama Barang</th>
 <th>Harga Satuan</th>
 <th>Jumlah</th>
 <th>Jumlah</th>
 <th>Sub Total</th>
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
        echo "<td>$data1[kode_brg]</td>"; //menampilkan data nama
		echo "<td>$data1[barcode]</td>";
        echo "<td>$data1[nama_brg]</td>"; //menampilkan data fakultas
		echo "<td>$data1[hrg_sup]</td>";
		echo "<td><form name='formtambah' >
		<input type='number_format' style='width:25px' name='jmledit' /> 
		<input type='number_format' style='width:25px' name='kode_brg' value='$data1[kode_brg]' hidden />
		<input type='number_format' style='width:25px' name='jumlah' value='$data1[jml_brg]' hidden />
		</form></td>";
		echo "<td><input type='number_format' style='width:25px' name='jumlah' value='$data1[jml_brg]' readonly /></td>";
		echo "<td>$data1[total]</td>";
       
        // membuat link untuk mengedit dan menghapus data
        echo '<td>
			<div class="clear">
			<input type="submit" name="login" value="Send" />
			<button type="button" onclick="tambah(formtambah.kode_brg.value,formtambah.jmledit.value)">Tambah</button>
			<button type="button" onclick="">Hapus</button> 
			
        </td>';
        echo "</tr>";
		$query1 = "INSERT INTO detail_po (id_po, kode_brg, barcode, nama_brg, hrg_sup, jml_brg, total, tgl_edit)
					VALUES ('$id', '$data1[kode_brg]', '$data1[barcode]', '$data1[nama_brg]', $data1[hrg_sup], $data1[jml_brg], $data1[total], '$data1[tgl_edit]')";
					$result1 = mysqli_query($connect_db, $query1);
        $no++; // menambah nilai nomor urut
      }
	  $queryTotalPo = "SELECT sum(total) as total_po from detail_po_sem WHERE id_po = '$id'";
		$resultTotalPo = mysqli_query($connect_db, $queryTotalPo);
		$rowTotal = mysqli_fetch_assoc($resultTotalPo);
	  $totalPo = $rowTotal['total_po'];
	  $status_maga = 'Y';
	  $status_suplier = 'N';
	  $kode_sup = substr($id,-4);
	  date_default_timezone_set("Asia/Jakarta");
		  $edit = date('Y-m-d');
	  
	  $simpanpo = "INSERT INTO po (id_po, kode_sup, tgl_po, total, status_maga, status_suplier, status_kirim)
					VALUES ('$id','$kode_sup','$edit',$rowTotal[total_po], '$status_maga', '$status_suplier', 'N')";
					$resultSimpanPo = mysqli_query($connect_db, $simpanpo);
					
	/* Bersihkan data pada tabel detail_po_sem */
		$data=$connect_db->query("DELETE FROM detail_po_sem");
	/* Bersihkan data pada tabel detail_po_sem */		
	
	 /* Mengalihkan ke index.php */  header("location:index.php");
        ?>
</body>
</html>