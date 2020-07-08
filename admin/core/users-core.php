<?php
include './connect.php';
$sql_user = 'select * from user';  
$rs = $conn->query($sql_user);
$result = $rs->fetchAll(PDO::FETCH_OBJ);  

/* Hàm thêm thành viên */
function add_user($id, $id_group, $username, $password, $firstname, $lastname, $avatar, $email, $role)
{
  $target_dir_user = './images/users/'; //Thư mục bạn sẽ lưu file avatar
  $ext = '';
  foreach($result as $user){
    if (!$id || !$id_group || !$username || !$password || !$firstname || !$lastname || !$avatar || !$email || !$role) {
      alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (isset($user->id)) {
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
  
        if (!is_dir($target_dir_user)) {
          mkdir($target_dir_user);
        }
        chmod($target_dir_user, 777);   // decimal; probably incorrect
        chmod($target_dir_user, "u+rwx,go+rx"); // string; incorrect
        chmod($target_dir_user, 0777);  // octal; correct value of mode
        alert(move_uploaded_file($_FILES['avatar']['tmp_name'], $target_dir_user . $ava) ? 'Upload thành công' : 'Có lỗi xảy ra');
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
