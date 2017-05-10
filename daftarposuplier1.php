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
                <th class="text-center">ID PO</th>
                <th class="text-center">Suplier</th>
                <th class="text-center">Tanggal Dibuat</th>
                <th class="text-center">Total Harga PO</th>
				<th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
           <?php
		   require_once("koneksi.php");
if(isset($_GET['tglawal'])){
	$tglawal = $_GET['tglawal'];
	$tglakhir = $_GET['tglakhir'];
	echo $tglawal;
	$query = "SELECT * FROM po WHERE status_maga = 'N' AND tgl_po BETWEEN '$tglawal' AND '$tglakhir'";	
}else{
	$query = "SELECT * FROM po WHERE status_maga = 'N'";
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