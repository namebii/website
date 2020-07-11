<?php
include './core/products-core.php';
include './widgets/path.php';
include './libs/upload-file.php';

// if (!isset($_GET['id_view']) ||  !$_GET['id_view']) {
//     header('location: index.php?click=products');
// }

// $product = null;

// if (isset($post[$_GET['id_view']])) {
//     $product = $post[$_GET['id_view']];
// } else {
//     header('location: index.php?click=products');
// }

// Tiến hành cập nhật dữ liệu
if (isset($_POST['id'])) {
    if (isset($_FILES['prod_thumb'], $_FILES['detail_thumb'])) {
        $path_prod = upload($_FILES['prod_thumb'], $target_dir_prod, ['.jpg', '.png', '.gif'], 2, $msg);
        $path_detail = upload($_FILES['detail_thumb'], $target_dir_prod, ['.jpg', '.png', '.gif'], 2, $msg);
        $date_create=date('YmdHis');
    }

    if ($path_prod && $path_detail) {
        $array = [
            $_POST['id_view'], $_POST['id_categories'], $_POST['id_supplier'], $_POST['id_brand'], $_POST['name'], $path_prod, $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'], $_POST['description'], $_POST['detail'], $path_detail,$status,$date_update
        ];
        foreach ($array as $v) {
            if ($v != '') {
                $prod = new product();
                $prod->setquery("UPDATE `product` SET (`id_view`,`id_categories`,`id_supplier`,`id_brand`,`name`,`prod_thumb`,`old_price`,`new_price`,`prod_number`,`description`,`detail`,`detail_thumb`,`date_update`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $prod->prod_add($array);
                break;
            } else {
                alert('Bạn nhập thông tin không đúng, xin vui lòng kiểm tra lại!');
                break;
            }
            dd($prod);
        }
    } else {
        alert($msg);
    }
}
?>
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sửa sản phẩm</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask" method="post" enctype="multipart/form-data" action="">
                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_view" readonly placeholder="Nhập mã hiển thị" value="<?= $_GET['id_view'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                        <label>Mã hiển thị</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="id_categories" placeholder="Nhập danh mục" value="">
                        <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                        <label>Mã danh mục</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_supplier" placeholder="Nhập nhà cung cấp" value="">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                        <label>Mã nhà cung cấp</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="id_brand" placeholder="Nhập thương hiệu" value="">
                        <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                        <label>Mã thương hiệu</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="name" placeholder="Nhập tên sản phẩm" value="">
                        <span class="fa fa-cc-stripe form-control-feedback left" aria-hidden="true"></span>
                        <label>Tên sản phẩm</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="prod_number" placeholder="Nhập số lượng" value="">
                        <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                        <label>Số lượng</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="old_price" placeholder="Nhập giá gốc" value="">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                        <label>Giá gốc</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control" name="new_price" placeholder="Nhập giá khuyến mại" value="">
                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                        <label>Giá khuyến mại</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="file" class="form-control file-upload" name="prod_thumb">
                        <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                        <label>Hình đại diện</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="file" class="form-control file-upload" name="detail_thumb">
                        <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                        <label for="files">Hình chi tiết</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <textarea type="text" class="form-control" name="description" placeholder="Nhập mô tả" value=""></textarea>
                        <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                        <label>Mô tả</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        
                        <textarea type="text" class="form-control has-feedback-left" name="detail" placeholder="Nhập nội dung chi tiết" value="<?= $_POST['detail'] ?? '' ?>"></textarea>
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                        <label for="files">Nội dung chi tiết</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <label for="files">Trạng thái</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="" value="1" checked>
                                Hiển thị
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="" value="0">
                                Ẩn
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="" value="-1">
                                Xoá
                            </label>
                        </div>

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
















<!-- 
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
                        <input type="text" class="form-control has-feedback-left" name="id" placeholder="Mã sản phẩm" readonly value="<?= $_GET['id'] ?? '' ?>">
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
</div> -->