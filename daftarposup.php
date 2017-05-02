<?php 
	require_once("koneksi.php");
?>
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
		   
$data=$connect_db->query("select * from detail_po_sem where id_po = 'FBMG020517-1124'");
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
				<span id="editstatus<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo number_format($d['hrg_sup'],2,",",".");; ?></span>	
				<select name="status" id="boxstatus<?php echo "$d[id_po]"; ?>" style="display:none;" class="form-control formnya">
				<?php if(empty($d['hrg_sup'])){ ?><option value=""></option><?php } ?>
				<option value="Kawin" <?php if($d['hrg_sup'] == 'Kawin'){ echo"selected"; } ?>>Kawin</option>
				<option value="Tidak Kawin" <?php if($d['hrg_sup'] == 'Tidak Kawin'){ echo"selected"; } ?>>Tidak Kawin</option>
				</select>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo "$d[jml_brg]"; ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[id_po]"; ?>" style="display:none;"><?php echo "$d[jml_brg]"; ?></textarea>
				</td>
				<td>
				<span id="editalamat<?php echo "$d[id_po]"; ?>" class="textnya"><?php echo number_format($d['total'],2,",","."); ?></span>
				<textarea name="alamat" cols="30" rows="10" class="form-control formnya" id="boxalamat<?php echo "$d[id_po]"; ?>" style="display:none;"><?php echo "$d[total]"; ?></textarea>
				</td>
                <td>
				<button data-id="<?php echo "$d[kode_brg]"; ?>" type="button" class="btn btn-info modaledit erow" data-toggle="modal" data-target="#myModal">Edit</button>
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
					</div>
					</div>
					
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
						
