    <!-- Jquery Core Js -->
    <script src="{{ URL::to('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ URL::to('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ URL::to('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ URL::to('assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ URL::to('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ URL::to('assets/js/admin.js') }}"></script>

    <!--<script src="{{ URL::to('assets/js/demo.js') }}"></script> -->

    <script src="{{ URL::to('assets/js/SimpleStarRating.js') }}"></script>
        <script>
            var ratings = document.getElementsByClassName('rating');

            for (var i = 0; i < ratings.length; i++) {
                var r = new SimpleStarRating(ratings[i]);

                ratings[i].addEventListener('rate', function(e) {
                    console.log('Rating: ' + e.detail);
                });
            }
        </script>
</body>

</html>