<!doctype html>
<html lang="en-US">
<head>
    <link rel="shortcut icon" href="picture/book.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>login</title>
    <meta name="description" content=""/>
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]"/>

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext"
          rel="stylesheet" type="text/css"/>

    <!-- CORE CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- THEME CSS -->
    <link href="assets/css/essentials.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme"/>
</head>
<!--
    .boxed = boxed version
-->
<body>
<div class="container" style="font-family: 'Kanit', sans-serif;">

    <div class="login-box">

        <!-- login form -->
        <form action="index.php" method="post" class="sky-form boxed">
            <header><i class="fa fa-users"></i> เข้าสู่ระบบ</header>

            <fieldset>

                <section>
                    <label class="label">Username</label>
                    <label class="input">
                        <i class="icon-append fa fa-envelope"></i>
                        <input type="email">
                        <span class="tooltip tooltip-top-right">Email Address</span>
                    </label>
                </section>

                <section>
                    <label class="label">Password</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password">
                        <b class="tooltip tooltip-top-right">Type your Password</b>
                    </label>
                    <label class="checkbox"><input type="checkbox" name="checkbox-inline" checked><i></i>Keep me logged
                        in</label>
                </section>

            </fieldset>

            <footer style="text-align: center">

                <button type="submit" class="btn btn-primary ">Sign In</button>
                <!-- <div class="forgot-password pull-left">
                     <a href="page-password.html">Forgot password?</a> <br/>
                     <a href="page-register.html"><b>Need to Register?</b></a>
                 </div>-->

            </footer>
        </form>
        <!-- /login form -->

        <hr/>
    </div>

</div>

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>