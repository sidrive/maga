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
					<div class="panel-heading"></div>
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
				<th class="text-center">Sub Total</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
           <?php
		   include"koneksi.php";	
$data=$connect_db->query("select * from detail_po_sem where id_po = '$_GET[kode]'");
$no=1;
while($d=$data->fetch_array()){ 
?>
<input type="hidden"  id="editriger" value="edit"/>
            <tr>
                <td><?php echo $no ?></td>
                <td>
				<span id="editkodebrg<?php echo "$d[kode_brg]"; ?>" class="textnya"><?php echo "$d[kode_brg]"; ?></span>
                <input type="text" name="nama" value="<?php echo "$_GET[kode]"; ?>" class="form-control formnya" id="boxkodebrg<?php echo "$d[kode_brg]"; ?>" style="display:none;"/>
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
				<span id="editharga<?php echo "$d[kode_brg]"; ?>" class="textnya"><?php echo number_format($d['hrg_sup'],2,",",".");; ?></span>	
				<input readonly type="text" name="harga" value="<?php echo "$d[hrg_sup]"; ?>" class="form-control formnya" id="boxharga<?php echo "$d[kode_brg]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editjumlah<?php echo "$d[kode_brg]"; ?>" class="textnya"><?php echo "$d[jml_brg]"; ?></span>
				<input type="text" name="jumlah" value="<?php echo "$d[jml_brg]"; ?>" class="form-control formnya" id="boxjumlah<?php echo "$d[kode_brg]"; ?>" style="display:none;"/>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo number_format($d['total'],2,",","."); ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[id_po]"; ?>" style="display:none;"><?php echo "$d[total]"; ?></textarea>
				</td>
                <td>
				<button data-id="<?php echo "$d[kode_brg]"; ?>" type="button" class="btn btn-info modaledit erow" data-toggle="modal" data-target="#myModal">Edit</button>
				<a id="<?php echo "$d[kode_brg]"; ?>" class="btn btn-success editrow erow<?php echo "$d[kode_brg]"; ?>">Edit</a>
				<a id="<?php echo "$d[kode_brg]"; ?>" class="btn btn-success updaterow urow<?php echo "$d[kode_brg]"; ?>" style="display:none;">Update</a>
						<div class="alert bg-warning crow<?php echo "$d[kode_brg]"; ?>" role="alert" style="display:none;">
					<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> HAPUS DATA !!!
					<br /><center><button id="<?php echo "$d[kode_brg]"; ?>" class="btn btn-danger hapus">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="tidak" class="btn btn-primary">Tidak</button></center>
				</td>
            </tr>			
<?php
$no++; }
$row=$connect_db->query("select sum(total) as totalPo from detail_po_sem ");
$r=$row->fetch_assoc();
$totalPo = $r['totalPo'];
?>		
        </tbody>
		<tr style="background-color: #DDD;"><td colspan="5" align="right"></td><td colspan="1" align="right"><b>Total PO : </b></td><td align="right"><b>Rp. <?php echo number_format($totalPo,2,",",".") ?></b></td></td></td><td></td></tr>
    </table>
	<?php $sql = mysqli_query($connect_db,"SELECT * from detail_po_sem");
							$row = mysqli_fetch_assoc($sql);
							?>
	<button type="button" class="btn btn-info modaledit erow" onclick="window.location='simpanpo.php?kode=<?php echo $row['id_po']?>&sup=<?php echo substr($row['id_po'],-4) ?>';">Konfirmasi & Simpan PO</button>
					</div>
					</div>
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