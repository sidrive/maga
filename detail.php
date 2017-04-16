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
    

    if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = "SELECT * FROM detail_po WHERE id = $id";
        $result = $connect_db->query($sql); 
		foreach ($result as $baris) { ?>

        <form action="update.php" method="post">
		<input type="hidden" name="id" value="<?php echo $baris['id']; ?>">
            <input type="hidden" name="id_po" value="<?php echo $baris['id_po']; ?>">
			<input type="hidden" name="harga" value="<?php echo $baris['hrg_sup']; ?>">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" value="<?php echo $baris['nama_brg']; ?>">
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number_format" class="form-control" name="jumlah" value="<?php echo $baris['jml_brg']; ?>">
            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form>
        <form action="hapus.php" method="post">
		<input type="hidden" name="id" value="<?php echo $baris['id']; ?>">
		 <input type="hidden" name="id_po" value="<?php echo $baris['id_po']; ?>">
		 <input type="hidden" name="harga" value="<?php echo $baris['hrg_sup']; ?>">
		 <input type="hidden" name="jumlah" value="<?php echo $baris['jml_brg']; ?>">
		<button class="btn btn-primary" type="submit">Hapus</button>
		</form>
	<?php  }}
   $connect_db->close();
?>