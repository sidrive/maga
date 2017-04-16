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
    $currentUser = $user->getUser();
		include("header.php");
     ?>
	

	
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-usd ico-white"></i>Daftar PO Suplier </h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!-- start: Container -->
		<div class="container">
		
		<form id="form_cari_suplier" action="daftar_po.php" method="get">
        <fieldset>
          
		  <select id="suplier" name="kode">
    <option>---- Pilih Suplier ----</option>
    <?php
    $sql = mysqli_query($connect_db,"SELECT * FROM SUP ORDER BY NAMA_SUP ASC");
    while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="<?php echo $row['KODE_SUP']; ?>">
                        <?php echo $row['NAMA_SUP']; ?>
                    </option>
                <?php
                }
		?>
		</select>
	  <p>
          <input type="submit" name="input" value="Cari">
       </p>
	   
         </fieldset>
        
      </form>
	  

		<form action="daftar_po.php">
			<h4>Tanggal Awal</h4>
			<input type="date" name="tanggalawal">
			<h4>Tanggal Akhir</h4>
			<input type="date" name="tanggalakhir">
			<p><input type="submit" value="Cari"></p>
		</form>
 
        
			<!-- start: Table -->
            <div class="title"><h3>Daftar PO</h3></div>
				<table class="table table-hover table-condensed">
				<tr>
					<th><center>No</center></th>
                    <th><center>Kode PO</center></th>
					<th><center>Nama Suplier</center></th>
					<th><center>Tanggal Pembuatan</center></th>
					<th><center>Total</center></th>
					<th><center>Status Maga</center></th>
					<th><center>Status Suplier</center></th>
					<th><center>Opsi</center></th>
				</tr>
			    <?php
				//MENAMPILKAN DAFTAR PO//
    date_default_timezone_set("Asia/Jakarta");           
    
	$isi = date('Y-m-d');
	
    //mysql_select_db($database_conn, $conn);
    if (isset($_GET['kode'])){
		$pilihan = 'kode_sup';
		$kode = $_GET['kode'];
		$query = mysqli_query($connect_db, "select * from po where $pilihan = '$kode'");
				
	}else if(isset($_GET['tanggalawal'])){
		
		$tanggalawal = $_GET['tanggalawal'];
		$tanggalakhir = $_GET['tanggalakhir'];
		$query = mysqli_query($connect_db, "SELECT * FROM po WHERE tgl_po BETWEEN '$tanggalawal' AND '$tanggalakhir'");
            echo $tanggalawal;echo $tanggalakhir;
	} else {
		$kode = 0;
		$tanggalawal = 0;
		$tanggalakhir = 0;
		$query = mysqli_query($connect_db, "select * from po where tgl_po = '$isi'");
	}  
			//$query1 = mysqli_query($connect_db, "select * from sup where KODE_SUP = $data[kode_sup]");
            //$data1 = mysqli_fetch_array($query1);
			$no = 1;
			
			while($data = mysqli_fetch_assoc($query))
      {
		  if ($data['status_maga']=='Y'){
			$status_maga = 'Setuju';
		}else{ $status_maga = 'Belum';}
		if ($data['status_suplier']=='Y'){
			$status_suplier = 'Setuju';
		}else{ $status_suplier = 'Belum';}
        // mencetak / menampilkan data
        echo "<tr>";
        echo "<td>$no</td>"; //menampilkan no urut
        echo "<td>$data[id_po]</td>"; //menampilkan data nim
        echo "<td>$data[kode_sup]</td>"; //menampilkan data nama
        echo "<td>$data[tgl_po]</td>"; //menampilkan data fakultas
		echo "<td>$data[total]</td>";
		echo "<td>$status_maga</td>";
		echo "<td>$status_suplier</td>";
       
        // membuat link untuk mengedit dan menghapus data
        echo "<td>
		<div class='clear'> 
			<a href='edit_po.php?id=".$data['id_po']."' class='btn btn-default btn-small'>Detail</a> 
        </td>";
        echo "</tr>";
        $no++; // menambah nilai nomor urut
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