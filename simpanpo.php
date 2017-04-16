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
	<!-- end: CSS -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    
	<!--start: Header -->
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
			              			<li class="active"><a href="index.php">Home</a></li>
			              			<li><a href="produk.php">Produk Kami</a></li>
									<li><a href="testimoni.php">Testimoni</a></li>
                                    <li><a href="detail_po.php">Keranjang</a></li>
			              			<li class="dropdown">
			                			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
			                			<ul class="dropdown-menu">
			                  				<li><a href="index.html">Admin</a></li>
			                  				<li><a href="index.php">Konsumen</a></li>
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
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!-- start: Container -->
		<div class="container">

			<!-- start: Table -->
            <div class="title"><h3>Detail PO</h3></div>
<table class="table table-hover table-condensed">
<tr>
					<th><center>No Pembelian</center></th>
                    <th><center>Kode Barang</center></th>
					<th><center>Nama Barang</center></th>
					<th><center>Jumlah</center></th>
					<th><center>Harga Satuan</center></th>
					<th><center>Sub Total</center></th>
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
            $no = 1;
            ?>
                <tr>
                <td><center><?php echo $no++; ?></center></td>
                <td><center><?php echo $data['KODE_BRG']; ?></center></td>
                <td><center><?php echo $data['NAMA_BRG']; ?></center></td>
				<td><center><?php echo number_format($val); ?></center></td>
                <td><center><?php echo number_format($data['HRG_SUP']); ?></center></td>                
                <td><center><?php echo number_format($jumlah_harga); ?></center></td>
                </tr>
                <?php date_default_timezone_set("Asia/Jakarta");
					  $id = 'FBMG'.date('dmy-hi').'-'.$data['SUP'];
					  $edit = date('Y-m-d');
					  $smaga = 'Y';
					  $ssuplier = 'N';
				$query1 = mysqli_query($connect_db, "INSERT INTO detail_po (id_po, kode_brg, nama_brg, hrg_sup, jml_brg, total, tgl_edit)
				VALUES ('$id', '$data[KODE_BRG]', '$data[NAMA_BRG]', $data[HRG_SUP], $val, $jumlah_harga, '$edit')");
				?>
					<?php
                    //mysql_free_result($query);			
						}
							//$total += $sub;
						}?>  
						
                         <?php
				if($total == 0){
					echo '<tr><td colspan="5" align="center">Ups, Keranjang kosong!</td></tr></table>';
					echo '<p><div align="right">
						<a href="index.php" class="btn btn-info btn-lg">&laquo; Continue Shopping</a>
						</div></p>';
				} else {
					echo '
						<tr style="background-color: #DDD;"><td colspan="4" align="right"><b>Total :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</b></td></td></td><td></td></tr></table>
						<p><div align="right">
						<a href="cart.php?act=clear&amp;ref=input_PO.php?kode=0" class="btn btn-info">&laquo; INPUT PO BARU</a>
						<a href="edit_po.php?id='.$id.'" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> EDIT PO &raquo;</a>
						</div></p>
					';
					$query3 = mysqli_query($connect_db, "INSERT INTO po (id_po, kode_sup, tgl_po, total, status_maga, status_suplier)
				VALUES ('$id', '$data[SUP]', '$edit', $total, '$smaga', '$ssuplier')");
				}
				 
				?>
				
				
</table>
			
				
			<!-- end: Table -->

		</div>
		<!-- end: Container -->
				
	</div>
	<!-- end: Wrapper  -->			

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