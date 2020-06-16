<?php
// Xử lý đọc file txt thành mảng như trên
function loaddata($path)
{
    $file = fopen($path, 'r');
    $post = [];
    while (!feof($file)) {
        $str_product = fgets($file); // Tách file thành nhiều dòng sản phẩm
        if ($str_product) {
            $ar_product = explode('|\|', $str_product);
            if (count($ar_product) == 5) {
                $post[$ar_product[0]] = [
                    'name' => $ar_product[1],
                    // 'prod_thumb' => $ar_product[2],
                    'old_price' => (float) $ar_product[2],
                    'new_price' => (float) $ar_product[3],
                    'prod_number' => (float) $ar_product[4]
                ];
            }
        }
    }
    fclose($file);
    return $post;
}

// Xử lý ghi mảng ở trên thành file txt
function writedata($path, $post)
{
    $file = fopen($path, 'w');
    $content = '';
    foreach ($post as $sku => $prod) {
        $name = $prod['name'];
        // $prod_thumb = $prod['prod_thumb'];
        $old_price = $prod['old_price'];
        $new_price = $prod['new_price'];
        $prod_number = $prod['prod_number'];
        $content .= "$sku|\|$name|\|$old_price|\|$new_price|\|$prod_number\n"; /* |\|$prod_thumb */
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata($path);
}

$structure = 'uploads/';
/* Hàm thêm sản phẩm */
function them($sku, /*$prod_thumb,*/ $name, $old_price, $new_price, $prod_number, &$post)
{
    // $ext = '';
    if (!$sku || /*!$_FILES['prod_thumb']['tmp_name'] ||*/ !$name || !$old_price || !$new_price || !$prod_number) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif(isset($post[$sku])) {
        alert('Sản phẩm đã tồn tại');
    }else{
        // // Lấy ra đuôi ảnh
        // switch ($_FILES['prod_thumb']['type']) {
        //     case 'image/jpeg':
        //         $ext = 'jpg';
        //         break;
        //     case 'image/png':
        //         $ext = 'png';
        //         break;
        //     case 'image/gif':
        //         $ext = 'gif';
        //         break;
        // }

        // // Chỉ cho phép upload file ảnh JPG/JPEG, PNG hoac GIF
        // if ($ext == '') {
        //     alert('Không cho phép upload file khác các đuôi sau: JPG, GIF, PNG');
        //     exit;
        // }

        // // Đặt tên file ảnh
        // $post['prod_thumb'] = date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;

        // // Tạo thư mục image nếu chưa có
        // if (!is_dir($structure)) {mkdir($structure);}

        // echo move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $structure . $post['prod_thumb']) ? 'Thành công':'Lỗi';
        $post[$sku] = [/*'prod_thumb' => $prod_thumb, */'name' => $name, 'old_price' => $old_price, 'new_price' => $new_price,'prod_number' => $prod_number];
        $post = writedata('data/product.txt', $post);
        header('location: index.php?click=product');
    }
}

/* Hàm sửa sản phẩm */
function sua($sku, $name, $old_price, $new_price, $prod_number, &$post)
{
    if (!$sku || !$name || !$old_price || !$new_price || !$prod_number) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (is_numeric($old_price) == false && is_numeric($new_price) == false && is_numeric($prod_number) == false) {
        alert('Số lượng phải là chữ số');
    } elseif (!isset($post[$sku])) {
        alert('Sản phẩm không tồn tại');
    } else { //elseif (isset($post[$sku]))
        $post[$sku] = ['name'=>$name,'old_price'=>$old_price,'new_price'=>$new_price,'prod_number'=>$prod_number];
    }
}

/* Hàm xoá sản phẩm */
function xoa($sku, &$post)
{
    if (isset($post[$sku])) {
        unset($post[$sku]);
    } elseif ($sku == '') {
        alert('Bạn nhập thông tin chưa đầy đủ');
    } else {
        alert('Sản phẩm không tồn tại');
    }
}
