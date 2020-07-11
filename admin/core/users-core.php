<?php
class user extends database
{
  // Login
  function login($user, $pass)
  {
    return $this->setquery('select * from `user` where `username` = ? and `password` = ?')->loadrow([$user, $pass]);
  }
  // Thêm
  // Sửa
  // Xoá


  function check()
  {
  }
}

class member extends database
{
  function loadmember()
  {
    return $this->setquery('select * from user')->loadrows([]);
  }
}

$object = new member();
$load_member = $object->loadmember($id, $username, $firstname, $email, $role);
























/* Hàm thêm thành viên */
function add_user($id, $id_group, $username, $password, $firstname, $lastname, $avatar, $email, $role)
{
  $target_dir_user = './images/users/'; //Thư mục bạn sẽ lưu file avatar
  $ext = '';
  foreach ($result as $user) {
    if (!$id || !$id_group || !$username || !$password || !$firstname || !$lastname || !$avatar || !$email || !$role) {
      alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (isset($user->id)) {
      alert('Tên người dùng đã tồn tại');
    } else {
      if (isset($_FILES['avatar'])) {
        include '../pages/upload-file.php';
      }

      $sql = "INSERT INTO `user`(`id`,`id_group`,`username`,`password`, `firstname`,`lastname`,`avatar`,`email`,`role`) VALUES ($id,$id_group,$username, $password, $firstname, $lastname, $ava, $email, $role)";

      header('location: index.php?click=users');
    }
  }
}

/* Hàm xoá thành viên */
function remove_user($id, &$ar_acc)
{
  $target_dir_user = './images/users/';
  if (isset($ar_acc[$id])) {
    unlink($target_dir_user . $ar_acc[$id]['avatar']);
    unset($ar_acc[$id]);
  } elseif ($id == '') {
    alert('Bạn nhập thông tin chưa đầy đủ');
  } else {
    alert('Sản phẩm không tồn tại');
  }
}
