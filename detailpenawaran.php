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
        <li class="active"><a href="index.php">Home</a></li>
		 <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Input PO<span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="inputpofix1.php?kode=0">Input PO</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Daftar PO<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="daftarpo.php">PO Baru</a></li>
            <li><a href="daftarpoterkirim.php">PO Selesai</a></li>
          </ul>
        </li>
        <li><a href="daftarpenawaran.php">Penawaran</a></li>
        <li><a href="#">Admin</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>
</div>
</header>
	<!--end: Header-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-1 main">			
		
		<div class="row timbul">
			<div class="col-lg-12 hilang">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
					<div class="table-responsive">
		<table width="100%" class="table table-striped table-bordered" id="tabeldata" >
        <thead>
            <tr>
                <th width="30px" class="text-center">No</th>
                <th class="text-center">ID Penawaran</th>
                <th class="text-center">Barcode</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Harga Satuan</th>
				<th class="text-center">Foto</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
           <?php
		   
$data=$connect_db->query("select * from detail_penawaran where id_penawaran = '$_GET[kode]'");
$no=1;
while($d=$data->fetch_array()){ 
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
                <td>
				<span id="editkodebrg<?php echo "$d[id]"; ?>" class="textnya"><?php echo "$d[id_penawaran]"; ?></span>
                <input type="text" name="nama" value="<?php echo "$_GET[kode]"; ?>" class="form-control formnya" id="boxkodebrg<?php echo "$d[kode_brg]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editjkl<?php echo "$d[id]"; ?>" class="textnya"><?php echo "$d[barcode]"; ?></span>	
				</td>
				<td>
				<span id="editalamat<?php echo "$d[id]"; ?>" class="textnya"><?php echo "$d[nama_brg]"; ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[id_po]"; ?>" style="display:none;"><?php echo "$d[nama_brg]"; ?></textarea>
				</td>
                <td>
				<span id="editharga<?php echo "$d[id]"; ?>" class="textnya"><?php echo number_format($d['harga_brg'],2,",",".");; ?></span>	
				<input readonly type="text" name="harga" value="<?php echo "$d[hrg_sup]"; ?>" class="form-control formnya" id="boxharga<?php echo "$d[kode_brg]"; ?>" style="display:none;"/>
				</td>
				<td align="center">
				<span id="editjumlah<?php echo "$d[kode_brg]"; ?>" class="textnya"><img src="http://nurmuha.hostzi.com/maga1/img/<?php echo "$d[foto]"; ?>" class="img-responsive img-thumbnail" width="100" > </span>
				<input type="text" name="jumlah" value="<?php echo "$d[jml_brg]"; ?>" class="form-control formnya" id="boxjumlah<?php echo "$d[kode_brg]"; ?>" style="display:none;"/>
				</td>
				<td> <?php $cek = mysqli_query($connect_db,"SELECT status_maga FROM penawaran WHERE id_penawaran = '$_GET[kode]'");
				$da = mysqli_fetch_assoc($cek); 
				if($da['status_maga']== "N") {?>
				<a id="btninput" class="btn btn-success editrow erow" onclick="window.location='simpanpenawaran.php?kode=<?php echo $d['id_penawaran']?>'">Setuju</a>
				<?php }else{}?>
					<div class="alert bg-warning crow<?php echo "$d[kode_brg]"; ?>" role="alert" style="display:none;">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> HAPUS DATA !!!
					<br /><center><button id="<?php echo "$d[kode_brg]"; ?>" class="btn btn-danger hapus">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="tidak" class="btn btn-primary">Tidak</button></center>
				</td>
            </tr>			
<?php
$no++; }
$row=$connect_db->query("select sum(total) as totalPo from detail_po where id_po = '$_GET[kode]' ");
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
					url: "editpopopup.php",
					data: 'id=' + id,
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
	  $("#myModal").hide('slow');
	  $(".erow"+id).hide('slow');
	  $(".urow"+id).show('slow');
	  $(".hapus"+id).show('slow');
	  $("#editjumlah"+id).hide('slow');
	  $("#boxjumlah"+id).show('slow');
	  $("#editharga"+id).hide('slow');
	  $("#boxharga"+id).show('slow');
	    });
	  $(".updaterow").click(function(){
	  var id = $(this).attr("id");
	  var jumlah = $("input#boxjumlah"+id).val();
	  var harga = $("input#boxharga"+id).val();
	  var kode = $("input#boxkodebrg"+id).val();
	  var triger = "edit";
	  var btnaksi = "update";
	  if( jumlah == "" ){
	  $('#errorpop').show('slow');
	  }else{
	                $.ajax({
					type: "POST",
					url: "editpoupdate.php",
					dataType: 'json',
					data: 'id=' + id + '&jumlah=' + jumlah + '&harga=' + harga + '&triger=' + triger + '&btnaksi=' + btnaksi,
					success: function(html){
						$('#successpop').show('slow');
						$('.hilang').hide('slow');
						$('.timbul').load('timbul2.php?kode='+kode);
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
</body>

</html>
