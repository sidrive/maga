<?php 
	require_once("koneksi.php");
    require_once "user.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if(!$user->isLoggedIn()){
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser();
	
	include_once("header.php");?>

	
   
   
    <div class="container">
      <div class="row"> 
        <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Deskripsi Barang</th>
			<th>Deskripsi Barang</th>
			<th>Deskripsi Barang</th>
			<th>Deskripsi Barang</th>
            <th>Opsi</th>
          </tr>
          <?php
           
            //Melakukan query
			$sql = "SELECT * FROM detail_po where id_po = '$_GET[id]'";
            $hasil = $connect_db->query($sql);
            $no = 1;
            if ($hasil->num_rows > 0) {
                foreach ($hasil as $row) { ?>
                  <tr>     
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['id_po']; ?></td>
                  <td><?php echo $row['kode_brg']; ?></td>
				  <td><?php echo $row['nama_brg']; ?></td>
				  <td><?php echo $row['hrg_sup']; ?></td>
				  <td><?php echo $row['jml_brg']; ?></td>
                  <td><?php echo "<a href='#myModal' class='btn btn-default btn-small' id='custId' data-toggle='modal' data-id=".$row['id'].">Detail</a> "; ?></td>
				  </tr>
            <?php 
            $no++; 
            } 
              } else { 
            echo "0 results"; 
              } $connect_db->close(); 
            ?>

        </table>
      </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php include_once ("footer.php"); ?>