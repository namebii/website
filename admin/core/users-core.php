<?php
// Xử lý đọc file txt thành mảng như trên
function loaddata_user($path)
{
  $ar_acc = [];
  $file_acc = fopen($path, 'r');
  while (!feof($file_acc)) {
    $str_acc = fgets($file_acc);
    if (isset($str_acc)) {
      $list_str_acc = explode('|\|', $str_acc);
      if (count($list_str_acc) == 8) {
        $ar_acc[$list_str_acc[0]] = [
          'username' => $list_str_acc[1],
          'password' => $list_str_acc[2],
          'firstname' => $list_str_acc[3],
          'lastname' => $list_str_acc[4],
          'avatar' => trim($list_str_acc[5]),
          'email' => $list_str_acc[6],
          'role' => $list_str_acc[7]
        ];
      }
    }
  }
  fclose($file_acc);
  return $ar_acc;
}

// Xử lý ghi mảng ở trên thành file txt
function writedata_user($path, $ar_acc)
{
  $file_acc = fopen($path, 'w');
  $content = '';
  foreach ($ar_acc as $userid => $member) {
    $username = $member['username'];
    $password = $member['password'];
    $firstname = $member['firstname'];
    $lastname = $member['lastname'];
    $avatar = $member['avatar'];
    $email = $member['email'];
    $role = $member['role'];
    $content .= "$userid|\|$username|\|$password|\|$firstname|\|$lastname|\|$avatar|\|$email|\|$role\n";
  }
  fwrite($file_acc, $content);
  fclose($file_acc);
  return loaddata_user($path);
}

$target_dir = './images/users/'; //Thư mục bạn sẽ lưu file avatar
/* Hàm thêm thành viên */
function add_user($userid, $username, $password, $firstname, $lastname, $avatar, $email, $role, &$ar_acc)
{
  $target_dir = './images/users/'; //Thư mục bạn sẽ lưu file avatar
  $ext = '';
  if (!$userid || !$username || !$password || !$firstname || !$lastname || !$avatar || !$email || !$role) {
    alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
  } elseif (isset($ar_acc[$userid])) {
    alert('Tên người dùng đã tồn tại');
  } else {
    if (isset($_FILES['avatar'])) {
      // Lấy ra đuôi ảnh
      switch ($_FILES['avatar']['type']) {
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
      $maxfilesize   = 10485760; //10(MB)
      // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
      if ($_FILES['avatar']['size'] > $maxfilesize) {
        alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
      }

      // Đặt tên file ảnh
      $ava = 'avatar-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
      // Tạo thư mục image nếu chưa có

      if (!is_dir($target_dir)) {
        mkdir($target_dir);
      }
      chmod($target_dir, 777);   // decimal; probably incorrect
      chmod($target_dir, "u+rwx,go+rx"); // string; incorrect
      chmod($target_dir, 0777);  // octal; correct value of mode
      alert(move_uploaded_file($_FILES['avatar']['tmp_name'], $target_dir . $ava) ? 'Upload thành công' : 'Có lỗi xảy ra');
    }
    $ar_acc[$userid] = ['username' => $username, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'avatar' => $ava, 'email' => $email, 'role' => $role];
    writedata_user('data/account.txt', $ar_acc);
    header('location: index.php?click=users');
  }
}

/* Hàm xoá thành viên */
function remove_user($userid, &$ar_acc)
{
  $target_dir = './images/users/';
  if (isset($ar_acc[$userid])) {
    unlink($target_dir . $ar_acc[$userid]['avatar']);
    unset($ar_acc[$userid]);
  } elseif ($userid == '') {
    alert('Bạn nhập thông tin chưa đầy đủ');
  } else {
    alert('Sản phẩm không tồn tại');
  }
}
