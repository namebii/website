<?php
if (!isset($_GET['sku']) ||  !$_GET['sku']) {
    header('location: index.php?click=product');
}
include 'core/product-core.php';
$post = loaddata('data/product.txt');
$product = null;
if (isset($post[$_GET['sku']])) {
    $product = $post[$_GET['sku']];
} else {
    header('location: index.php?click=product');
}
// Tiến hành cập nhật dữ liệu
if (isset($_POST['sku'])) {
    edit($_POST['sku'],$_FILES['prod_thumb'], $_POST['name'], $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'], $post);
    $post = writedata('data/product.txt', $post);
    header('location: index.php?click=product');
}
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
                        <input type="text" class="form-control has-feedback-left" name="sku" placeholder="Mã sản phẩm" readonly value="<?= $_GET['sku'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= $product['name'] ?? '' ?>">
                        <span class="fa fa-cc-stripe form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="old_price" placeholder="Giá gốc" value="<?= $product['old_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control" name="new_price" placeholder="Giá khuyến mại" value="<?= $product['new_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="prod_number" placeholder="Số lượng" value="<?= $product['prod_number'] ?? '' ?>">
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