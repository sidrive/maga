<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blog - Tables</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
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
	<?php  include"nav.php"; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row timbul">
			<div class="col-lg-12 hilang">
				<div class="panel panel-default">
					<div class="panel-heading"><a class="btn btn-primary simpan">Tambahkan Data</a></div>
					<div class="panel-body">
		<table width="100%" class="table table-striped table-bordered" id="tabeldata" >
        <thead>
            <tr>
                <th width="30px" class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Jenis Kelamin</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Status</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
           <?php
 include"koneksi.php";		   
$data=$connect_db->query("select * from detail_po where id_po = 'FBMG020517-1124'");
$no=1;
while($d=$data->fetch_array()){ 
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
                <td>
				<span id="editnama<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "$d[kode_brg]"; ?></span>
                <input type="text" name="nama" value="<?php echo "$d[kode_brg]"; ?>" class="form-control formnya" id="boxnama<?php echo "$d[id_po]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editjkl<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "$d[barcode]"; ?></span>	
				<select name="jkl" id="boxjkl<?php echo "$d[id_po]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['barcode'])){ ?><option value=""></option><?php } ?>
				<option value="Pria" <?php if($d['barcode'] == 'Pria'){ echo"selected"; } ?>>Pria</option>
				<option value="Wanita" <?php if($d['barcode'] == 'Wanita'){ echo"selected"; } ?>>Wanita</option>
				</select>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "$d[nama_brg]"; ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[id_po]"; ?>" style="display:none;"><?php echo "$d[nama_brg]"; ?></textarea>
				</td>
                <td>
				<span id="editstatus<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "$d[hrg_sup]"; ?></span>	
				<select name="status" id="boxstatus<?php echo "$d[id_po]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['hrg_sup'])){ ?><option value=""></option><?php } ?>
				<option value="Kawin" <?php if($d['hrg_sup'] == 'Kawin'){ echo"selected"; } ?>>Kawin</option>
				<option value="Tidak Kawin" <?php if($d['hrg_sup'] == 'Tidak Kawin'){ echo"selected"; } ?>>Tidak Kawin</option>
				</select>
				</td>
                <td>
				<button data-id="<?php echo "$d[id_po]"; ?>" type="button" class="btn btn-info modaledit erow" data-toggle="modal" data-target="#myModal">Edit</button>
				<a id="<?php echo "$d[id_po]"; ?>" class="btn btn-success editrow erow<?php echo "$d[id_po]"; ?>">Edit</a>
				<a id="<?php echo "$d[id_po]"; ?>" class="btn btn-success updaterow urow<?php echo "$d[id_po]"; ?>" style="display:none;">Update</a>
						<div class="alert bg-warning crow<?php echo "$d[id_po]"; ?>" role="alert" style="display:none;">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> HAPUS DATA !!!
					<br /><center><button id="<?php echo "$d[id_po]"; ?>" class="btn btn-danger hapus">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="tidak" class="btn btn-primary">Tidak</button></center>
				</div>
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
		</div><!--/.row-->	
							<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Editing Data</h4>
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
	<script src="js/bootstrap.min.js"></script>
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
					url: "edit.php",
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
</body>

</html>
