<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
 require_once("koneksi.php");
 require_once "user.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if(!$user->isLoggedIn()){
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser();
	
	$no=0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- start: Meta -->
	<meta charset="utf-8">
	<title>Maga Swalayan</title> 
	<meta name="author" content="IT Maga"/>
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- end: Mobile Specific -->
	
	 <!-- start: CSS --> 
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- end: CSS -->
	
      <style>
      table{
        width: 80%;
        margin: auto;
      }
      h1{
        text-align: center;
      }
	  .bodycontainer { max-height: 450px; width: 90%; margin: 0; overflow-y: auto; }
	.table-scrollable { margin: 0; padding: 0; }
    </style>
	
  </head>
  <body>
  
 	  <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#kode").chained("#suplier");
           
        </script>

		<header>
		
		<!--start: Container -->
		<div class="container">
			
			<!--start: Row -->
			<div class="row">
					
				<!--start: Logo -->
				<div class="logo span3">
						
					<a class="brand" href="#"><img src="img/logo.jpg" alt="Logo"></a>
						
				</div>
				<!--end: Logo -->
					
				<!--start: Navigation -->
				<div class="span9">
					
					<div class="navbar navbar-inverse">
			    		<div class="navbar-inner">
			          		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			            		<span class="icon-bar"></span>
			            		<span class="icon-bar"></span>
			            		<span class="icon-bar"></span>
			          		</a>
			          		<div class="nav-collapse collapse">
			            		<ul class="nav">
			              			<li class="active"><a href="index.php">PO Baru</a></li>
			              			<li><a href="produk.php">Daftar PO</a></li>
									<li><a href="testimoni.php">Penawaran</a></li>
                                    <li><a href="detail_po.php">Data Barang</a></li>
			              			<li class="dropdown">
			                			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
			                			<ul class="dropdown-menu">
			                  				<li><a href="index.html">Admin</a></li>
			                  				<li><a href="index.php">MD</a></li>
			                  				<!--<li class="divider"></li>
			                  				<li class="nav-header">Nav header</li>
			                  				<li><a href="#">Separated link</a></li>
			                  				<li><a href="#">One more separated link</a></li>-->
			                			</ul>
			              			</li>
			            		</ul>
			          		</div>
			        	</div>
			      	</div>
					
				</div>	
				<!--end: Navigation -->
					
			</div>
			<!--end: Row -->
			
		</div>
		<!--end: Container-->			
			
	</header>
	<!--end: Header-->
	
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-usd ico-white"></i>PO Suplier <?php $query2 = mysqli_query($connect_db, "select * from SUP where KODE_SUP = '$_GET[kode]'");
            $data = mysqli_fetch_array($query2);
			echo $data['NAMA_SUP']; ?></h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!-- Start Wrapper -->
	 	<div id="wrapper">
			<div id="container">
			
	 <form id="form_cari_suplier" action="input_PO.php" method="get">
        <fieldset>
      
		  
	 <!-- Menampilkan atau tidak pencarian suplier --> 
		  <?php 
	if ($_GET['kode'] == 0){
		echo
		"<form id='form_cari_suplier' action='input_PO.php' method='get'>
		<select id='suplier' name='kode'>
		<option>---- Pilih Suplier ----</option>";
	
    $sql = mysqli_query($connect_db,"SELECT * FROM SUP ORDER BY NAMA_SUP ASC");
    while ($row = mysqli_fetch_array($sql)) { echo
		"<option value='"; echo $row['KODE_SUP']."'>";
		echo $row['NAMA_SUP']."</option>";
		
	}
             "</select>";
	   echo "<p><input type='submit' name='input' value='Cari'></p>"  ; 
	}else{
		echo "";}
	?>
         </fieldset>
        
      </form>
			<!-- start: Table -->
            <div class="title"><h3>Detail PO <?php 
			$id = $data['NAMA_SUP']; echo $id; ?></h3></div>
				<table class="table-responsive table-hover table-condensed">
				<tr>
					<th><center>No</center></th>
                    <th><center>Kode Barang</center></th>
					<th><center>Nama Barang</center></th>
					<th><center>Jumlah</center></th>
					<th><center>Harga Satuan</center></th>
					<th><center>Sub Total</center></th>
					<th><center>Opsi</center></th>
				</tr>
			    <?php
				//MENAMPILKAN DETAIL KERANJANG BELANJA//
                
    $total = 0;
    //mysql_select_db($database_conn, $conn);
    if (isset($_SESSION['items'])) {
        foreach ($_SESSION['items'] as $key => $val) {
            $query = mysqli_query($connect_db, "select * from brg where KODE_BRG = '$key'");
            $data = mysqli_fetch_array($query);

            $jumlah_harga = $data['HRG_SUP'] * $val;
            $total += $jumlah_harga;
            $no++;
            ?>
                <tr>
                <td><center><?php echo $no; ?></center></td>
                <td><center><?php echo $data['KODE_BRG']; ?></center></td>
                <td><center><?php echo $data['NAMA_BRG']; ?></center></td>
				<td><center><Input type="text" name="val" id="val" value="<?php echo number_format($val); ?>"></center></td>
                <td><center><?php echo number_format($data['HRG_SUP']); ?></center></td>                
                <td><center><?php echo number_format($jumlah_harga); ?></center></td>
                <td><center>
				<a href="cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;val=<?php echo $val; ?>&amp;ref=input_PO.php?kode=<?php echo $data['SUP']; ?>" class="btn btn-xs btn-success">Tambah</a> 
				<a href="cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=input_PO.php?kode=<?php echo $data['SUP']; ?>" class="btn btn-xs btn-warning">Kurang</a> 
				<a href="cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=input_PO.php?kode=<?php echo $data['SUP']; ?>" class="btn btn-xs btn-danger">Hapus</a></center></td>
                </tr> 
                
					<?php
                    //mysql_free_result($query);			
						}
							//$total += $sub;
						}?>  
                         <?php
				if($total == 0){
					echo '<table><tr>
						<td colspan="5" align="center">Ups, Keranjang kosong!</td>
						</tr></table>';
					echo '<p><div align="right">
						<a href="cart.php?act=clear&amp;ref=input_PO.php?kode=0" class="btn btn-info">&laquo; INPUT PO BARU</a>
						</div></p>';
				} else {
					echo '
						<tr style="background-color: #DDD;"><td colspan="4" align="right"><b>Total :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</b></td></td></td><td></td></tr>
						<p><div align="right">
						<a href="cart.php?act=clear&amp;ref=input_PO.php?kode=0" class="btn btn-info">&laquo; INPUT PO BARU</a>
						<a href="simpanpo.php?kode='.$data['SUP'].'" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> SIMPAN PO &raquo;</a>
						</div></p>
					';
				}
				?>
				</table>
			<!-- end: Table -->
		</div>
		<!-- end: Container -->
	</div>
	<!-- end: Wrapper -->
	
