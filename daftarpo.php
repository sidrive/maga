<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
 require_once("koneksi.php");
 require_once "User.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if(!$user->isLoggedIn()){
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Daftar PO Baru - Maga Swalayan</title>
<meta name="author" content="IT Maga"/>

<link href="css/bootstrap2.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php  //include"header.php"; ?>
	<header>
		
		<!--start: Container -->
		<div class="container">
			
			<!--start: Row -->
			<div class="row">
					
				<!--start: Logo -->
				
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
						<a class="navbar-brand" href="#">
						<img alt="logo" src="img/logo1.png">
						</a>
						</div>
					
				
				<!--end: Logo -->
					
				<!--start: Navigation -->
				
					
					
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
			      	
					
				
				<!--end: Navigation -->
				
				</div>
					</nav>
			</div>
			<!--end: Row -->
			
		</div>
		<!--end: Container-->			
			
	</header>
	<!--end: Header-->
	
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-1 main">			
		<div class="container">
					<div class="form-group row">
					<form action="daftarpo.php">
						<div class="col-xs-3">Tanggal Awal
						<input class="form-control" type="date" height="20px" id="tglawal">
						</div>
						<div class="col-xs-3">Tanggal Akhir
						<input  class="form-control" type="date" height="20px" id="tglakhir">
						</div>
						<br><a id="btncari" class="btn btn-success btncari">Tampilkan</a>
					</form>
					</div>
		</div>
		<div class="row timbul">
			<div class="col-lg-12 hilang">
				<div class="panel panel-default">
					
					<div class="panel-heading"></div>	
					<div class="panel-body">
					<div class="table-responsive">
		<table width="100%" class="table table-striped table-bordered" id="tabeldata" >
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">ID PO</th>
                <th class="text-center">Suplier</th>
                <th class="text-center">Tanggal Dibuat</th>
                <th class="text-center" width="100px">Total Harga PO</th>
				<th class="text-center" width="50px">Status Maga</th>
				<th class="text-center" width="50px">Status Suplier</th>
				
				<th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
           <?php
if(isset($_GET['tglawal'])){
	$tglawal = $_GET['tglawal'];
	$tglakhir = $_GET['tglakhir'];
	$query = "SELECT * FROM po WHERE (status_suplier = 'N' OR status_suplier = 'Y') AND tgl_po BETWEEN '$tglawal' AND '$tglakhir'";	
}else{
	$query = "SELECT * FROM po WHERE status_kirim = 'N'";
}
		   
$data=$connect_db->query($query);
$no=1;
while($d=$data->fetch_array()){ 
	
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
                <td>
				<span id="editkodebrg<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "$d[id_po]"; ?></span>
                <input type="text" name="kodebrg" value="<?php echo "$d[id_po]"; ?>" class="form-control formnya" id="boxkodebrg<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				<input type="text" name="kodesup" value="<?php echo "$_GET[kode]"; ?>" class="form-control formnya" id="boxkodesup<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editbarcode<?php echo "$d[id_po]"; ?>" class="textnya"><?php 
				$data1=$connect_db->query("select NAMA_SUP from sup where KODE_SUP = $d[kode_sup]");
				$row=$data1->fetch_assoc();
				echo "$row[NAMA_SUP]";?></span>
				<input type="text" name="barcode" value="<?php echo "$d[kode_sup]"; ?>" class="form-control formnya" id="boxbarcode<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editnamabrg<?php echo "$d[id_po]"; ?>" class="textnya"><?php $tanggal = date('d F Y',strtotime($d['tgl_po']));echo $tanggal; ?></span>
				<input type="text" name="namabrg" value="<?php echo "$d[tgl_po]"; ?>" class="form-control formnya" id="boxnamabrg<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
                <td align="right">
				<span id="editharga<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "Rp. ".number_format($d['total'],2,",",".");; ?></span>	
				<input readonly type="text" name="harga" value="<?php echo "$d[HRG_SUP]"; ?>" class="form-control formnya" id="boxharga<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editstsmaga<?php echo "$d[id_po]"; ?>" class="textnya"><?php 	
				if ($d['status_maga']== 'Y'){
					$status = 'Setuju'; echo $status;
				} if ($d['status_maga']== 'N'){
					$status = 'Belum'; echo $status;
				} ?></span>
				<input type="text" name="barcode" value="<?php echo "$d[kode_sup]"; ?>" class="form-control formnya" id="boxbarcode<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editstssup<?php echo "$d[id_po]"; ?>" class="textnya"><?php 	
				if ($d['status_suplier']== 'Y'){
					$status = 'Setuju'; echo $status;
				} if ($d['status_suplier']== 'N'){
					$status = 'Belum'; echo $status;
				} ?></span>
				<input type="text" name="barcode" value="<?php echo "$d[kode_sup]"; ?>" class="form-control formnya" id="boxbarcode<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
				
				<td align="center">
				<button type="button" class="btn btn-info modaledit erow" onclick="window.location='editposup.php?kode=<?php echo $d['id_po']?>';">Edit PO</button>
				</td>
            </tr>
<?php
$no++; }
?>		
        </tbody>
    </table>
					</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
							<div id="myMod" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit Data PO</h4>
							</div>
							<div class="modal-body">
							<div class="row fetch-data"></div>
							</div>
							</div>
							</div>
							</div>
		<div class="alert bg-warning" role="alert" id="dialogpop">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Yakin akan menghapus data !!!
					<br /><center><button id="hapus" class="btn btn-danger">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="tidak" class="btn btn-primary">Tidak</button></center>
		</div>
		<div class="alert bg-danger" role="alert" id="errorpop">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Nama Tidak Boleh Kosong !!!
		</div>		
		<div class="alert bg-danger" role="alert" id="gagalpop">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> Nama Sudah Ada Di Database !!!
		</div>
		<div class="alert bg-success" role="alert" id="successpop">
					<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></use></svg> Operation Success !!!					
		</div>
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap2.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
	

    <script>
    	$(document).ready(function() {
    		$('#tabeldata').DataTable();
		});	
    </script>
