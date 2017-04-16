<?php
include 'koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$login    = mysqli_query($connect, "select * from user_maga where username='$username' and password='$password'");
$result   = mysqli_num_rows($login);
if($result>0){
    $user = mysqli_fetch_array($login);
    session_start();
    $_SESSION['username'] = $user['username'];
    header("location:welcome.php");
}else{
    header("location:login.php");
}