<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="{{ !empty($description) ? $description : '' }}">
    <meta name="author" content="TWEB.COM.VN">
    <meta name="keyword" content="{{ !empty($keyword) ? $keyword : '' }}">
    <title>{{ !empty($title) ? $title : '' }}</title>

    <link rel="shortcut icon" href="{{ !empty($config['favicon']) ? $config['favicon'] : base_url('favicon.ico') }}"
          type="image/x-icon">
    <link rel="icon" href="{{ !empty($config['favicon']) ? $config['favicon'] : base_url('favicon.ico') }}"
          type="image/x-icon">
</head>
<title>Trang bạn đang tìm không tồn tại - Haravan</title>
<style>
    body {
        background: url("{{ asset("common/img/sativa.png") }}");
    }

    .container {
        max-width: 550px !important;
        margin: 50px auto;
    }

    #wrapper {
        background: rgba(255, 255, 255, 0.9);
        -webkit-border-radius: 0.5em;
        border-radius: 0.5em;
        padding: 30px;
        overflow: hidden;
        -moz-box-shadow: 0px 0px 5px #cfcfcf;
        -webkit-box-shadow: 0px 0px 5px #cfcfcf;
        box-shadow: 0px 0px 5px #cfcfcf;
        margin-bottom: 50px;
    }

    #wrapper img {
        margin: 20px;
        max-width: 100%;
    }

    header {
        display: block;

        padding: 1em 1.5em 1em 1.5em;
        margin: 0em 0em 2em;

        -webkit-border-radius: 0.4em 0.4em 0 0;
        border-radius: 0.4em 0.4em 0 0;
        -webkit-box-shadow: inset 0 -1px 0 0 rgba(30, 47, 62, 0.0);
        box-shadow: inset 0 -1px 0 0 rgba(30, 47, 62, 0.0);
    }

    header h3 {
        color: #363D47;
        font-size: 2em;
        margin: 0;
    }

    header h3 a {
        line-height: 1.3em;
    }

    .tab-content-wrapper {
        position: relative;
    }

    .tb-content {
        margin: 0;
        padding: 0;
        overflow: hidden;
    }


    article {
        text-align: center;
        padding: 0;
    }

    #wrapper article h1, #wrapper article h4 {
        text-align: center;
        font-weight: 400;
        margin-top: 0;
        font-size: 1.5em;
    }


    footer {
        overflow: hidden;
        text-align: center;
        color: #a4a2a2;
        margin-top: 15px;
    }

    footer a, footer a:hover {
        margin: 5px;
        color: #0094ff;
        text-decoration: none;
    }

    @media screen and (max-width: 400px) {

        #wrapper {
            padding: 15px;

        }

        #wrapper img {
            margin-left: 0;
            margin-right: 0;
        }
    }
</style>
</head>
<body>
<div class="slide-wrapper">
    <div class="container">
        <div id="wrapper">
            <article>
                <!-- Tab panes -->
                <div class="tab-content-wrapper">
                    <div class="tb-content active" id="home">
                        <div class="box">
                            <h4>Thật đáng tiếc trang này hiện không tồn tại !</h4>
                            <img src="{{ asset("common/img/404.png") }}" alt="404"/>
                            <p>
                                Các trang web mà bạn đang tìm kiếm đã được di chuyển, xóa, đổi tên hoặc chưa bao giờ tồn
                                tại. <a href="{{ base_url() }}">Click về trang chủ</a>
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
</body>
</html>
