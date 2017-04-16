<?php require_once("koneksi.php");
    require_once "user.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if(!$user->isLoggedIn()){
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser(); ?>
	
<?php
    
    //menangkap parameter yang dikirimkan dari detail.php
    $id = $_POST['id'];
	$id_po = $_POST['id_po'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
	$total = $jumlah*$harga;

    //perintah untuk melakukan update
    //melakukan update data berdasarkan ID
    $sql = "UPDATE detail_po SET jml_brg = $jumlah, total = $total WHERE id=$id";
	
	
    if ($connect_db->query($sql) === TRUE) {
        //jika  berhasil tampil ini
		$sql1 = "SELECT SUM(total) as total_harga FROM detail_po WHERE id_po='$id_po'";
		$result = $connect_db->query($sql1);
		foreach ($result as $baris) { 
		$sub_total = $baris['total_harga'];
			$sql2 = "UPDATE po SET total = $sub_total WHERE id_po='$id_po'";
			$connect_db->query($sql2);
		}
        echo "Data Berhasil Diubah"."</br>";
        //echo "<a href='edit_po.php'>Kembali Ke Halaman Depan</a>";
		header ("location:".'edit_po.php?id='.$id_po);
    } else {
        // jika gagal tampil ini
        echo "Gagal Melakukan Perubahan: " . $connect_db->error;
    }



    $connect_db->close();
?>