<!-- Batas Batas -->			
	<div class="container">
    <h1>Tabel Data Barang </h1>
    <br/>
	<div class="bodycontainer scrollable">
    <table class="table table-condensed table-hover" >
      <tr class="info">
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Barcode</th>
		<th>JUMLAH</th>
        
        <th>Pilihan</th>
      </tr>
      <?php
	  
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
       
        // membuat link untuk mengedit dan menghapus data
        echo '<td>
			<div class="clear"> 
			<a href="cart.php?act=add&amp;KODE_BRG='.$data['KODE_BRG'].'&amp;VAL='.$data['JML_BARANG'].'&amp;ref=input_PO.php?kode='.$data['SUP'].'" class="btn btn-md btn-danger">Tambah</a></div>
          
        </td>';
        echo "</tr>";
        $no++; // menambah nilai nomor urut
      }
      ?>
    </table>
	</div>
	</div>
		    <!-- start: Footer Menu -->
	<div id="footer-menu" class="hidden-tablet hidden-phone">

		<!-- start: Container -->
		<div class="container">
			
			<!-- start: Row -->
			<div class="row">

				<!-- start: Footer Menu Logo -->
				<div class="span2">
					<div id="footer-menu-logo">
						<a href="#"><img src="img/logo-footer.png" alt="logo" /></a>
					</div>
				</div>
				<!-- end: Footer Menu Logo -->

				<!-- start: Footer Menu Links-->
				<div class="span9">
					
					<div id="footer-menu-links">

						<ul id="footer-nav">

							<li><a href="#">PO Baru</a></li>

							<li><a href="#">Daftar PO</a></li>

							<li><a href="#">Penawaran</a></li>

							<li><a href="#">Data Barang</a></li>
							
							<li><a href="#">Keluar</a></li>

						</ul>

					</div>
					
				</div>
				<!-- end: Footer Menu Links-->

				<!-- start: Footer Menu Back To Top -->
				<div class="span1">
						
					<div id="footer-menu-back-to-top">
						<a href="#"></a>
					</div>
				
				</div>
				<!-- end: Footer Menu Back To Top -->
			
			</div>
			<!-- end: Row -->
			
		</div>
		<!-- end: Container  -->	

	</div>	
	<!-- end: Footer Menu -->

	<!-- start: Footer -->
	<div id="footer">
		
		<!-- start: Container -->
		<div class="container">
			
			<!-- start: Row -->
			<div class="row">


				
				
			</div>
			<!-- end: Row -->	
			
		</div>
		<!-- end: Container  -->

	</div>
	<!-- end: Footer -->

	<!-- start: Copyright -->
	<div id="copyright">
	
		<!-- start: Container -->
		<div class="container">
		
			<p>
				Copyright &copy; <a href="http://www.Maga-Swalayan.com">Maga Swalayan</a> <a href="http://bootstrapmaster.com" alt="Bootstrap Themes">Bootstrap Themes</a> designed by BootstrapMaster
			</p>
	
		</div>
		<!-- end: Container  -->
		
	</div>	
	<!-- end: Copyright -->

<!-- start: Java Script -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.8.2.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/flexslider.js"></script>
<script src="js/carousel.js"></script>
<script src="js/jquery.cslider.js"></script>
<script src="js/slider.js"></script>
<script def src="js/custom.js"></script>
<!-- end: Java Script -->
	
  </body>
</html>