<!--  ############################++++++++++++++++SCRIPT AJAX MODAL ================############################  -->		
<!--  ############################++++++++++++++++SCRIPT AJAX MODAL ================############################  -->		
	<script type="text/javascript">
	$(document).ready(function(){	
	  $("#myModal").on('show.bs.modal', function(e){		
			var id = $(e.relatedTarget).data('id');
	                $.ajax({
					type: 'post',
					url: "inputpopup.php",
					data: 'id=' + id,
					success: function(data){
						$('.fetch-data').html(data);
					}
					});
			});
		 });
	</script>
	
	<script type="text/javascript">
	$(document).ready(function(){	
	  $("#myMod").on('show.bs.modal', function(e){		
			var id = $(e.relatedTarget).data('id');
			var kode = $(e.relatedTarget).data('po');
	                $.ajax({
					type: 'post',
					url: "inputpopup.php",
					data: 'id=' + id +'&kodesup='+kode,
					success: function(data){
						$('.fetch-data').html(data);
					}
					});

			});
		 });
	</script>

<!--  ############################++++++++++++++++SCRIPT AJAX EDITING ================############################  -->		
<!--  ############################++++++++++++++++SCRIPT AJAX EDITING ================############################  -->		
	<script type="text/javascript">
	$(document).ready(function(){	
	  $(".btncari").click(function(){
	  var id = $(this).attr("id");
	  var tglawal = $("input#tglawal").val();
	  var tglakhir =  $("input#tglakhir").val();
	  var triger = "tampil";
	  if( tglawal == "" && tglakhir == ""){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "daftarpoproses.php",
					dataType: 'json',
					data: 'triger=' + triger + '&tglawal=' + tglawal + '&tglakhir=' + tglakhir,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('daftarpo1.php?tglawal='+ tglawal + '&tglakhir=' + tglakhir);
					},	
					error: function(){
						$('#gagalpop').show('slow');
					}
					});
				}
	    var detik = 3;	
		function hitung(){
		var to = setTimeout(hitung,1000);
		 detik --;
		 if(detik < 0){
		 clearTimeout(to);
		$("#errorpop , #gagalpop, #successpop").hide('slow');
		 }
		 }
		 hitung();
			});
		 $(".formnya").mouseup(function(){
		 return false;
		 });
		 });
	</script>	
<!--  ############################++++++++++++++++SCRIPT AJAX ADDING ================############################  -->		
<!--  ############################++++++++++++++++SCRIPT AJAX ADDING ================############################  -->	
		<script type="text/javascript">
	  $(".simpan").click(function(){
	  var triger = "tambah";
	  $.ajax({
					type: "POST",
					url: "pros.php",
					dataType: 'json',
					data: 'triger=' + triger,
					success: function(){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('timbul2.php');
					},	
					error: function(){
						$('#gagalpop').show('slow');
					}
					});
					var detik = 3;	
		function hitung(){
		var to = setTimeout(hitung,1000);
		 detik --;
		 if(detik < 0){
		 clearTimeout(to);
		$("#errorpop , #gagalpop, #successpop").hide('slow');
		 }
		 }
		 hitung();
				});	
	</script>	
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
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
        xmlhttp.open("GET","keranjang1.php?kode="+str+"&jml="+jml,true);
        xmlhttp.send();
    }
	}
	</script>
	<script>
	function showPoSup(str) {
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
        xmlhttp.open("GET","daftarposup.php?kode="+str,true);
        xmlhttp.send();
    }bacaSuplier(str);
	}
	</script>
	<!-- script ajax untuk memanggil data barang per suplier -->
</body>

</html>
