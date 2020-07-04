<?php 
include 'core/products-core.php';
$post = loaddata('data/product.txt');
if(!isset($_GET['sku'])||  !$_GET['sku'])
{
    header('location: index.php?click=products');
}
// Tiến hành cập nhật dữ liệu
if(isset($_GET['sku']))
{
    remove_product($_GET['sku'],$post);
    $post = writedata('data/product.txt',$post);
    header('location: index.php?click=products');
}
?>