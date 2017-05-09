<?php  
    // Lampirkan db dan User
    require_once "koneksi.php";
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
  <title>Maga Swalayan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap2.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>
</head>
<body>
<header>
<div class="container">
<div class="row">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img alt="logo" src="img/logo12.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Daftar PO<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">PO Baru</a></li>
            <li><a href="#">PO apa</a></li>
            <li><a href="#">PO Selesai</a></li>
          </ul>
        </li>
        <li><a href="#">Penawaran</a></li>
        <li><a href="#">Admin</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>
</div>
</header>
	<div class="container"> 
	<a id="btnsup1" class="btn btn-info btnsup1">Sup1</a>
	<a id="btnsup2" class="btn btn-info btnsup2">Sup2</a>
	<a id="btnsup3" class="btn btn-info btnsup3">Sup3</a>
	<a id="btnsup4" class="btn btn-info btnsup4">Sup4</a>
	<a id="btnsup5" class="btn btn-info brnsup5">Sup5</a>
	</div>
<div class="container">
	<div class="row timbul">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">TABEL DATA BARANG</div>
					<div class="panel-body">
					<div class="table-responsive">
		<table width="100%" class="table table-striped table-bordered" id="tabeldata" >
        <thead>
            <tr>
                <th width="30px" class="text-center">No</th>
				<th class="text-center">Nama Suplier</th>
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
		   
$data=$connect_db->query("select * from brg WHERE SUP = '0149' AND (BLAKHR <= '2017-03-30' AND BLAKHR >= '2017-03-01') AND (JML_BARANG <=5) AND (AWAL >=1 ) AND (JLAKHR >= '2017-03-01')");
$no=1;
while($d=$data->fetch_array()){ 
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
				<td><span id="editkodebrg<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php $sup=$d['SUP'];
				$data1=$connect_db->query("select NAMA_SUP from sup where KODE_SUP = $sup") ; 
				$d1=$data1->fetch_array();
				echo $d1['NAMA_SUP']?></span></td>
                <td>
				<span id="editkodebrg<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[KODE_BRG]"; ?></span>
                <input type="text" name="kodebrg" value="<?php echo "$d[KODE_BRG]"; ?>" class="form-control formnya" id="boxkodebrg<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				<input type="text" name="kodesup" value="<?php echo "$_GET[kode]"; ?>" class="form-control formnya" id="boxkodesup<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editbarcode<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[BARCODE]"; ?></span>
				<input type="text" name="barcode" value="<?php echo "$d[BARCODE]"; ?>" class="form-control formnya" id="boxbarcode<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editnamabrg<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[NAMA_BRG]"; ?></span>
				<input type="text" name="namabrg" value="<?php echo "$d[NAMA_BRG]"; ?>" class="form-control formnya" id="boxnamabrg<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editharga<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo number_format($d['HRG_SUP'],2,",",".");; ?></span>	
				<input readonly type="text" name="harga" value="<?php echo "$d[HRG_SUP]"; ?>" class="form-control formnya" id="boxharga<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editjumlah<?php echo "$d[KODE_BRG]"; ?>" class="textnya"><?php echo "$d[JML_BARANG]"; ?></span>
				<input type="text" name="jumlah" value="<?php echo "$d[JML_BARANG]"; ?>" class="form-control formnya" id="boxjumlah<?php echo "$d[KODE_BRG]"; ?>" style="display:none;"/>
				</td>
				<td>
				
				<a id="btninput" class="btn btn-success editrow erow" onclick="window.location='inputpofix.php?kode=<?php echo $d['SUP']?>'">Tambah</a>
				<a id="<?php echo "$d[KODE_BRG]"; ?>" class="btn btn-danger updaterow urow<?php echo "$d[KODE_BRG]"; ?>" style="display:none;">Simpan</a>
						<div class="alert bg-warning crow<?php echo "$d[KODE_BRG]"; ?>" role="alert" style="display:none;">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> HAPUS DATA !!!
					<br /><center><button id="<?php echo "$d[KODE_BRG]"; ?>" class="btn btn-danger hapus">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="tidak" class="btn btn-primary">Tidak</button></center>
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
							<div id="myModal" class="modal fade" role="dialog">
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

	<script type="text/javascript">
	$(document).ready(function(){	
	  $(".btnsup1").click(function(){
	  var id = $(this).attr("id");
	  var kodesup = "0070";
	  if( kodesup == ""){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "indexproses.php",
					dataType: 'json',
					data: 'kodesup=' + kodesup,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('barangsup.php?kode='+ kodesup);
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
	
	<script type="text/javascript">
	$(document).ready(function(){	
	  $(".btnsup2").click(function(){
	  var id = $(this).attr("id");
	  var kodesup = "0149";
	  if( kodesup == ""){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "indexproses.php",
					dataType: 'json',
					data: 'kodesup=' + kodesup,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('barangsup.php?kode='+ kodesup);
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
	
	<script type="text/javascript">
	$(document).ready(function(){	
	  $(".btnsup3").click(function(){
	  var id = $(this).attr("id");
	  var kodesup = "0076";
	  if( kodesup == ""){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "indexproses.php",
					dataType: 'json',
					data: 'kodesup=' + kodesup,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('barangsup.php?kode='+ kodesup);
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
	
	<script type="text/javascript">
	$(document).ready(function(){	
	  $(".btnsup4").click(function(){
	  var id = $(this).attr("id");
	  var kodesup = "0105";
	  if( kodesup == ""){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "indexproses.php",
					dataType: 'json',
					data: 'kodesup=' + kodesup,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('barangsup.php?kode='+ kodesup);
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







    </body>
</html> 