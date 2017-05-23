<?php
include"koneksi.php";
$triger=$_POST['triger'];
$button=$_POST['btnaksi'];

if($triger == 'edit2' && $button == 'Update Data'){
$id=$_POST['id'];
$idpo=$_POST['id_po'];
$jumlah=$_POST['jmlbrg'];
$harga=$_POST['hargabrg'];
$totalpo = $harga * $jumlah;
echo $id;
echo $jumlah;
echo $harga;
echo $totalpo;
echo $triger;


$res=$connect_db->query("UPDATE detail_po_sem SET jml_brg=$jumlah, total=$totalpo WHERE kode_brg=$id");

if($res){
header("location:editpo.php?kode=$idpo");
}
}

if($triger == 'edit2' && $button == 'Hapus Data'){
$id=$_POST['id'];

$res=$connect_db->query("DELETE from detail_po_sem WHERE kode_brg=$id");

if($res){
header("location:editpo.php?kode=$idpo");
}
}

if($triger == 'del'){
$id=$_POST['id'];
$connect_db->query("delete from user where user_id='$id' ");
}

if($triger == 'tambah'){
$res=$connect_db->query("insert into data_test (data_id) values('')");
if($res){
echo json_encode(array());
}
}

if($triger == 'edit'){
$id=$_POST['id'];
$barcode=$_POST['barcode'];
$namabrg=$_POST['namabrg'];
$jumlah=$_POST['jumlah'];
$harga=$_POST['harga'];
$totalpo = $harga * $jumlah;
$idpo = 'FBMG'.date('dmy').'-'.$_POST['kodesup'];
$edit = date('Y-m-d');
	$cek=$connect_db->query("SELECT * FROM detail_po_sem WHERE kode_brg = '$id' ");
	$d=$cek->fetch_array();
	if(!empty($d['kode_brg'])){
		
		$res=$connect_db->query("UPDATE detail_po_sem SET jml_brg=$jumlah, total=$totalpo1 WHERE kode_brg=$id");
		
	} else {
		
		$res=$connect_db->query("INSERT INTO detail_po_sem (id_po, kode_brg, barcode, nama_brg, hrg_sup, jml_brg, total, tgl_edit)
					VALUES ('$idpo', '$id', '$barcode', '$namabrg', $harga, $jumlah, $totalpo, '$edit')");
	}

if($res){
echo json_encode(array());
}
}

?>