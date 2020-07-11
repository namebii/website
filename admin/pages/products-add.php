<?php
include './core/products-core.php';
include './widgets/path.php';
include './libs/upload-file.php';

if (isset($_FILES['prod_thumb'], $_FILES['detail_thumb'])) {
    $path_prod = upload($_FILES['prod_thumb'], $target_dir_prod, ['.jpg', '.png', '.gif'], 2, $msg);
    $path_detail = upload($_FILES['detail_thumb'], $target_dir_prod, ['.jpg', '.png', '.gif'], 2, $msg);
    $date_create=date('YmdHis');

    if(isset($prod->id_view)){
        alert('Sản phẩm đã tồn tại');
    }elseif ($path_prod && $path_detail) {
        $array = [
            $_POST['id_view'], $_POST['id_categories'], $_POST['id_supplier'], $_POST['id_brand'], $_POST['name'], $path_prod, $_POST['old_price'], $_POST['new_price'], $_POST['prod_number'], $_POST['description'], $_POST['detail'], $path_detail,$_POST['status'],$date_create
        ];
        foreach ($array as $v) {
            if ($v != '') {
                $prod = new product();
                $prod->setquery("insert into `product` (`id_view`,`id_categories`,`id_supplier`,`id_brand`,`name`,`prod_thumb`,`old_price`,`new_price`,`prod_number`,`description`,`detail`,`detail_thumb`,`status`,`date_create`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $prod->prod_action($array);
                break;
            } else {
                alert('Bạn nhập thông tin không đúng, xin vui lòng kiểm tra lại!');
                break;
            }
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
                <h2>Thêm sản phẩm</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask" method="post" enctype="multipart/form-data" action="">
                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_view" placeholder="Nhập mã hiển thị" value="<?= $_POST['id_view'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                        <label>Mã hiển thị</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="id_categories" placeholder="Nhập danh mục" value="<?= $_POST['id_categories'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                        <label>Mã danh mục</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="id_supplier" placeholder="Nhập nhà cung cấp" value="<?= $_POST['id_supplier'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                        <label>Mã nhà cung cấp</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control" name="id_brand" placeholder="Nhập thương hiệu" value="<?= $_POST['id_brand'] ?? '' ?>">
                        <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                        <label>Mã thương hiệu</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="text" class="form-control has-feedback-left" name="name" placeholder="Nhập tên sản phẩm" value="<?= $_POST['name'] ?? '' ?>">
                        <span class="fa fa-cc-stripe form-control-feedback left" aria-hidden="true"></span>
                        <label>Tên sản phẩm</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="prod_number" placeholder="Nhập số lượng" value="<?= $_POST['prod_number'] ?? '' ?>">
                        <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                        <label>Số lượng</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control has-feedback-left" name="old_price" placeholder="Nhập giá gốc" value="<?= $_POST['old_price'] ?? '' ?>">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                        <label>Giá gốc</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <input type="number" class="form-control" name="new_price" placeholder="Nhập giá khuyến mại" value="<?= $_POST['new_price'] ?? '' ?>">
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
                        <textarea type="text" class="form-control" name="description" placeholder="Nhập mô tả"><?= $_POST['description'] ?? '' ?></textarea>
                        <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                        <label>Mô tả</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        
                        <textarea type="text" class="form-control has-feedback-left" name="detail" placeholder="Nhập nội dung chi tiết"><?= $_POST['detail'] ?? '' ?></textarea>
                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                        <label for="files">Nội dung chi tiết</label>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group">
                        <label for="files">Trạng thái</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="1" checked>
                                Hiển thị
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="0">
                                Ẩn
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="-1">
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