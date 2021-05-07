<!DOCTYPE html>
<html lang="en">
<head>
    @include('site.element.head')
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link href="{{ asset("site/css/materialize.min.css") }}" rel="stylesheet" media="screen,projection"/>
    <style type="text/css">
        nav ul a,
        nav .brand-logo {
            color: #444;
        }

        .nav-wrapper li a.active {
            background: #0a76b7;
            color: #fff;
        }
        p {
            line-height: 2rem;
        }

        .sidenav-trigger {
            color: #26a69a;
        }

        footer.page-footer {
            margin: 0;
        }

    </style>

</head>

<body>
<div class="navbar-fixed">
<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="{{ base_url('tool/icon-facebook') }}" class="brand-logo">👋 Welcome</a>
        <ul class="right hide-on-med-and-down">
            <li><a class="@if(request()->fullUrl() == base_url('tool/icon-facebook')) active @endif" href="{{ base_url('tool/icon-facebook') }}">🔎 Icon Facebook</a></li>
            <li><a class="@if(request()->url() == base_url('tool/generate-qrcode')) active @endif" href="{{ base_url('tool/generate-qrcode') }}">📌 Generate QR Code</a></li>
        </ul>

        <ul id="nav-mobile" class="sidenav">
            <li><a href="{{ base_url('tool/emoji') }}">Icon facebook</a></li>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>
</div>

<div class="container">
    <div class="section">

        @yield('content')

    </div>
</div>


<footer class="page-footer teal">
    <!--
   <div class="container">
       <div class="row">
           <div class="col l6 s12">
               <h5 class="white-text">Company Bio</h5>
               <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's
                   our full time job. Any amount would help support and continue development on this project and is
                   greatly appreciated.</p>
           </div>
           <div class="col l3 s12">
               <h5 class="white-text">Settings</h5>
               <ul>
                   <li><a class="white-text" href="#!">Link 1</a></li>
                   <li><a class="white-text" href="#!">Link 2</a></li>
                   <li><a class="white-text" href="#!">Link 3</a></li>
                   <li><a class="white-text" href="#!">Link 4</a></li>
               </ul>
           </div>
           <div class="col l3 s12">
               <h5 class="white-text">Connect</h5>
               <ul>
                   <li><a class="white-text" href="#!">Link 1</a></li>
                   <li><a class="white-text" href="#!">Link 2</a></li>
                   <li><a class="white-text" href="#!">Link 3</a></li>
                   <li><a class="white-text" href="#!">Link 4</a></li>
               </ul>
           </div>
       </div>
   </div>-->
    <div class="footer-copyright">
        <div class="container">
            Made by <a style="color: #ffd655" href="https://tweb.com.vn">Tình Nguyễn</a>
            | VPS sử dụng <a style="color: #ffd655" href="http://bit.ly/2kAezij" target="_blank">INET</a>
            | Made with 💞 in Long An
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset("site/js/materialize.min.js") }}"></script>
<script src="{{ asset("site/js/clipboard.min.js") }}" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

    /**
     * check all for all list data
     */
    if ($('.clipboard').length > 0) {
        let clipboard = new ClipboardJS('.clipboard');
        clipboard.on('success', function (e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);

            e.clearSelection();
        });

        clipboard.on('error', function (e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
    }
</script>
</body>
</html>
