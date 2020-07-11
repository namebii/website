<?php
// function up_prod($n,$n1){
//     include './path.php';
//     if (isset($_FILES[$n], $_FILES[$n1])) {
//         $ext = '';
//         // Lấy ra đuôi ảnh
//         switch ($_FILES[$n]['type'] && $_FILES[$n1]['type']) {
//             case 'image/jpeg':
//                 $ext = 'jpg';
//                 break;
//             case 'image/png':
//                 $ext = 'png';
//                 break;
//             case 'image/gif':
//                 $ext = 'gif';
//                 break;
//         }
//         // Chỉ cho phép upload file ảnh JPG/JPEG, PNG hoac GIF
//         if ($ext == '') {
//             alert('Không cho phép upload file khác các đuôi sau: JPG, PNG, GIF');
//             exit;
//         }
//         $maxfilesize   = 10485760; //10(MB)
//         // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
//         if ($_FILES[$n]['size'] > $maxfilesize || $_FILES[$n1]['size'] > $maxfilesize) {
//             alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
//         }
    
//         // Đặt tên file ảnh
//         $thumb_p = $n.'-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
//         $thumb_d = $n1.'-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;

//         alert(move_uploaded_file($_FILES[$n]['tmp_name'], $target_dir_prod . $thumb_p) ? 'Upload thành công' : 'Có lỗi xảy ra');
//         alert(move_uploaded_file($_FILES[$n1]['tmp_name'], $target_dir_prod . $thumb_d) ? 'Upload thành công' : 'Có lỗi xảy ra');
//     }
// }

// function up_user($n){
//     include './path.php';
//     if (isset($_FILES[$n])) {
//         $ext = '';
//         // Lấy ra đuôi ảnh
//         switch ($_FILES[$n]['type']) {
//             case 'image/jpeg':
//                 $ext = 'jpg';
//                 break;
//             case 'image/png':
//                 $ext = 'png';
//                 break;
//             case 'image/gif':
//                 $ext = 'gif';
//                 break;
//         }
//         // Chỉ cho phép upload file ảnh JPG/JPEG, PNG hoac GIF
//         if ($ext == '') {
//             alert('Không cho phép upload file khác các đuôi sau: JPG, PNG, GIF');
//             exit;
//         }
//         $maxfilesize = 10485760; //10(MB)
//         // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
//         if ($_FILES[$n]['size'] > $maxfilesize) {
//             alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
//         }
    
//         // Đặt tên file ảnh
//         $thumb = $n.'-' . date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
    
//         // Tạo thư mục image nếu chưa có
//         // if (!is_dir($target_dir_user)) {
//         //     mkdir($target_dir_user, 777);
//         // }
//         // chmod($target_dir_user, 777);   // decimal; probably incorrect
//         // chmod($target_dir_user, "u+rwx,go+rx"); // string; incorrect
//         // chmod($target_dir_user, 0777);  // octal; correct value of mode
//         alert(move_uploaded_file($_FILES[$n]['tmp_name'], $target_dir_user . $thumb) ? 'Upload thành công' : 'Có lỗi xảy ra');
//     }
// }


function upload($file,$folder,$types = array('.jpg','.png','.gif'),$size = 2,&$msg = '')
{
    // Kiểm tra file hợp lệ: đã được đưa lên server
    if(isset($file['error']) && $file['error'] ==0)
    {      
        // Kiểm tra loại file
        $ext = strtolower(substr($file['name'],strrpos($file['name'],'.'))); //=> '.jpg'
        if(in_array($ext,$types))
        {
            $maxsize = $size * 1024 * 1024;
            if($file['size']  >0 && $file['size'] <= $maxsize)
            { 
                // Cho phép upload
                $fullpath = $folder.'images_'.date('YmdHis').'_'.rand(0,999999).$ext; //files//file_238465237465237.jpg
                if(move_uploaded_file($file['tmp_name'],$fullpath))
                    return $fullpath;
                else{
                    $msg ='Upload thất bại';
                    return false;
                }
            }else{
                $msg ='Kích thước tối đa là '.$size .'MB';
                return false;
            }
        }else{
            $msg ='Chỉ cho phép '. implode(',',$types);
            return false;
        }
    }else{
        $msg ='Quá trình upload file lên server thất bại';
        return false;
    }
}