<?php 
include 'core/product-core.php';
$post = loaddata('data/product.txt');
if(!isset($_GET['sku'])||  !$_GET['sku'])
{
    header('location: index.php?click=product');
}
// Tiến hành cập nhật dữ liệu
if(isset($_POST['sku']))
{
    xoa($_POST['sku'],$post);
    $post = writedata('data/product.txt',$post);
    header('location: index.php?click=product');
}
?>