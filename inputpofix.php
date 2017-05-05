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

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Maga Swalayan - Edit Data PO</title>
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
		
		<div class="row timbul">
			<div class="col-lg-12 hilang">
				<div class="panel panel-default">
					<div class="panel-heading">
						<table>					
						<form id="form_cari_suplier" action="daftarpo.php" method="get">
						<fieldset>
						<div class="form-group">
						<div class="col-md-3">
						<th>
						<select class="form-control" name="kode" style="width:200px">
						<option value="">Pilih Suplier</option>
							<?php $sql = mysqli_query($connect_db,"SELECT * FROM SUP ORDER BY NAMA_SUP ASC");
							while ($row = mysqli_fetch_array($sql)) { echo
							"<option value='"; echo $row['KODE_SUP']."'>";
							echo $row['NAMA_SUP']."</option>";
							} ?>  
						</select>
						</th>
						</div>
						</div><th><div class="col-md-2"><input id="btnaksi" name="btnaksi" type="submit" class="btn btn-primary btn-md" value="Cari"></div></th>
						</fieldset>
						</form>
						</table>
					</div>
						<div class="panel-body">
						<table width="30px" class="table table-striped table-bordered" id="tabelpo" >
							<th width="250px" class="text-center">Jumlah Barang PO</th>
							<th width="230px" class="text-center">Total Harga</th>
							<th class="text-center">Opsi</th>
							<tr>
							<td align="center"><?php $sql = mysqli_query($connect_db,"SELECT count(id_po) as jumlahpo from detail_po_sem");
							$row = mysqli_fetch_assoc($sql);
							echo $row['jumlahpo'];
							?></td>
							<td align="right"><b><?php $sql = mysqli_query($connect_db,"SELECT sum(total) as totalpo from detail_po_sem");
							$row = mysqli_fetch_assoc($sql);
							echo "Rp. ".number_format($row['totalpo'],2,",",".");
							?></b></td>
							<td><?php $sql = mysqli_query($connect_db,"SELECT * from detail_po_sem");
							$row = mysqli_fetch_assoc($sql);
							?>
							<button type="button" class="btn btn-info modaledit erow" onclick="window.location='editpo.php?kode=<?php echo $row['id_po']?>';">Edit PO</button></td>
							</tr>
						</table>
						</div>

					<div class="panel-body">
					<div class="table-responsive">
		<table width="100%" class="table table-striped table-bordered" id="tabeldata" >
        <thead>
            <tr>
                <th width="30px" class="text-center">No</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Barcode</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Harga Satuan</th>
				<th class="text-center">Jumlah</th>
				<th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
           <?php
		   
$data=$connect_db->query("select * from brg where SUP = '$_GET[kode]'");
$no=1;
while($d=$data->fetch_array()){ 
	
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
                <td>
				<span id="editnama<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[KODE_BRG]"; ?></span>
                <input type="text" name="nama" value="<?php echo "$d[KODE_BRG]"; ?>" class="form-control formnya" id="boxnama<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editjkl<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[BARCODE]"; ?></span>	
				<select name="jkl" id="boxjkl<?php echo "$d[KODE_BRG]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['BARCODE'])){ ?><option value=""></option><?php } ?>
				<option value="Pria" <?php if($d['BARCODE'] == 'Pria'){ echo"selected"; } ?>>Pria</option>
				<option value="Wanita" <?php if($d['BARCODE'] == 'Wanita'){ echo"selected"; } ?>>Wanita</option>
				</select>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[NAMA_BRG]"; ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"><?php echo "$d[NAMA_BRG]"; ?></textarea>
				</td>
                <td>
				<span id="editstatus<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo number_format($d['HRG_SUP'],2,",",".");; ?></span>	
				<select name="status" id="boxstatus<?php echo "$d[KODE_BRG]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['HRG_SUP'])){ ?><option value=""></option><?php } ?>
				<option value="Kawin" <?php if($d['HRG_SUP'] == 'Kawin'){ echo"selected"; } ?>>Kawin</option>
				<option value="Tidak Kawin" <?php if($d['HRG_SUP'] == 'Tidak Kawin'){ echo"selected"; } ?>>Tidak Kawin</option>
				</select>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[JML_BARANG]"; ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"><?php echo "$d[JML_BARANG]"; ?></textarea>
				</td>
				<td>
				<button data-id="<?php echo "$d[KODE_BRG]"; ?>" data-po="<?php echo "$_GET[kode]"; ?>" type="button" class="btn btn-info modaledit erow" data-toggle="modal" data-target="#myMod">Tambah</button>
				</td>
            </tr>			
<?php
$no++; }
$row=$connect_db->query("select sum(total) as totalPo from detail_po_sem ");
$r=$row->fetch_assoc();
$totalPo = $r['totalPo'];
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
							<h4 class="modal-title">Tambah Data PO</h4>
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
	  $(".editrow").click(function(){
	  var id = $(this).attr("id");
	  $(".erow"+id).hide('slow');
	  $(".urow"+id).show('slow');
	  $("#editnama"+id).hide('slow');
	  $("#editjkl"+id).hide('slow');
	  $("#editalamat"+id).hide('slow');
	  $("#editstatus"+id).hide('slow');
	  $("#boxnama"+id).show('slow');
	  $("#boxjkl"+id).show('slow');
	  $("#boxalamat"+id).show('slow');
	  $("#boxstatus"+id).show('slow');
	  });
	  $(".updaterow").click(function(){
	  var id = $(this).attr("id");
	  var nama = $("input#boxnama"+id).val();
	  var jekel =  $("select#boxjkl"+id).val();
	  var alamat = $("textarea#boxalamat"+id).val();
	  var status =  $("select#boxstatus"+id).val();
	  var triger = "edit";
	  if( nama == "" ){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "pros.php",
					dataType: 'json',
					data: 'id=' + id + '&nama=' + nama + '&jekel=' + jekel+ '&alamat=' + alamat + '&status=' + status + '&triger=' + triger,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('timbul2.php');
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
