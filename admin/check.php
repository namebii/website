<?php
include 'libs/functions.php'; // Check Login

if (!islogin()) {
    header('location: login.php');
}

try {    
    include './connect.php';
    $sql_user = 'select * from user';  
    $rs = $conn->query($sql_user);
    $result = $rs->fetchAll(PDO::FETCH_OBJ);  
  } catch (PDOException $errors) {
    exit('Kết nối dữ liệu thất bại: ' . $errors->getMessage());
  }

function getRole()
{
    global $result;
    foreach($result as $user){
        if ($_SESSION['user'] == $user->username) {
            return trim($user->role);
        }
    }
}
