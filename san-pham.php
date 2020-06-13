<?php
session_start();
include '../../functions.php';
if (!islogin()) {
    header('location: login.php');
}
$mang = loaddata('data/san-pham.txt');

// Xử lý đọc file txt thành cái mảng như trên
function loaddata($path)
{
    $file = fopen($path, 'r');
    $mang = [];
    while (!feof($file)) {
        $strsp = fgets($file); // Tách file thành nhiều dòng sản phẩm
        if ($strsp) {
            $arsp = explode('|', $strsp);
            if (count($arsp) == 4) {
                $mang[$arsp[0]] = [
                    'ten' => $arsp[1],
                    'don_gia' => (float) $arsp[2],
                    'so_luong' => (float) $arsp[3],
                    'thanh_tien' => (float) $arsp[2] * (float) $arsp[3]
                ];
            }
        }
    }
    fclose($file);
    return $mang;
}

// Xử lý ghi cái mảng ở trên thành file txt
function writedata($path, $mang)
{
    //001|san pham 1|2000|10
    $file = fopen($path, 'w');
    $content = '';
    foreach ($mang as $ma => $sp) {
        $ten = $sp['ten'];
        $gia = $sp['don_gia'];
        $soluong = $sp['so_luong'];
        $content .= "$ma|$ten|$gia|$soluong\n";
    }
    fwrite($file, $content);
    fclose($file);
    return loaddata($path);
}

// In mảng ra để phân tích

/* Hàm thêm sản phẩm */
function them($masp, $ten, $dongia, $soluong, &$mang)
{
    if (isset($mang[$masp])) {
        $tb = 'Sản phẩm đã tồn tại';
    } elseif ($masp == '' || $ten == '' || $dongia == '' || $soluong == '') {
        $tb = 'Bạn nhập thông tin chưa đầy đủ';
    } else {
        $mang[$masp] = ['ten' => $ten, 'don_gia' => $dongia, 'so_luong' => $soluong, 'thanh_tien' => $dongia * $soluong];
    }
}

/* Hàm sửa sản phẩm */
function sua($masp, $soluong, &$mang)
{
    if (isset($mang[$masp])) {
        $mang[$masp]['so_luong'] = $soluong;
        $mang[$masp]['thanh_tien'] = $soluong * $mang[$masp]['don_gia'];
    } elseif ($masp == '' || $soluong == '') {
        echo 'Bạn nhập thông tin chưa đầy đủ';
    } else {
        echo 'Sản phẩm không tồn tại';
    }
}

/* Hàm xoá sản phẩm */
function xoa($masp, &$mang)
{
    if (isset($mang[$masp])) {
        unset($mang[$masp]);
    } elseif ($masp == '') {
        echo 'Bạn nhập thông tin chưa đầy đủ';
    } else {
        echo 'Sản phẩm không tồn tại';
    }
}

if (isset($_POST['hanhdong'])) {
    switch ($_POST['hanhdong']) {
        case 'Thêm':
            them($_POST['ma'], $_POST['ten'], $_POST['don_gia'], $_POST['so_luong'], $mang);
            break;
        case 'Sửa':
            sua($_POST['ma'], $_POST['so_luong'], $mang);
            break;
        case 'Xoá':
            xoa($_POST['ma'], $mang);
            break;
    }
    $mang = writedata('data/san-pham.txt', $mang);
}
// xemmang($mang);
?>
<!DOCTYPE html>
<html lang="en">

<?include 'widgets/head.php'?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- sidebar menu -->
            <?include 'widgets/menu.php'?>
            <!-- /sidebar menu -->

            <!-- top navigation -->
            <?include 'widgets/top-navigation.php'?>
            <!-- /top navigation -->

            <!-- page content -->
            <?include 'widgets/product.php'?>
            <!-- /page content -->

        </div>
    </div>

    <?include 'widgets/script.php'?>
</body>

</html>