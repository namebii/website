<?php
// Xử lý đọc file txt thành mảng như trên
function loaddata_post($path)
{
    $file = fopen($path, 'r');
    $post = [];
    while (!feof($file)) {
        $str_posts = fgets($file); // Tách file thành nhiều dòng sản phẩm
        if ($str_posts) {
            $ar_posts = explode('|\|', $str_posts);
            if (count($ar_posts) == 6) {
                $post[$ar_posts[0]] = [
                    'post_thumb' => $ar_posts[1],
                    'name' => $ar_posts[2],
                    'category' => $ar_posts[3],
                    'time' => $ar_posts[4],
                    'author' => $ar_posts[5]
                ];
            }
        }
    }
    fclose($file);
    return $post;
}

// Xử lý ghi mảng ở trên thành file txt
function writedata_post($path, $post)
{
    $file = fopen($path, 'w');
    $content = '';
    foreach ($post as $postid => $posts) {
        $posts_thumb = $posts['post_thumb'];
        $name = $posts['name'];        
        $category = $posts['category'];
        $time = $posts['time'];
        $author = $posts['author'];
        $content .= "$postid|\|$posts_thumb|\|$name|\|$category|\|$time|\|$author\n";
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata_post($path);
}


/* Hàm thêm bài viết */
function add_post($postid, $posts_thumb, $name, $category, $time, $author, &$post)
{
    $target_dir = './images/posts/'; //Thư mục bạn sẽ lưu file upload
    $ext = '';
    if (!$postid || !$posts_thumb || !$name || !$category || !$time || !$author) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (isset($post[$postid])) {
        alert('Bài viết đã tồn tại');
    } else {
        if (isset($_FILES['posts_thumb'])) {
            // Lấy ra đuôi ảnh
            switch ($_FILES['posts_thumb']['type']) {
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
            if ($_FILES['posts_thumb']['size'] > $maxfilesize) {
                alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
            }

            // Đặt tên file ảnh
            $thumb = 'posts-'.date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
            // Tạo thư mục image nếu chưa có

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 777);
            }
            chmod($target_dir, 777);   // decimal; probably incorrect
            chmod($target_dir, "u+rwx,go+rx"); // string; incorrect
            chmod($target_dir, 0777);  // octal; correct value of mode
            alert(move_uploaded_file($_FILES['posts_thumb']['tmp_name'], $target_dir . $thumb) ? 'Upload thành công' : 'Có lỗi xảy ra');
        }
        $post[$postid] = ['posts_thumb' => $thumb, 'name' => $name, 'category' => $category, 'time' => $time, 'author' => $author];
        writedata_post('data/posts.txt', $post);
        header('location: index.php?click=posts');
    }
}

/* Hàm sửa bài viết */
function edit_post($postid, $posts_thumb, $name, $category, $time, $author, &$post)
{
    $target_dir = './images/posts/';
    $ext = '';
    if (!$postid || !$posts_thumb || !$name || !$category || !$time || !$author) {
        alert('Bạn nhập thông tin không đúng xin vui lòng kiểm tra lại');
    } elseif (!isset($post[$postid])) {
        alert('Bài viết không tồn tại');
    } elseif (isset($_FILES['posts_thumb']['error']) && $_FILES['posts_thumb']['error'] == 0) {
        unlink($target_dir . $post[$postid]['posts_thumb']);
        // Lấy ra đuôi ảnh
        switch ($_FILES['posts_thumb']['type']) {
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
        if ($_FILES['posts_thumb']['size'] > $maxfilesize) {
            alert('Không được upload ảnh lớn hơn ' . $maxfilesize . ' (bytes)');
        }

        // Đặt tên file ảnh
        $thumb = 'posts-'.date('YmdHis') . '-' . rand(100000, 999999) . '.' . $ext;
        // Tạo thư mục image nếu chưa có

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 777);
        }
        chmod($target_dir, 777);   // decimal; probably incorrect
        chmod($target_dir, "u+rwx,go+rx"); // string; incorrect
        chmod($target_dir, 0777);  // octal; correct value of mode
        alert(move_uploaded_file($_FILES['posts_thumb']['tmp_name'], $target_dir . $thumb) ? 'Upload thành công' : 'Có lỗi xảy ra');
        $post[$postid] = ['posts_thumb' => $thumb, 'name' => $name, 'category' => $category, 'time' => $time, 'author' => $author];
    } else {
        $post[$postid] = ['posts_thumb' => $thumb, 'name' => $name, 'category' => $category, 'time' => $time, 'author' => $author];
    }
}

/* Hàm xoá sản phẩm */
function remove_post($postid, &$post)
{
    $target_dir = './images/posts/';
    if (isset($post[$postid])) {
        unlink($target_dir . $post[$postid]['posts_thumb']);
        unset($post[$postid]);
    } elseif ($postid == '') {
        alert('Bạn nhập thông tin chưa đầy đủ');
    } else {
        alert('Bài viết không tồn tại');
    }
}
