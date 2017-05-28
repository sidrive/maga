<?php 
	require_once("koneksi.php");
    require_once "User.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if(!$user->isLoggedIn()){
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser(); ?>
	
<!DOCTYPE html>
<html>
<head>

</head>

<body>

<?php

$id = $_GET['kode'];
$title = "Maga Swalayan - Penawaran -";
$message = "Penawaran Barang Anda Telah Disetujui Oleh Maga Swalayan";
		 	
	$query2 = "UPDATE penawaran SET status_maga = 'Y' where id_penawaran='$id'";
			$result2 = mysqli_query($connect_db, $query2);
	// periska query apakah ada error
  if(!$result2){
      die ("Query gagal dijalankan: ".mysqli_errno($connect_db).
           " - ".mysqli_error($connect_db));
  }

	$query 	= mysqli_query($connect_db, "SELECT kode_sup FROM penawaran WHERE id_penawaran = '$id'");
	$d 		= mysqli_fetch_assoc($query);
	$sup	= $d['kode_sup'];
	 /* Mengirim Notifikasi */  header("location:sendSinglePush.php?sup=$sup&title=$title&message=$message");
        ?>
</body>
</html>