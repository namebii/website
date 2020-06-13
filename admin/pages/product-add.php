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
        $content .= "$sku|\|$name|\|$prod_thumb|\|$old_price|\|$new_price|\|$prod_number\n";
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata($path);
}

/* Hàm thêm sản phẩm */
function them($sku, $name, $old_price, $new_price, $prod_number, &$post)
{
    $ext='';
    if (!$sku || !$name || !$old_price|| !$new_price || !$prod_number || !$_FILES['prod_thumb']['name']) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    }
    else{
        // Lay ra duoi anh
        switch($_FILES['prod_thumb']['type']){
            case 'image/jpeg' : $ext = 'jpg'; break;
            case 'image/png' : $ext = 'png'; break;
            case 'image/gif' : $ext = 'gif'; break;
        }
        
        // Chi cho phep upload file anh JPG/JPEG, PNG hoac GIF
        if($ext==''){
            echo 'Khong cho phep upload file khac cac duoi sau: JPG, GIF, PNG';
            exit;
        }

        // Dat ten file anh
        $post['prod_thumb']= date('YmdHis').'-'.rand(100000, 999999).'.'.$ext;

        // Tao thu muc img neu chua co
        if(!is_dir('avatar/')) mkdir('avatar'); 

        move_uploaded_file($_FILES['prod_thumb']['tmp_name'],'uploads/'.$_FILES['prod_thumb']['name']);
        $post[$sku] = ['name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
        $post = writedata('data/product.txt', $post);
        header('location: index.php?click=product');  
    }


    // move_uploaded_file($_FILES['prod_thumb']['tmp_name'],'uploads/'.$_FILES['prod_thumb']['name']);
    // $post = writedata('data/product.txt', $post);
    // header('location: index.php?click=product');
    // else {
    //     $post[$sku] = ['name' => $name, 'old_price' => $old_price, 'new_price' => $new_price, 'prod_number' => $prod_number];
    // }
    // elseif (isset($post[$sku])) {
    //     alert('Sản phẩm đã tồn tại'); // Không check đc tồn tại của sản phẩm
    // } elseif (!isset($_POST['sku'], $_POST['name'], $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'])) {
    //     alert('Bạn nhập thông tin chưa đầy đủ');
    // }
}

if (isset($_POST['add_new'])) {
    $post = loaddata('data/product.txt');
    them($_POST['sku'], $_POST['name'], $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'], $post);
}
<<<<<<< HEAD
    move_uploaded_file($_FILES['prod_thumb']['tmp_name'],'uploads/'.$_FILES['prod_thumb']['name']);
    $post = writedata('data/product.txt', $post);
    header('location: index.php?click=product');
}
=======

>>>>>>> b73916d3e64369a7aaf78292452b3624605eeb20
?>
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm sản phẩm</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask" method="post" enctype="multipart/form-data" action="">

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="sku" placeholder="Mã sản phẩm" value="<?= $_POST['sku'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= $_POST['name'] ?? '' ?>">
                        <span class="fa fa-cc-stripe form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="old_price" placeholder="Giá gốc" value="<?= $_POST['old_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="new_price" placeholder="Giá khuyến mại" value="<?= $_POST['new_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="prod_number" placeholder="Số lượng" value="<?= $_POST['prod_number'] ?? '' ?>">
                        <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="file" class="form-control file-upload" name="prod_thumb" placeholder="Hình đại diện">
                        <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="form-group row" style="text-align:center">
                        <div class="col-md-12 col-sm-12 offset-md-12">
                            <a class="btn btn-danger text-light" href="index.php?click=product">Huỷ bỏ</a>
                            <button class="btn btn-primary" type="reset">Nhập lại</button>
                            <button type="submit" name="add_new" class="btn btn-success">Thêm</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>