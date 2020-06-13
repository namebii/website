<?php
ob_start();
include 'libs/functions.php';
if (!islogin()) {
    header('location: login.php');
}
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