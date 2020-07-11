<?php
class product extends database
{
    var $rs;

    // Load danh sách sản phẩm, nhiều dòng
    function loads_product()
    {
        $this->rs = $this->pdo->query('select * from `product`');
        return $this->rs->fetchAll(PDO::FETCH_OBJ);
    }

    // Load danh sách sản phẩm, 1 dòng
    function load_product()
    {
        $this->rs = $this->pdo->query('select * from `product`');
        return $this->rs->fetch(PDO::FETCH_OBJ);
    }

    // Hàm thêm sửa xoá sản phẩm
    function prod_action($params)
    {
        $this->statement = $this->pdo->prepare($this->sql);
        $this->save($params);
        header('location: index.php?click=products');
    }

    // function setquery($sql)
    // {

    // }
}
















// /* Hàm sửa sản phẩm */
// function edit_product($id, $prod_thumb, $name, $old_price, $new_price, $prod_number, &$post)
// {
//     if (!$id || !$prod_thumb || !$name || !$old_price || !$new_price || !$prod_number) {
//         alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
//     } elseif (is_numeric($old_price) == false && is_numeric($new_price) == false && is_numeric($prod_number) == false) {
//         alert('Số lượng phải là chữ số');
//     } elseif (!isset($post[$id])) {
//         alert('Sản phẩm không tồn tại');
//     } elseif (isset($_FILES['prod_thumb']['error']) && $_FILES['prod_thumb']['error'] == 0 && isset($_FILES['detail_thumb']['error']) && $_FILES['detail_thumb']['error'] == 0) {
//         unlink($target_dir_prod . $post[$id]['prod_thumb']);
//         unlink($target_dir_prod . $post[$id]['detail_thumb']);
//         include './libs/upload-file.php';
//         up_prod('prod_thumb', 'detail_thumb'); // include upload file: admin/libs/upload-file.php
//         $sql = "INSERT INTO `product`(`id_view`,`id_categories`, `id_brand`,`name`,`prod_thumb`,`old_price`,`new_price`,`prod_number`,`description`,`detail`,`detail_thumb`) VALUES ($id_view, $id_categories, $id_brand, $name, $thumb, $old_price, $new_price, $prod_number, $description, $detail, $detail_thumb)";
//     } else {
//         $sql = "INSERT INTO `product`(`id_view`,`id_categories`, `id_brand`,`name`,`prod_thumb`,`old_price`,`new_price`,`prod_number`,`description`,`detail`,`detail_thumb`) VALUES ($id_view, $id_categories, $id_brand, $name, $thumb, $old_price, $new_price, $prod_number, $description, $detail, $detail_thumb)";
//     }
// }

// /* Hàm xoá sản phẩm */
// function remove_product($id, &$sql)
// {
//     $target_dir_prod = './images/products/';
//     if (isset($sql->id)) {
//         unlink($target_dir_prod . $sql->id['prod_thumb']);
//         unset($sql->id);
//     } elseif ($id == '') {
//         alert('Bạn nhập thông tin chưa đầy đủ');
//     } else {
//         alert('Sản phẩm không tồn tại');
//     }
// }