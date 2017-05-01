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
	<script type="text/javascript" src="js/simpleAjax.1.0.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="http://belajarnge.web.id/alat/jquery-3.1.1.js"></script>
     <script type="text/javascript" src="http://belajarnge.web.id/alat/framework.jquery.js"></script>
     <script type="text/javascript">
          $("document").ready(function() {
               $("#insert").click(function() {
                    var nama = $("#nama").val();
                    var email = $("#email").val();
                    var data = 'nama='+nama+'&email='+email;
                    ajax("tambah.php", data);
               });
          });
     </script>
	 <script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan").click(function(){
			var data = $('.tambahdata').serialize();
			$.ajax({
				type: 'POST',
				url: "tambah.php",
				data: data,
				success: function() {
					$('.txtKeranjang').load("keranjang.php");
				}
			});
		});
	});
	</script>
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
	
	<!-- script ajax untuk memanggil data barang per suplier -->
	
	<script>
	function showDatabarang(str) {
    if (str == "") {
        document.getElementById("txtData").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtData").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","coba.php?kode="+str,true);
        xmlhttp.send();
    }bacaSuplier(str);
	}
	</script>
	<!-- script ajax untuk memanggil data barang per suplier -->
	
	
	<!-- script ajax untuk memanggil data barang per suplier -->
	<script>
	function bacaSuplier(str) {
    if (str == "") {
        document.getElementById("txtSup").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtSup").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","bacaSup.php?kode="+str,true);
        xmlhttp.send();
    }
	}
	</script>
	<!-- script ajax untuk memanggil data barang per suplier -->
	
	<script>
	function keranJang(str,jml) {
    if (str == "" && jml == "") {
        document.getElementById("txtKeranjang").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtKeranjang").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","keranjang.php?kode="+str+"&jml="+jml,true);
        xmlhttp.send();
    }
	}
	</script>
	
	<script>
	function tambah(kode,jml) {
    if (kode == "" && jml == "") {
        document.getElementById("txtKeranjang").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtKeranjang").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","tambah.php?kode_brg="+kode+"&jmledit="+jml,true);
        xmlhttp.send();
    }
	}
	</script>
	
	<script type="text/javascript">
	simpleAjax = $("body").simpleAjax(); 
	
	function tambah1(data, theTag){
	var j = simpleAjax.json_decode(data);	

	//theTag is the selector of the button you clicked, so you can manipulate it when AJAX call returns
	theTag.fadeOut();

	$("#result_register").html("<br/>"+j.jmledit +"<br/>"+ j.kode_brg +"<br/>"+ j.jumlah);
	$("#result_register").slideDown();

	}	
	</script>
	
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

				<h2><i class="ico-usd ico-white"></i>PO Suplier <div id="txtSup"><b>Person info will be listed here...</b></div> </h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!-- Start Wrapper -->
	 	<div id="wrapper">
			<div id="container">
			
	 <form>
	<select name="users" onchange="showDatabarang(this.value)">
		<option value="">Pilih Suplier</option>
		<?php $sql = mysqli_query($connect_db,"SELECT * FROM SUP ORDER BY NAMA_SUP ASC");
			while ($row = mysqli_fetch_array($sql)) { echo
				"<option value='"; echo $row['KODE_SUP']."'>";
				echo $row['NAMA_SUP']."</option>";
		
		} ?>  
  </select>
</form>

			             
    
	<div id='txtKeranjang'><b></b></div>
	
	<div id="result_register"></div>
    
			<!-- end: Table -->
		</div>
		<!-- end: Container -->
	</div>
	<!-- end: Wrapper -->
	
	<!-- Div untuk menampilkan tabel data barang per suplier -->
	<div id="txtData"><b>Person info will be listed here...</b></div>			

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