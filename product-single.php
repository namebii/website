<!doctype html>
<html lang="en">

<head>
    <title>Sản phẩm 1 | Thiết kế website chuyên nghiệp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
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
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <!-- Breadcumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="http://localhost/module1/home.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="http://localhost/module1/product-category.php">Danh mục sản phẩm</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sản phẩm 1</li>
                        </ol>
                    </nav>
                    <div class="product-main">
                        <div class="row">
                            <div class="large-5 col">
                                <div class="product-images">
                                    <div class="badge-container">
                                        <div class="badge-inner">
                                            <span class="onsale">-10%</span>
                                        </div>
                                    </div>
                                    <div class="product-viewport">
                                        <img src="images/no-image.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="product-info col">
                                <h1 class="product-title">Sản phẩm 1</h1>
                                <div class="is-divider small"></div>
                                <div class="price-wrapper">
                                    <div class="price-wrapper">
                                        <p class="price product-page-price price-on-sale">
                                            <del><span class="woocommerce-Price-amount amount">100.000<span class="woocommerce-Price-currencySymbol">₫</span></span></del>
                                            <ins><span class="woocommerce-Price-amount amount">90.000<span class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                        </p>
                                    </div>
                                </div>
                                <form class="cart" action="#" method="post" enctype="multipart/form-data">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus button is-form">
                                        <input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="9999" name="quantity" value="1" title="SL" size="4" inputmode="numeric">
                                        <input type="button" value="+" class="plus button is-form"></div> 
                                        <button type="submit" name="add-to-cart" value="" class="single_add_to_cart_button button alt">Mua hàng</button>
                                        <button onclick="" type="submit" name="add-to-cart" value="" class="single_add_to_cart_button button alt">Gọi ngay</button>                                
                                </form>
                                <div class="product-short-description">Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts.</div>
                                <div class="product_meta"> <span class="posted_in">Danh mục: <a href="#" rel="tag">Danh mục sản phẩm 1</a>, <a href="#" rel="tag">Danh mục sản phẩm 2</a></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-footer">
                        <div class="container">
                            <div class="product-tab">
                                <ul>
                                    <li class="active">Mô tả</li>
                                    <li>Thông số kỹ thuật</li>
                                    <li>Đánh giá</li>
                                </ul>
                            </div>
                            <div class="tab-panels">
                                <p>Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts. Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts. Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts.</p>
                            </div>
                        </div>

                        <div class="related related-products-wrapper">
                            <h2>Sản phẩm liên quan</h2>
                            <div class="owl-carousel owl-theme">
                                <div class="card first">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 1">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 1</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card instock">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 2">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 2</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card instock">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 3</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card last">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 4">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 4</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card first">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 5">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 5</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card instock">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 6">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 6</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card instock">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 7">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 7</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                                <div class="card last">
                                    <a href="product-single.php">
                                        <img src="images/no-image.jpg" class="card-img-top" alt="Sản phẩm 8">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Sản phẩm 8</h5>
                                            <p class="card-text price">1.000.000 VND</p>
                                            <button type="button" class="btn btn-success">Đặt hàng</button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="product-single-sidebar">
                        <h3 class="product-sidebar-box">Hiện 15 cửa hàng có sẵn sản phẩm</h3>
                        <p><strong>Cửa hàng còn hàng (Bấm vào địa chỉ để xem bản đồ)</strong></p>
                        <select>
                            <option>Quận/Huyện</option>
                            <option>Quận 1</option>
                            <option>Quận 2</option>
                            <option>Quận 3</option>
                        </select>
                    </div>
                    <div class="product-single-sidebar">
                        <h3 class="product-sidebar-title">Tình trạng</h3>
                        <ul class="list-group policy">
                            <li class="list-group-item">Mới 100%</li>
                            <li class="list-group-item">Full phụ kiện</li>
                            <li class="list-group-item">Chính hãng bảo hành 12 tháng</li>
                        </ul>
                    </div>
                    <div class="product-single-sidebar">
                        <h3 class="product-sidebar-title">Chính sách</h3>
                        <ul class="list-group policy">
                            <li class="list-group-item">Hướng dẫn đặt hàng</li>
                            <li class="list-group-item">Hướng dẫn thanh toán</li>
                            <li class="list-group-item">Chính sách bảo hành</li>
                            <li class="list-group-item">Chính sách đổi trả</li>
                        </ul>
                    </div>

                    <div class="product-single-sidebar">
                        <h3 class="product-sidebar-title">Danh mục sản phẩm</h3>
                        <ul class="list-group product-category-list">
                            <li class="list-group-item">Cras justo odio</li>
                            <li class="list-group-item">Dapibus ac facilisis in</li>
                            <li class="list-group-item">Morbi leo risus</li>
                            <li class="list-group-item">Porta ac consectetur ac</li>
                            <li class="list-group-item">Vestibulum at eros</li>
                        </ul>
                    </div>
                    <div class="product-single-sidebar">
                        <h3 class="product-sidebar-title">Sản phẩm vừa xem</h3>
                        <div class="content">
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 65px; padding: 5px 0px;">
                                            <a href="#"><img style="width: 100%;" src="images/no-image.jpg" title=""></a>
                                        </td>
                                        <td style="padding: 5px 0px 5px 5px;">
                                            <a href="#">
                                                <h3>Sản phẩm 2</h3>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 65px; padding: 5px 0px;">
                                            <a href="#"><img style="width: 100%;" src="images/no-image.jpg" title=""></a>
                                        </td>
                                        <td style="padding: 5px 0px 5px 5px;">
                                            <a href="#">
                                                <h3>Sản phẩm 3</h3>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 65px; padding: 5px 0px;">
                                            <a href="#"><img style="width: 100%;" src="images/no-image.jpg" title=""></a>
                                        </td>
                                        <td style="padding: 5px 0px 5px 5px;">
                                            <a href="#">
                                                <h3>Sản phẩm 4</h3>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 65px; padding: 5px 0px;">
                                            <a href="#"><img style="width: 100%;" src="images/no-image.jpg" title=""></a>
                                        </td>
                                        <td style="padding: 5px 0px 5px 5px;">
                                            <a href="#">
                                                <h3>Sản phẩm 5</h3>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 65px; padding: 5px 0px;">
                                            <a href="#"><img style="width: 100%;" src="images/no-image.jpg" title=""></a>
                                        </td>
                                        <td style="padding: 5px 0px 5px 5px;">
                                            <a href="#">
                                                <h3>Sản phẩm 6</h3>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-default btn-sm" style="display: block;width: 100%;margin-top: 10px;">Xem thêm</a>
                        </div>                        
                    </div>
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
    <script src="js/owl.carousel.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        })
    </script>

</body>

</html>