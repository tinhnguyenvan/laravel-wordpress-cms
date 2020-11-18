<!DOCTYPE html>
<html lang="en">
<head>
    <title>Install onboarding website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset("site/css/install.css") }}" rel="stylesheet"/>
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
    <script src="{{ asset("site/js/jquery-2.1.1.min.js") }}" type="text/javascript"></script>
</head>
<body>
<div class="main">
    <h1>Install onboarding website</h1>
    <div class="content">
        <div class="stepsForm">
            <form method="post" action="{{ base_url('install') }}">
                @csrf
                <div class="sf-steps">
                    <div class="sf-steps-content">
                        <div>
                            <span></span> Common
                        </div>
                        <div>
                            <span></span> Account
                        </div>
                    </div>
                </div>
                <div class="sf-steps-form sf-radius">

                    <ul class="sf-content">
                        <li>
                            <div class="sf_columns column_3">
                                <label>
                                    <input type="text" name="company_name" placeholder="Company Name"
                                           data-required="true">
                                </label>
                            </div>
                            <div class="sf_columns column_3">
                                <label>
                                    <input type="text" name="company_email" placeholder="Company Email"
                                           data-required="true">
                                </label>
                            </div>
                        </li>
                    </ul>

                    <ul class="sf-content"> <!-- form step two -->
                        <li>
                            <div class="sf_columns column_3">
                                <label>
                                    <input type="text" placeholder="Username" data-required="true">
                                </label>
                            </div>
                            <div class="sf_columns column_3">
                                <label>
                                    <input type="text" placeholder="Email" data-required="true" data-email="true">
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="sf_columns column_3">
                                <label>
                                    <input type="password" placeholder="Password" data-required="true"
                                           data-confirm="true">
                                </label>
                            </div>
                            <div class="sf_columns column_3">
                                <label>
                                    <input type="password" placeholder="Re-Type Password" data-required="true"
                                           data-confirm="true">
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="sf-steps-navigation sf-align-right">
                    <span id="sf-msg" class="sf-msg-error"></span>
                    <button id="sf-prev" type="button" class="sf-button">Previous</button>
                    <button id="sf-next" type="button" class="sf-button">Next</button>
                </div>
            </form>
            <script>
                $(document).ready(function (e) {
                    $(".stepsForm").stepsForm({
                        width: '100%',
                        active: 0,
                        errormsg: 'Check faulty fields.',
                        sendbtntext: 'Create Account',
                        posturl: '{{ base_url('install') }}'
                    });

                    $(".container .themes>span").click(function(e) {
                        $(".container .themes>span").removeClass("selectedx");
                        $(this).addClass("selectedx");
                        $(".stepsForm").removeClass().addClass("stepsForm");
                        $(".stepsForm").addClass("sf-theme-"+$(this).attr("data-value"));
                    });
                });
            </script>
        </div>
    </div>
    <p class="footer">
        Copyright &copy; <?= date('Y') ?> {{ env('APP_NAME') }}
    </p>
</div>
</body>
</html>