<!-- jQuery -->
<script src="template/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="template/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="template/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="template/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="template/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="template/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="template/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="template/vendors/Flot/jquery.flot.js"></script>
<script src="template/vendors/Flot/jquery.flot.pie.js"></script>
<script src="template/vendors/Flot/jquery.flot.time.js"></script>
<script src="template/vendors/Flot/jquery.flot.stack.js"></script>
<script src="template/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="template/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="template/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="template/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="template/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="template/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="template/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="template/vendors/moment/min/moment.min.js"></script>
<script src="template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="template/build/js/custom.min.js"></script>

<!-- <script src="../js/jquery.min.js"></script> -->
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