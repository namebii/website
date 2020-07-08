<?php
include 'libs/functions.php';
$alert = $errors['user'] = $errors['pass'] = '';

try {
  include 'connect.php';
  $sql_user = 'select * from user';
  $rs = $conn->query($sql_user);
  $result = $rs->fetchAll(PDO::FETCH_OBJ);
  $conn = null;
} catch (PDOException $errors) {
  exit('Kết nối dữ liệu thất bại: ' . $errors->getMessage());
}

// Check Cookie
if (isset($_COOKIE['login']) && $_COOKIE['login']) {
  $_SESSION['login'] = true;
  $_SESSION['name'] = $_COOKIE['name'];
  $_SESSION['avatar'] = $_COOKIE['avatar'];
}
if (islogin()) {
  header('location:index.php');
}
if (isset($_POST['user'], $_POST['pass'])) {
  // Thay phần kiểm tra dữ liệu
  foreach ($result as $user) {
    // $flag = false;
    $userlogin = null;

    if ($_POST['user'] == $user->username && $_POST['pass'] == $user->password) {
      //$flag = true;
      $userlogin = $user;
      break;
    }
  }

  if ($userlogin) {
    // Bật Flag để làm điều kiện
    $_SESSION['login'] = true;
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['name'] = $userlogin->firstname . ' ' . $userlogin->lastname;
    $_SESSION['avatar'] = $userlogin->avatar;
    if (isset($_POST['remember'])) {
      // Thêm yêu cầu lưu trạng thái đăng nhập      
      $time = time() + 86400; // Thời gian sống tuỳ chọn,  ví dụ: 1 ngày
      setcookie('login', true, $time);
      setcookie('name', $_SESSION['name'], $time);
      setcookie('avatar', $_SESSION['avatar'], $time);
    }
    header('location:index.php');
  } else {
    $alert = '<div class="alert alert-danger">Thông tin đăng nhập không đúng</div>';
  }

  if ($_POST['user'] == '') {
    $errors['user'] = 'Bạn chưa nhập User Name';
  }
  if ($_POST['pass'] == '') {
    $errors['pass'] = 'Bạn chưa nhập Password';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login | Taki's Web</title>

  <!-- Bootstrap -->
  <link href="template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="template/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="template/vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="template/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form action="" method="post">
            <h1>Đăng nhập</h1>
            <p><?= '<div style="color:red">' . $alert . '</div>' ?></p>
            <div>
              <input type="text" class="form-control" placeholder="Tên đăng nhập" name="user" value="<?= $_POST['user'] ?? '' ?>" />
              <p><?= '<div style="color:red">' . $errors['user'] . '</div>' ?></p>
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Mật khẩu" name="pass" />
              <p><?= '<div style="color:red">' . $errors['pass'] . '</div>' ?></p>
            </div>
            <div class="form-group form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="remember" value="checkedValue">
                Ghi nhớ đăng nhập
              </label>
            </div>
            <div>
              <button type="submit" class="btn btn-default submit">Đăng nhập</button>
              <a class="reset_pass" href="#">Quên mật khẩu?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <!-- <p class="change_link">Bạn chưa có tài khoản?
                <a href="#signup" class="to_register"> Đăng ký ngay </a>
              </p>

              <div class="clearfix"></div>
              <br /> -->

              <div>
                <h1><i class="fa fa-paw"></i> Welcome to Taki's Website!</h1>
                <p>Copyright © 2020 All Rights Reserved. Design by <a href="tel:0965337117">Taki</a></p>
              </div>
            </div>
          </form>
        </section>
      </div>

      <!-- <div id="register" class="animate form registration_form">
        <section class="login_content">
          <form>
            <h1>Đăng ký tài khoản</h1>
            <div>
              <input type="text" class="form-control" placeholder="Tên đăng nhập" required="" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Mật khẩu" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="index.html">Đăng ký</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">Bạn đã có tài khoản?
                <a href="#signin" class="to_register"> Đăng nhập </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-paw"></i> Welcome to Taki's Website!</h1>
                <p>Copyright © 2020 All Rights Reserved. Design by <a href="tel:0965337117">Taki</a></p>
              </div>
            </div>
          </form>
        </section>
      </div> -->
    </div>
  </div>
</body>

</html>