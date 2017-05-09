<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script>
    	$(document).ready(function() {
    		$('#tabeldata').DataTable();
		});	
	</script>
	
				<div class="col-lg-12 hilang" id="hilang">
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
		   require_once('koneksi.php');
		   $sup = $_GET['kode'];
		   $data=$connect_db->query("select * from brg WHERE SUP = $sup AND (BLAKHR <= '2017-03-30' AND BLAKHR >= '2017-03-01') AND (JML_BARANG <=5) AND (AWAL >=1 ) 
							AND (JLAKHR >= '2017-03-01') ORDER BY JML_BARANG Desc");
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
