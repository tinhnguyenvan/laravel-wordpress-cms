{!! !empty($config['code_header']) ? $config['code_header'] : ''  !!}
<style>
    {!! !empty($config[$theme.'_css']) ? $config[$theme.'_css'] : ''  !!}
</style>

@if(config('services.recaptcha.enable'))
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        function onSubmit(token) {
            document.getElementsByClassName("recaptcha")[0].submit();
        }
    </script>
@endif
