<?php
session_destroy();
setcookie('login',false,time()-1);
setcookie('name','',time()-1);
setcookie('avatar','Chưa có Avatar',time()-1);
header('location: login.php');
?>