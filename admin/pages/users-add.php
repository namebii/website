<?php
include 'core/users-core.php';
if (isset($_POST['add_new'])) {
  $ar_acc = loaddata('data/account.txt');
//   if($_POST['alert']==1) {
//     $emailFrom = 'cafetoivn@gmail.com';
//     $emailTo = $email;
//     $subject = 'Gửi tin nhắn từ '.$lastname.' '.$firstname;
//     $sendCopy = trim($_POST['sendCopy']);
//     $body = "Name: $lastname.' '.$firstname \n\nEmail: $email \n\nComments: $comments";
//     $headers = 'From: ' .' <'.$emailFrom.'>' . "\r\n" . 'Reply-To: ' . $email;

//     mail($emailTo, $subject, $body, $headers);

//     // set our boolean completion value to TRUE
//     $emailSent = true;
// }
  add($_POST['userid'], $_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_FILES['avatar'],  $_POST['email'], $_POST['role'], $ar_acc);
}
?>
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Đăng ký thành viên</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post">

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="userid">User ID <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="text" id="userid" name="userid" class="form-control" required="required">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Tên người dùng <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="text" id="username" name="username" class="form-control" required="required">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="email" id="email" name="email" class="form-control" required="required">
              </div>
            </div>
            <div class="item form-group">
              <label for="first-name" class="col-form-label col-md-3 col-sm-3 label-align">Tên</label>
              <div class="col-md-6 col-sm-6">
                <input type="text" id="first-name" name="firstname" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label for="last-name" class="col-form-label col-md-3 col-sm-3 label-align">Họ</label>
              <div class="col-md-6 col-sm-6">
                <input type="text" id="last-name" name="lastname" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Mật khẩu <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="password" id="password" name="password" required="required" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Hình đại diện <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="file" class="form-control file-upload" name="avatar" placeholder="Hình đại diện">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align">Gửi thông báo đến thành viên</label>
              <div class="col-md-6 col-sm-6">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="alert" value="1"> Gửi cho thành viên mới đăng kí một email chứa thông tin tài khoản của họ.
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align">Vai trò</label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" name="role">
                  <option value="3">Thành viên</option>
                  <option value="2">Biên tập viên</option>
                  <option value="1">Người quản lý</option>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
              <div class="col-md-6 col-sm-6 offset-md-3">
                <a class="btn btn-danger text-light" href="index.php?click=users">Huỷ bỏ</a>
                <button class="btn btn-primary" type="reset">Nhập lại</button>
                <button type="submit" class="btn btn-success" name="add_new">Đăng ký</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>