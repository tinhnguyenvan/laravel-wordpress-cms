<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">Copyright &copy; {{ date('Y') }} - TWEB.COM.VN</div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset("layout/default/vendor/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("layout/default/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("layout/default/vendor/jquery-easing/jquery.easing.min.js") }}"></script>
<script src="{{ asset("layout/default/vendor/magnific-popup/jquery.magnific-popup.min.js") }}"></script>
<script src="{{ asset("layout/default/js/creative.min.js") }}"></script>
{!! !empty($config['code_footer']) ? $config['code_footer'] : ''  !!}