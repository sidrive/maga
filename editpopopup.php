						<div class="col-md-12">
							            <?php 
										include"koneksi.php";
										$data=$connect_db->query("select * from detail_po_sem  where kode_brg='$_POST[id]' ");
										//$data=$connect_db->query("select * from detail_po_sem  where id_po='FBMG020517-1124' ");
										
										$no=1;
										while($d=$data->fetch_array()){ 
										?>
								<form class="form-horizontal" action="editpoupdate.php" method="post">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Kode Barang</label>
									<div class="col-md-9">
									<input readonly id="kodebrg" name="kodebrg" type="text" value="<?php echo $d['kode_brg']; ?>" class="form-control">
									</div>
								</div>
								<input type="hidden" name="id" value="<?php echo $d['kode_brg']; ?>" />
								<input type="hidden" name="triger" value="edit2" />
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Barcode</label>
									<div class="col-md-9">
									<input readonly id="barcode" name="barcode" type="text" value="<?php echo $d['barcode']; ?>" class="form-control">
									</div>
								</div>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Barang</label>
									<div class="col-md-9">
									<input readonly id="namabrg" name="namabrg" type="text" value="<?php echo $d['nama_brg']; ?>" class="form-control">
									</div>
								</div>	
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Harga Barang</label>
									<div class="col-md-9">
									<input readonly id="hargabrg" name="hargabrg" type="number_format" value="<?php echo $d['hrg_sup']; ?>" class="form-control">
									</div>
								</div>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label">Jumlah</label>
									<div class="col-md-9">
									<input id="jmlbrg" name="jmlbrg" type="number_format" value="<?php echo $d['jml_brg']; ?>" class="form-control">
									</div>
								</div>
									
								<div class="col-md-12 widget-right">
										<input id="btnaksi" name="btnaksi" type="submit" class="btn btn-primary btn-md pull-right" value="Update Data">
										<input id="btnaksi" name="btnaksi" type="submit" class="btn btn-danger hapus" value="Hapus Data">
									</div>
								<!-- Form actions -->
							</fieldset>
						</form>
						<?php } ?>
							</div>