<?php
include 'core/users-core.php';
?>
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách thành viên</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="index.php?click=users-add" class="btn btn-success text-light">Thêm</a></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
                                        <th class="table-username">Tên người dùng</th>
                                        <th class="table-name">Tên</th>
                                        <th class="table_email">Email</th>
                                        <th class="table-role">Vai trò</th>
                                        <th style="width:120px;text-align:center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($load_member as $userid => $member) {
                                    ?>
                                        <tr>
                                            <td style="text-align:center"><input type="checkbox" name="choose" value="checkedValue"></td>
                                            <td class="table-username"><?=$member->username?></td>
                                            <td class="table-name"><?= $member->firstname?></td>
                                            <td class="table-email"><?= $member->email ?></td>
                                            <td class="table-role"><?= $member->role ?></td>
                                            <td style="padding:7px;text-align:center">
                                                <a data-toggle="tooltip" alt="Xem" title="Xem" href="index.php?click=user-show&userid=<?= $userid ?>"><img class="hanh-dong-img" src="images/show.png"></a>
                                                <a data-toggle="tooltip" alt="Sửa" title="Sửa" href="index.php?click=user-edit&userid=<?= $userid ?>"><img class="hanh-dong-img" src="images/edit.png"></a>
                                                <a data-toggle="tooltip" alt="Xóa" title="Xóa" href="index.php?click=user-remove&userid=<?= $userid ?>" onclick="return confirm('Bạn có muốn xóa hay không')"><img class="hanh-dong-img" src="images/delete.png"></a>
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