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
   
	$queryTotalPo = "SELECT sum(total) as total_po from detail_po WHERE id_po = '$id'";
	$resultTotalPo = mysqli_query($connect_db, $queryTotalPo);
	$rowTotal = mysqli_fetch_assoc($resultTotalPo);
	  $totalPo = $rowTotal['total_po'];
	  	  echo $id;
		  echo $totalPo;
	  $updatepo = "UPDATE po SET total = $totalPo, status_maga = 'Y' WHERE id_po = '$id'";
					$resultSimpanPo = mysqli_query($connect_db, $updatepo);
					
		$query = mysqli_query($connect_db, "SELECT kode_sup from po WHERE id_po = '$id'");
		$d = mysqli_fetch_assoc($query);
		$sup = $d['kode_sup'];
		$title = "Maga Swalayan - Edit PO -";
		$message = "PO $id telah di edit oleh Maga Swalayan, silahkan konfirmasi..!!";
	 /* Mengalihkan ke index.php */  header("location:sendSinglePush.php?sup=$sup&title=$title&message=$message"); 
        ?>
</body>
</html>