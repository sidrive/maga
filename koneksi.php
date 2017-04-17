<?php
 
$user_name = "root";
$password = "";
$database = "maga";
$host_name = "localhost"; 
 
$connect_db=mysqli_connect($host_name, $user_name, $password, $database);
 
/*$find_db=mysqli_select_db($database);
 
if ($find_db) {
 
 echo "Database  Ada";
 
}else {
 
 echo "Database Tidak Ada";
 
}*/
try {
        // Buat Object PDO baru dan simpan ke variable $db
        $db = new PDO("mysql:host={$host_name};dbname={$database}", $user_name, $password);
        // Mengatur Error Mode di PDO untuk segera menampilkan exception ketika ada kesalahan
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }
 
?>