<?php
include './connect.php';
$sql_prod = 'select * from product';
$rs = $conn->query($sql_prod);
$result = $rs->fetchAll(PDO::FETCH_OBJ);
// xemmang($_FILES);

/* Hàm thêm sản phẩm */
function add_product($id, $id_view, $id_categories, $id_supplier, $id_brand, $name, $prod_thumb, $old_price, $new_price, $prod_number, $description, $detail, $detail_thumb)
{
    global $result;
    $target_dir_prod = './images/products/'; //Thư mục bạn sẽ lưu file upload
    $ext = '';
    foreach ($result as $prod) {
        if (!$id_view || !$id_categories || !$id_supplier || !$id_brand || !$name || !$prod_thumb || !$old_price || !$new_price || !$prod_number || !$description || !$detail || !$detail_thumb) {
            alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
        } /* elseif (isset($prod->ids)) {
            alert('Sản phẩm đã tồn tại');
        }*/ elseif ($new_price > $old_price) {
            alert('Giá khuyến mại phải nhỏ hơn giá niêm yết');
        } else {
            if (isset($_FILES['prod_thumb'], $_FILES['detail_thumb'])) {
                // Lấy ra đuôi ảnh
                switch ($_FILES['prod_thumb']['type'] && $_FILES['detail_thumb']['type']) {
                    case 'image/jpeg':
                        $ext = 'jpg';
                        break;
                    case 'image/png':
                        $ext = 'png';
                        break;
                    case 'image/gif':
                        $ext = 'gif';
                        break;
                }
                // Chỉ cho phép upload file ảnh JPG/JPEG, PNG hoac GIF
                if ($ext == '') {
                    alert('Không cho phép upload file khác các đuôi sau: JPG, PNG, GIF');
                    exit;
                }
                $maxfilesize   = 10485760; //10(MB)
                // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                if ($_FILES['prod_thumb']['size'] > $maxfilesize || $_FILES['detail_thumb']['size'] > $maxfilesize) {
                    alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
                }

                // Đặt tên file ảnh
                $thumb_p = 'prod_thumb-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
                $thumb_d = 'detail_thumb-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
                
                // Tạo thư mục image nếu chưa có
                if (!is_dir($target_dir_prod)) {
                    mkdir($target_dir_prod, 777);
                }
                // chmod($target_dir_prod, 777);   // decimal; probably incorrect
                // chmod($target_dir_prod, "u+rwx,go+rx"); // string; incorrect
                // chmod($target_dir_prod, 0777);  // octal; correct value of mode
                alert(move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $target_dir_prod . $thumb_p) ? 'Upload thành công' : 'Có lỗi xảy ra');
                alert(move_uploaded_file($_FILES['detail_thumb']['tmp_name'], $target_dir_prod . $thumb_d) ? 'Upload thành công' : 'Có lỗi xảy ra');
            }
            $sql_prod = "INSERT INTO `product`(`id`,`id_view`,`id_categories`,`id_supplier`,`id_brand`,`name`,`prod_thumb`,`old_price`,`new_price`,`prod_number`,`description`,`detail`,`detail_thumb`) VALUES ($id,$id_view, $id_categories, $id_supplier, $id_brand, $name, $thumb_p, $old_price, $new_price, $prod_number, $description, $detail, $thumb_d)";
            $rs = $conn->exec($sql_prod);
            // $rs->fetchAll(PDO::FETCH_OBJ);

            header('location: index.php?click=products');
        }
    }
}

/* Hàm sửa sản phẩm */
// function edit_product($id, $prod_thumb, $name, $old_price, $new_price, $prod_number, &$post)
// {
//     $target_dir_prod = './images/products/';
//     $ext = '';
//     if (!$id || !$prod_thumb || !$name || !$old_price || !$new_price || !$prod_number) {
//         alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
//     } elseif (is_numeric($old_price) == false && is_numeric($new_price) == false && is_numeric($prod_number) == false) {
//         alert('Số lượng phải là chữ số');
//     } elseif (!isset($post[$id])) {
//         alert('Sản phẩm không tồn tại');
//     } elseif (isset($_FILES['prod_thumb']['error']) && $_FILES['prod_thumb']['error'] == 0 && isset($_FILES['detail_thumb']['error']) && $_FILES['detail_thumb']['error'] == 0) {
//         unlink($target_dir_prod . $post[$id]['prod_thumb']);
//         unlink($target_dir_prod . $post[$id]['detail_thumb']);
//         // Lấy ra đuôi ảnh
//         switch ($_FILES['prod_thumb']['type'] && $_FILES['detail_thumb']['type']) {
//             case 'image/jpeg':
//                 $ext = 'jpg';
//                 break;
//             case 'image/png':
//                 $ext = 'png';
//                 break;
//             case 'image/gif':
//                 $ext = 'gif';
//                 break;
//         }
//         // Chỉ cho phép upload file ảnh JPG/JPEG, PNG hoac GIF
//         if ($ext == '') {
//             alert('Không cho phép upload file khác các đuôi sau: JPG, PNG, GIF');
//             exit;
//         }
//         $maxfilesize   = 10485760; //10(MB)
//         // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
//         if ($_FILES['prod_thumb']['size'] > $maxfilesize || $_FILES['detail_thumb']['size'] > $maxfilesize) {
//             alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
//         }

//         // Đặt tên file ảnh
//         $thumb_p = 'products-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
//         $thumb_d = 'products-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
//         // Tạo thư mục image nếu chưa có

//         if (!is_dir($target_dir_prod)) {
//             mkdir($target_dir_prod, 777);
//         }
//         chmod($target_dir_prod, 777);   // decimal; probably incorrect
//         chmod($target_dir_prod, "u+rwx,go+rx"); // string; incorrect
//         chmod($target_dir_prod, 0777);  // octal; correct value of mode
//         alert(move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $target_dir_prod . $thumb) ? 'Upload thành công' : 'Có lỗi xảy ra');
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
