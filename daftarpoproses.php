<?php
include"koneksi.php";
$triger=$_POST['triger'];

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

if($triger == 'tampil'){
$tglawal=$_POST['tglawal'];
$tglakhir=$_POST['tglakhir'];
$res=$connect_db->query("SELECT * FROM po WHERE status_suplier = 'N' AND tgl_po BETWEEN '$tglawal' AND '$tglakhir'");

if($res){
echo json_encode(array());
}
}

if($triger == 'tampilsuplier'){
$tglawal=$_POST['tglawal'];
$tglakhir=$_POST['tglakhir'];
$res=$connect_db->query("SELECT * FROM po WHERE status_maga = 'N' AND tgl_po BETWEEN '$tglawal' AND '$tglakhir'");

if($res){
echo json_encode(array());
}
}

if($triger == 'tampilkirim'){
$tglawal=$_POST['tglawal'];
$tglakhir=$_POST['tglakhir'];
$res=$connect_db->query("SELECT * FROM po WHERE status_maga = 'Y' AND status_suplier = 'Y' AND status_kirim = 'Y' AND tgl_po BETWEEN '$tglawal' AND '$tglakhir'");

if($res){
echo json_encode(array());
}
}

if($triger == 'tampilpenawaran'){
$tglawal=$_POST['tglawal'];
$tglakhir=$_POST['tglakhir'];
$res=$connect_db->query("SELECT * FROM penawaran WHERE tgl_penawaran BETWEEN '$tglawal' AND '$tglakhir'");

if($res){
echo json_encode(array());
}
}

?>