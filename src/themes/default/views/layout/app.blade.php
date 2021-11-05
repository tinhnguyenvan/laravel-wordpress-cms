<!DOCTYPE html>
<html lang="en">
<head>
    @include('site.element.head')
    @include('layout.default.layout.head')
</head>

<body id="page-top">
@include('layout.default.layout.header')
@include('layout.default.layout.sidebar')
<section>@yield('content')</section>
@include('layout.default.layout.footer')
@include('site.element.alert')
</body>
</html>
