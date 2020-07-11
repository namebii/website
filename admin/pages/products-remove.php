<?php
include './core/products-core.php';
include './widget/path.php';
if(!isset($_GET['id']) || !$_GET['id'])
{
    header('location: index.php?click=products');
}
$obj_prod = new product();

$id = $_GET['id'];  
if (isset($_GET['id'])) {      
    $array = [
        $_POST['id_view'], $_POST['id_categories'], $_POST['id_supplier'], $_POST['id_brand'], $_POST['name'], $path_prod, $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'], $_POST['description'], $_POST['detail'], $path_detail,$_POST['status'],$date_create
    ];    
    // unlink();

    $obj_prod->setquery("DELETE FROM `product` WHERE `id` = $id")->prod_action($array);
    
}