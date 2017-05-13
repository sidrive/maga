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
					<?php include"koneksi.php";	
					$data=$connect_db->query("select * from brg where KODE_BRG = '$_GET[kode]'"); 
					$row=$data->fetch_array();?>
					<input type="text" name="nama" value="<?php echo $row['NAMA_BRG']; ?>" class="form-control formnya" id="boxnama" />
					<input type="text" name="harga" value="<?php  $harga = number_format($row['HRG_KONSUMEN'],2,",",".") ; echo $harga; ?>" class="form-control formnya" id="boxharga" />
					<?php
					
					$angka = str_replace(".","",$harga);
					if ($angka)
					{
						echo ucwords(Terbilang($angka));
						echo "Rupiah";
					}
					?>
					<?php

function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
 
 
}

?>
	
	
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
	  var triger = "editposup";
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
						$('.timbul').load('timbuleditposup.php?kode='+kode);
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