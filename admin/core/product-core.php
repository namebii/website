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
            if (count($ar_product) == 6) {
                $post[$ar_product[0]] = [
                    'name' => $ar_product[1],
                    'prod_thumb' => $ar_product[2],
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
function writedata($path, $post)
{
    $file = fopen($path, 'w');
    $content = '';
    foreach ($post as $sku => $prod) {
        $name = $prod['name'];
        $prod_thumb = $prod['prod_thumb'];
        $old_price = $prod['old_price'];
        $new_price = $prod['new_price'];
        $prod_number = $prod['prod_number'];
        $content .= "$sku|\|$prod_thumb|\|$name|\|$old_price|\|$new_price|\|$prod_number\n"; /* |\|$prod_thumb */
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata($path);
}

//Thư mục bạn sẽ lưu file upload
$target_dir = 'uploads/product';

/* Hàm thêm sản phẩm */
function them($sku, $prod_thumb, $name, $old_price, $new_price, $prod_number, &$post)
{
    $ext = ''; 
    if (!$sku || !$prod_thumb || !$name || !$old_price || !$new_price || !$prod_number) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (isset($post[$sku])) {
        alert('Sản phẩm đã tồn tại');
    } else {

        // // Vị trí file lưu tạm trong server
        // $target_file   = $target_dir . basename($_FILES['prod_thumb']['name']);
        // $allowUpload   = true;
        // // Lấy phần mở rộng của file
        // $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // $maxfilesize   = 800000; //(bytes)
        // // Những loại file được phép upload
        // $allowtypes    = ['jpg', 'jpeg', 'png', 'gif'];

        // if (isset($_POST['add_new'])) {
        //     // Kiểm tra xem có phải là ảnh
        //     $check = getimagesize($_FILES['prod_thumb']['tmp_name']);
        //     if ($check !== false) {
        //         echo 'Đây là file ảnh - ' . $check['mime'] . '.';
        //         $allowUpload = true;
        //     } else {
        //         echo 'Không phải file ảnh.';
        //         $allowUpload = false;
        //     }
        // }

        // // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
        // if (file_exists($target_file)) {
        //     alert('File đã tồn tại.');
        //     $allowUpload = false;
        // }
        // // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
        // if ($_FILES['prod_thumb']['size'] > $maxfilesize) {
        //     alert('Không được upload ảnh lớn hơn $maxfilesize (bytes).');
        //     $allowUpload = false;
        // }


        // // Kiểm tra kiểu file
        // if (!in_array($imageFileType, $allowtypes)) {
        //     alert('Chỉ được upload các định dạng JPG, PNG, JPEG, GIF');
        //     $allowUpload = false;
        // }

        // // Check if $upload Ok is set to 0 by an error
        // if ($allowUpload) {
        //     if (move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $target_file)) {
        //         echo 'File' . basename($_FILES['prod_thumb']['name']) . 'Đã upload thành công';
        //     } else {
        //         alert('Có lỗi xảy ra khi upload file.');
        //     }
        // } else {
        //     alert('Không upload được file!');
        // }

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
            $maxfilesize   = 80; //(bytes)
            // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            if ($_FILES['prod_thumb']['size'] > $maxfilesize) {
                alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
            }

            // Đặt tên file ảnh
            $post['prod_thumb'] = date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
            // Tạo thư mục image nếu chưa có
            // $target_dir = 'uploads/';
            // if (!is_dir($target_dir)){mkdir($target_dir,777);}
            echo move_uploaded_file($_FILES['prod_thumb']['tmp_name'], $target_dir . $post['prod_thumb']) ? 'Upload thành công' : 'Có lỗi xảy ra';
        }
        $post[$sku] = [$_FILES['prod_thumb']['tmp_name'] => $prod_thumb, 'name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
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
        $post[$sku] = ['name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
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
