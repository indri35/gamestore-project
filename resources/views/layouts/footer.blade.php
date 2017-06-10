    <!-- Jquery Core Js -->
    <script src="{{ ('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ ('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ ('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ ('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ ('assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ ('assets/js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ ('assets/js/demo.js') }}"></script>

    <script src="{{ ('assets/js/SimpleStarRating.js') }}"></script>
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