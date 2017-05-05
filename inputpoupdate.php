<?php
include"koneksi.php";
$triger=$_POST['triger'];
$button=$_POST['btnaksi'];
$kode=$_POST['kodesup'];

if($triger == 'edit2' && $button == 'Update Data'){
$kodebrg=$_POST['id'];
$id = 'FBMG'.date('dmy').'-'.$_POST['kodesup'];
$barcode=$_POST['barcode'];
$namabrg=$_POST['namabrg'];
$jumlah=$_POST['jmlbrg'];
$harga=$_POST['hargabrg'];
$totalpo = $harga * $jumlah;
$edit = date('Y-m-d');
echo $id;
echo $jumlah;
echo $harga;
echo $totalpo;
echo $triger;


$res=$connect_db->query("INSERT INTO detail_po_sem (id_po, kode_brg, barcode, nama_brg, hrg_sup, jml_brg, total, tgl_edit)
					VALUES ('$id', '$kodebrg', '$barcode', '$namabrg', $harga, $jumlah, $totalpo, '$edit')");

if($res){
header("location:inputpofix.php?kode=$kode");
}
}

if($triger == 'edit2' && $button == 'Hapus Data'){
$id=$_POST['id'];

$res=$connect_db->query("DELETE from detail_po_sem WHERE kode_brg=$id");

if($res){
header("location:daftarpopo.php");
}
}
/*
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
$nama=$_POST['nama'];
$jekel=$_POST['jekel'];
$alamat=$_POST['alamat'];
$status=$_POST['status'];

$res=$connect_db->query("update data_test set data_name='$nama',data_jkl='$jekel',data_alamat='$alamat',data_status='$status' where data_id='$id' ");

if($res){
echo json_encode(array());
}
}
*/
?>