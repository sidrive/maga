<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      table{
        width: 840px;
        margin: auto;
      }
      h1{
        text-align: center;
      }
    </style>
  </head>
  <body>
    <h1>Tabel Data User</h1>
    <center><a href="input.php">Input Data &Gt; </a></center>
    <br/>
    <table border="1">
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Jabatan</th>
        
        <th>Pilihan</th>
      </tr>
      <?php
	  $kode='0124';
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM brg where SUP='$kode' ORDER BY JML_BARANG ASC";
      $result = mysqli_query($connect_db, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($connect_db).
           " - ".mysqli_error($connect_db));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
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
       
        // membuat link untuk mengedit dan menghapus data
        echo '<td>
          <a href="edit.php?id='.$data['KODE_BRG'].'">Edit</a> /
          <a href="hapus.php?id='.$data['KODE_BRG'].'"
      		  onclick="return confirm(\'Anda yakin akan menghapus data?\')">Hapus</a>
        </td>';
        echo "</tr>";
        $no++; // menambah nilai nomor urut
      }
      ?>
    </table>
  </body>
</html>