<?php 
include 'core/users-core.php';
$ar_acc = loaddata('data/account.txt');
if(!isset($_GET['userid'])||  !$_GET['userid'])
{
    header('location: index.php?click=users');
}
// Tiến hành cập nhật dữ liệu
if(isset($_GET['userid']))
{
    remove($_GET['userid'],$ar_acc);
    $ar_acc = writedata('data/account.txt',$ar_acc);
    header('location: index.php?click=users');
}
?>