<?php
$post = loaddata('data/product.txt');
// $tb=[];
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
        $content .= "$sku|\|$name|\|$old_price|\|$new_price|\|$prod_number\n";
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata($path);
}

/* Hàm sửa sản phẩm */
function sua($sku, $prod_number, &$post)
{
    if (!$prod_number) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif(is_numeric($prod_number)==false){
        alert('Số lượng phải là chữ số');
    } elseif (!isset($post[$sku])) {
        alert('Sản phẩm không tồn tại');
    } elseif (isset($post[$sku])) {
        $post[$sku]['prod_number']=$prod_number;
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

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'Sửa':
            sua($_POST['sku'], $_POST['prod_number'], $post);
            break;
        case 'Xoá':
            xoa($_POST['sku'], $post);
            break;
    }
    $post = writedata('data/product.txt', $post);
}

?>
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tất cả sản phẩm <small><?= $tb['sku'] ?? '' ?></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive table-taki table-taki-1">
                            <form action="" method="post">
                                <table class="table table-bordered container mt-3 mb-3">
                                    <thead>
                                        <tr>
                                            <th>Mã</th>
                                            <th>Tên</th>
                                            <!-- <th>Hình Đại Diện</th> -->
                                            <th>Giá Gốc (VNĐ)</th>
                                            <th>Giá Khuyến Mại (VNĐ)</th>
                                            <th>Số Lượng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row"><input type="text" name="sku" value=""></td>
                                            <td scope="row"><input type="text" name="name" value=""></td>
                                            <!-- <td scope="row"><input type="file" name="hinh_anh" value=""></td> -->
                                            <td scope="row"><input type="text" name="old_price" value=""></td>
                                            <td scope="row"><input type="text" name="new_price" value=""></td>
                                            <td scope="row"><input type="text" name="prod_number" value=""></td>
                                            <td scope="row">
                                                <input type="submit" name="action" value="Sửa" class="btn btn-warning">
                                                <input type="submit" name="action" value="Xoá" class="btn btn-danger">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Tất cả sản phẩm <small><?= $tb['sku'] ?? '' ?></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive table-taki">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:20px">Chọn</th>
                                        <th class="table-ma">Mã</th>
                                        <th class="table_ten">Tên</th>
                                        <!-- <th class="table-hinh">Hình Đại Diện</th> -->
                                        <th class="table-dongia">Giá Gốc (VNĐ)</th>
                                        <th class="table-dongia">Giá Khuyến Mại (VNĐ)</th>
                                        <th class="table-soluong">Số Lượng</th>
                                        <th class="table-hanhdong">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($post as $sku => $prod) {
                                    ?>
                                        <tr>
                                            <td style="text-align:center"><input type="checkbox" name="choose" value="checkedValue"></td>
                                            <td class="table-ma"><?= $sku ?></td>
                                            <td class="table-ten"><?= $prod['name'] ?></td>
                                            <!-- <td class="table-hinh"><?= $prod['prod_thumb'] ?></td> -->
                                            <td class="table-dongia"><?= number_format($prod['old_price']) ?></td>
                                            <td class="table-dongia"><?= number_format($prod['new_price']) ?></td>
                                            <td class="table-soluong"><?= number_format($prod['prod_number']) ?></td>
                                            <td style="padding:7px;text-align:center">
                                                <a data-toggle="tooltip" alt="Sửa" title="Sửa" href="index.php?id='.$sanpham['sku'].'"><img class="hanh-dong-img" src="images/edit.png"></a>
                                                <a data-toggle="tooltip" alt="Xóa" title="Xóa" href="index.php?id='.$sanpham['sku'].'" onclick="return confirm(\'Bạn có muốn xóa hay không\');"><img class="hanh-dong-img" src="images/delete.png"></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>