<!DOCTYPE html>
<html>
<head>

</head>

<body>
<div id='txtKeranjang'><b></b></div>
<?php
require_once("koneksi.php");
$q = intval($_GET['kode']);
$val = intval($_GET['jml']);
	  
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
					 
		$queryPosem = "SELECT * from detail_po_sem WHERE kode_brg = $q";
		$resultPosem = mysqli_query($connect_db, $queryPosem);
		$row = mysqli_fetch_assoc($resultPosem);
			
			if(!$row){
					$query1 = "INSERT INTO detail_po_sem (id_po, kode_brg, barcode, nama_brg, hrg_sup, jml_brg, total, tgl_edit)
					VALUES ('$id', '$data[KODE_BRG]', '$data[BARCODE]', '$data[NAMA_BRG]', $data[HRG_SUP], $val, $jumlah_harga, '$edit')";
					$result1 = mysqli_query($connect_db, $query1);
						if(!$result1){
								die ("Query gagal dijalankan: ".mysqli_errno($connect_db).
									" - ".mysqli_error($connect_db));
						}
			}else{							
				
				$jumlahUpdate = ($row['jml_brg']+1);
				$totalHarga = ($row['hrg_sup'] * $jumlahUpdate);
				$queUpdate = "Update detail_po_sem set jml_brg = $jumlahUpdate, total = $totalHarga where kode_brg = $q";
				$resultUpdate = mysqli_query($connect_db, $queUpdate);
			}
	// periska query apakah ada error
  
				
	
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
		<button type='button' onclick='tambah(formtambah.kode_brg.value,formtambah.jmledit.value);'>Tambah</button>
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
        $no++; // menambah nilai nomor urut
      }
	  $queryTotalPo = "SELECT sum(total) as total_po from detail_po_sem WHERE id_po = '$id'";
		$resultTotalPo = mysqli_query($connect_db, $queryTotalPo);
		$rowTotal = mysqli_fetch_assoc($resultTotalPo);
	  $totalPo = $rowTotal['total_po'];
	  if($totalPo == 0){
					echo '<p><div align="right">
						<a href="cart.php?act=clear&amp;ref=input_PO.php?kode=0" class="btn btn-info">&laquo; INPUT PO BARU</a>
						</div></p>';
				} else {
					echo '
						<tr style="background-color: #DDD;"><td colspan="5" align="right"></td><td colspan="2" align="right"><b>Total PO : </b></td><td align="right"><b>Rp. '.number_format($totalPo,2,",",".").'</b></td></td></td><td></td></tr>
						';
				} 

	  echo "</table>";
		if($totalPo == 0){
					echo '<table><tr>
						<td colspan="5" align="center">Ups, Keranjang kosong!</td>
						</tr></table>';					
				} else {
					echo '
						<p><div align="right">
						<a href="cart.php?act=clear&amp;ref=input_PO.php?kode=0" class="btn btn-info">&laquo; INPUT PO BARU</a>
						<a href="simpanpo.php?kode='.$data['SUP'].'" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> SIMPAN PO &raquo;</a>
						</div></p>
					';
				}
        ?>
</body>
</html>