<footer class="app-footer">
    <div>
        <a href="{{ env('APP_URL_AUTHOR','') }}" target="_blank">CMS Admin</a>
        <span>&copy; <?= date('Y') ?> .</span>
    </div>
    <div class="ml-auto">
        <span>Powered by</span>
        <a target="_blank" href="{{ env('APP_URL_AUTHOR','') }}">{{ env('APP_NAME') }}</a>
    </div>
</footer>
