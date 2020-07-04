<?php
// Xử lý đọc file txt thành mảng như trên
function loaddata_product($path)
{
    $file = fopen($path, 'r');
    $post = [];
    while (!feof($file)) {
        $str_product = fgets($file); // Tách file thành nhiều dòng sản phẩm
        if ($str_product) {
            $ar_product = explode('|\|', $str_product);
            if (count($ar_product) == 6) {
                $post[$ar_product[0]] = [
                    'prod_thumb' => $ar_product[1],
                    'name' => $ar_product[2],
                    'old_price' => (float) $ar_product[3],
                    'new_price' => (float) $ar_product[4],
                    'prod_number' => (float) $ar_product[5]
                ];
            }
        }
    }
    fclose($file);
    return $post;
}

// Xử lý ghi mảng ở trên thành file txt
function writedata_product($path, $post)
{
    $file = fopen($path, 'w');
    $content = '';
    foreach ($post as $sku => $prod) {
        $name = $prod['name'];
        $prod_thumb = $prod['prod_thumb'];
        $old_price = $prod['old_price'];
        $new_price = $prod['new_price'];
        $prod_number = $prod['prod_number'];
        $content .= "$sku|\|$prod_thumb|\|$name|\|$old_price|\|$new_price|\|$prod_number\n";
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata_product($path);
}

$target_dir = './images/products/';
/* Hàm thêm sản phẩm */
function add_product($sku, $prod_thumb, $name, $old_price, $new_price, $prod_number, &$post)
{
    $target_dir = './images/products/'; //Thư mục bạn sẽ lưu file upload
    $ext = '';
    if (!$sku || !$prod_thumb || !$name || !$old_price || !$new_price || !$prod_number) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (isset($post[$sku])) {
        alert('Sản phẩm đã tồn tại');
    } elseif($new_price > $old_price){
        alert('Giá khuyến mại phải nhỏ hơn giá niêm yết');
    } 
    else {

        if (isset($_FILES['prod_thumb'])) {
            // Lấy ra đuôi ảnh
            switch ($_FILES['prod_thumb']['type']) {
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
            if ($_FILES['prod_thumb']['size'] > $maxfilesize) {
                alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
            }

            // Đặt tên file ảnh
            $thumb = 'products-'.date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
            // Tạo thư mục image nếu chưa có

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 777);
            }
            chmod($target_dir, 777);   // decimal; probably incorrect
            chmod($target_dir, "u+rwx,go+rx"); // string; incorrect
            chmod($target_dir, 0777);  // octal; correct value of mode
            alert(move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $target_dir . $thumb) ? 'Upload thành công' : 'Có lỗi xảy ra');
        }
        $post[$sku] = ['prod_thumb' => $thumb, 'name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
        writedata_product('data/product.txt', $post);
        header('location: index.php?click=products');
    }
}

/* Hàm sửa sản phẩm */
function edit_product($sku, $prod_thumb, $name, $old_price, $new_price, $prod_number, &$post)
{
    $target_dir = './images/products/';
    $ext = '';
    if (!$sku || !$prod_thumb || !$name || !$old_price || !$new_price || !$prod_number) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (is_numeric($old_price) == false && is_numeric($new_price) == false && is_numeric($prod_number) == false) {
        alert('Số lượng phải là chữ số');
    } elseif (!isset($post[$sku])) {
        alert('Sản phẩm không tồn tại');
    } elseif (isset($_FILES['prod_thumb']['error']) && $_FILES['prod_thumb']['error'] == 0) {
        unlink($target_dir . $post[$sku]['prod_thumb']);
        // Lấy ra đuôi ảnh
        switch ($_FILES['prod_thumb']['type']) {
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
        if ($_FILES['prod_thumb']['size'] > $maxfilesize) {
            alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
        }

        // Đặt tên file ảnh
        $thumb = 'products-'.date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
        // Tạo thư mục image nếu chưa có

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 777);
        }
        chmod($target_dir, 777);   // decimal; probably incorrect
        chmod($target_dir, "u+rwx,go+rx"); // string; incorrect
        chmod($target_dir, 0777);  // octal; correct value of mode
        alert(move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $target_dir . $thumb) ? 'Upload thành công' : 'Có lỗi xảy ra');
        $post[$sku] = ['prod_thumb' => $thumb, 'name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
    } else {
        $post[$sku] = ['prod_thumb' => $post[$sku]['prod_thumb'], 'name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
    }
}

/* Hàm xoá sản phẩm */
function remove_product($sku, &$post)
{
    $target_dir = './images/products/';
    if (isset($post[$sku])) {
        unlink($target_dir . $post[$sku]['prod_thumb']);
        unset($post[$sku]);
    } elseif ($sku == '') {
        alert('Bạn nhập thông tin chưa đầy đủ');
    } else {
        alert('Sản phẩm không tồn tại');
    }
}
