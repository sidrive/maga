<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script>
    	$(document).ready(function() {
    		$('#tabeldata').DataTable();
		});	
    </script>	
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
$data=$mysqli->query("select * from data_test  order by data_id desc");
$no=1;
while($d=$data->fetch_array()){ 
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
                <td>
				<span id="editnama<?php echo "$d[data_id]"; ?>" class="textnya"><?php echo "$d[data_name]"; ?></span>
                <input type="text" name="nama" value="<?php echo "$d[data_name]"; ?>" class="form-control formnya" id="boxnama<?php echo "$d[data_id]"; ?>" style="display:none;"/>
				</td>
                <td>
				<span id="editjkl<?php echo "$d[data_id]"; ?>" class="textnya"><?php echo "$d[data_jkl]"; ?></span>	
				<select name="jkl" id="boxjkl<?php echo "$d[data_id]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['data_jkl'])){ ?><option value=""></option><?php } ?>
				<option value="Pria" <?php if($d['data_jkl'] == 'Pria'){ echo"selected"; } ?>>Pria</option>
				<option value="Wanita" <?php if($d['data_jkl'] == 'Wanita'){ echo"selected"; } ?>>Wanita</option>
				</select>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[data_id]"; ?>" class="textnya"><?php echo "$d[data_alamat]"; ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[data_id]"; ?>" style="display:none;"><?php echo "$d[data_alamat]"; ?></textarea>
				</td>
                <td>
				<span id="editstatus<?php echo "$d[data_id]"; ?>" class="textnya"><?php echo "$d[data_status]"; ?></span>	
				<select name="status" id="boxstatus<?php echo "$d[data_id]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['data_status'])){ ?><option value=""></option><?php } ?>
				<option value="Kawin" <?php if($d['data_status'] == 'Kawin'){ echo"selected"; } ?>>Kawin</option>
				<option value="Tidak Kawin" <?php if($d['data_status'] == 'Tidak Kawin'){ echo"selected"; } ?>>Tidak Kawin</option>
				</select>
				</td>
                <td>
				<button data-id="<?php echo "$d[data_id]"; ?>" type="button" class="btn btn-info modaledit erow" data-toggle="modal" data-target="#myModal">Edit</button>
				<a id="<?php echo "$d[data_id]"; ?>" class="btn btn-success editrow erow<?php echo "$d[data_id]"; ?>">Edit</a>
				<a id="<?php echo "$d[data_id]"; ?>" class="btn btn-success updaterow urow<?php echo "$d[data_id]"; ?>" style="display:none;">Update</a>
						<div class="alert bg-warning crow<?php echo "$d[data_id]"; ?>" role="alert" style="display:none;">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> HAPUS DATA !!!
					<br /><center><button id="<?php echo "$d[data_id]"; ?>" class="btn btn-danger hapus">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="tidak" class="btn btn-primary">Tidak</button></center>
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
<!--  ############################++++++++++++++++SCRIPT AJAX DELETING ================############################  -->		
<!--  ############################++++++++++++++++SCRIPT AJAX DELETING ================############################  -->		
	<script type="text/javascript">
	$(document).ready(function(){	
	  $(".deleterow").click(function(){
	  var id = $(this).attr("id");
	  $(".erow"+id).hide('slow');
	  $(".drow"+id).hide('slow');
	  $(".crow"+id).show('slow');
	  });
	  $("#tidak").click(function(){			
			$(".alert").hide('slow');	
			$(".deleterow").show('slow');	
			});
	  $(".hapus").click(function(){
	  var id = $(this).attr("id");
	  var triger = "del";
	                $.ajax({
					type: "POST",
					url: "pros.php",
					data: 'id=' + id + '&triger=' + triger,
					success: function(html){
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
		 $(document).mouseup(function(){
		 $(".formnya, .updaterow, .alert").hide('slow');
		 $(".textnya, .editrow, .deleterow").show('slow');
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