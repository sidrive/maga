<?php  
    // Lampirkan db dan User
    require_once "koneksi.php";
    require_once "user.php";

    // Buat object user
    $user = new User($db);

    // Logout! hapus session user
    $user->logout();

    // Redirect ke login
    header('location: login.php');
 ?>