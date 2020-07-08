<?php
include 'core/products-core.php';
if (isset($_POST['add_new'])) {        
    add_product($_POST['id'],$_POST['id_view'], $_POST['id_categories'], $_POST['id_supplier'], $_POST['id_brand'], $_POST['name'], $_FILES['prod_thumb'], $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'], $_POST['description'], $_POST['detail'], $_FILES['detail_thumb']);
    
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
                        <input type="text" class="form-control has-feedback-left" name="id" placeholder="Mã sản phẩm" value="<?= $_POST['id'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_view" placeholder="Mã hiển thị" value="<?= $_POST['id_view'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_categories" placeholder="Mã danh mục" value="<?= $_POST['id_categories'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_supplier" placeholder="Mã nhà cung cấp" value="<?= $_POST['id_supplier'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_brand" placeholder="Mã thương hiệu" value="<?= $_POST['id_brand'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= $_POST['name'] ?? '' ?>">
                        <span class="fa fa-cc-stripe form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="file" class="form-control file-upload" name="prod_thumb" placeholder="Hình đại diện">
                        <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="old_price" placeholder="Giá gốc" value="<?= $_POST['old_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control" name="new_price" placeholder="Giá khuyến mại" value="<?= $_POST['new_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="prod_number" placeholder="Số lượng" value="<?= $_POST['prod_number'] ?? '' ?>">
                        <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="description" placeholder="Mô tả" value="<?= $_POST['description'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="detail" placeholder="Nội dung chi tiết" value="<?= $_POST['detail'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="file" class="form-control file-upload" name="detail_thumb" placeholder="Hình chi tiết">
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