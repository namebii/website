<!doctype html>
<html lang="en">

<head>
    <title>Page Not Found! | Thiết kế website chuyên nghiệp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/style.css" type="text/css" rel="stylesheet">


    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
</head>

<body>
    <div>
        <!-- Header -->
        <div class="row">
            <div class="col-lg-2">
                <img src="images/logo.png" class="logo img-fluid">
            </div>
            <div class="col-lg-10" style="padding:0">
                <img src="images/banner.jpg" class="banner img-fluid">
            </div>
        </div>
        <!-- End Header -->

        <!-- Menu -->
        <div class="row">
            <div class="container menu" style="padding:0">
                <?php include "menu.php"; ?>
            </div>
        </div>
        <!-- End Menu -->

        <!-- Main -->
        <div class="row">
            <div class="col-lg-12 pl-0 pr-0 mt-3">
                <div id="dinhit-404">
                    <div id="rocket"></div>
                    <hgroup>
                        <h1>TRANG BẠN TRUY CẬP KHÔNG TỒN TẠI</h1>
                        <h2>Chúng tôi không thể tìm thấy kết quả bạn đang tìm kiếm.</h2>
                        <span>Bấm vào đây để quay về <a href="/"><strong>Trang Chủ</strong></a></span>
                        <p>Hoặc gọi vào số Hotline: <a style="color: red; font-weight: 600; font-size: 25px; font-family: dinhit; text-shadow: 1px 1px 0px #fff,-1px 2px 2px #fff;" href="tel:0965337117">0965.337.117</a></p>
                    </hgroup>

                </div>
            </div>
        </div>

        <!-- End Main -->
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
    <!-- End Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script>
        $(window).load(function() {
            // We are listening for the window load event instead of the regular document ready.
            function animSteam() {
                // Create a new span with the steam1, or steam2 class:
                $('<span>', {
                    className: 'steam' + Math.floor(Math.random() * 2 + 1),
                    css: {
                        // Apply a random offset from 10px to the left to 10px to the right
                        marginLeft: -10 + Math.floor(Math.random() * 20)
                    }
                }).appendTo('#rocket').animate({
                    left: '-=58',
                    bottom: '-=100'
                }, 120, function() {

                    // When the animation completes, remove the span and
                    // set the function to be run again in 10 milliseconds

                    $(this).remove();
                    setTimeout(animSteam, 10);
                });
            }

            function moveRocket() {
                $('#rocket').animate({
                        'left': '+=100'
                    }, 5000).delay(1000)
                    .animate({
                        'left': '-=100'
                    }, 5000, function() {
                        setTimeout(moveRocket, 1000);
                    });
            }
            // Run the functions when the document and all images have been loaded.
            moveRocket();
            animSteam();
        });
    </script>

</body>

</html>