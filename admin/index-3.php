<?php
ob_start();
// include 'libs/functions.php';
// if (!islogin()) {
//     header('location: login.php');
// }
include './check.php';
$role = getRole();

if ($role == 'Administrator') {
    header('location: index.php');
} elseif ($role == 'Editor') {
    header('location: index2.php');
}

//nếu đang ở trang nào thì k cần check nó == quyền đó
/** 
 * h thế này nha, a đang có mấy vấn đề như sau, e xem sao nha
 * 1/ a đang tính chuyển value role thành 1 2 3 để dễ quản lý, và trong cái trang user thì nó chuyển value đó thành value text, administrator
 *  nàycần j làm v cho mệt
 * ok bỏ qua cái đó
 * cái thứ 2 a đang chưa hiểu chỗ này mất đâu cái admin, lý do bỏ nó ra và sang trang index 2 3 chẳng hạn thì vẫn là dòng code đó hay sao
 * sang index 2 tâng tự index 3
 * kiểu dang co quyen 1 thi khi a vao index k check cai quyen neu khac 1 thif cho nos nhay di trang khac conf ddung 1 thi k can check
 * 
 * ak y la no dang dung dieu kien 1 la no cho phep dang nhap luon, con neu false th ndodu nh
 * dung con ben trang login e dang sua cho nay phai k
 *  bua a co lam r ma, sao h mat tieu r, no dang nhan ten user chu dau phai ten cua no. thi cho do a sua laij thoi. conf k a lafm ntn cungx dc . lam v cho no logic hon ti
 * de a xem lai code, e dang lay la cai gi/
 * 
 */
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
            <?
                $click=$_GET['click']??'home'; 
                $path='pages/'.$click.'.php';
                if(file_exists($path))
                    include $path;
                else
                    include 'pages/404.php';
            ?>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <?include 'widgets/copyright.php'?>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <?include 'widgets/script.php'?>
</body>

</html>
<?php
ob_end_flush();
?>