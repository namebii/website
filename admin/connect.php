<?php 
// include 'libs/functions.php';
// if (!islogin()) {
//     header('location: login.php');
// }
  $conn = new PDO('mysql:host=127.0.0.1;dbname=Database Taki', 'root', '123456789', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $conn->query('set names utf8');
  $target_dir_user = './images/users/'; //Thư mục lưu file avatar user
  $target_dir_prod = './images/products/'; //Thư mục lưu file hình ảnh product
?>