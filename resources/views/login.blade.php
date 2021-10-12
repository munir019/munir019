<?php
$base_url = config('app.url');
$version = '1.0.1';
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title ?> | MyCourt</title>

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $base_url ?>img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $base_url ?>img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $base_url ?>img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $base_url ?>img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $base_url ?>img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $base_url ?>img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $base_url ?>img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $base_url ?>img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $base_url ?>img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $base_url ?>img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $base_url ?>img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $base_url ?>img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $base_url ?>img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $base_url ?>img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $base_url ?>img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?php echo $base_url ?>css/separate/pages/login.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/main.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/obd-login.css">
</head>
<body>

<div class="page-center">
    <div class="page-center-in text-center">
        <div class="container-fluid login">
            <div class="m-2 p-2">
                <img class="img-fluid" src="<?php echo $base_url ?>img/doptor-logo.png" alt="">
            </div>
            <form class="sign-box" method="post" action="<?php echo config('app.url') ?>auth">
                @csrf
                <div class="text-center mb-3 hidden">
                    <img src="<?php echo $base_url ?>img/logo.png" alt="">
                </div>
                <div class="form-group mt-4">
                    <label class="mb-2">ইউজার আইডি</label>
                    <input type="text" class="form-control" placeholder="User ID" name="userid" autocomplete="off"/>
                </div>
                <div class="form-group mt-4">
                    <label class="mb-2">পাসওয়ার্ড</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off"/>
                </div>
                <?php
                if(session('error')){
                    echo '<div class="alert alert-danger en-font">';
                    echo session('error');
                    echo '</div>';
                }
                ?>
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-rounded d-inline-block bn-font">প্রবেশ করুন</button>
                </div>
            </form>
        </div>
        <div class="mt-4 p-2">
            <img class="logo-set" src="img/logo-set.png" />
        </div>
    </div>
</div>

<script src="<?php echo $base_url ?>js/lib/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo $base_url ?>js/lib/popper/popper.min.js"></script>
<script src="<?php echo $base_url ?>js/lib/tether/tether.min.js"></script>
<script src="<?php echo $base_url ?>js/lib/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>js/plugins.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>js/lib/match-height/jquery.matchHeight.min.js"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function(){
            setTimeout(function(){
                $('.page-center').matchHeight({ remove: true });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            },100);
        });

        $('input[name="userid"]').keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 46 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105));
        });

        $('input[name="userid"]').on('blur',function(){
            var uid = uidf = uide = '';
            if($(this).length<12  && !isNaN($(this).val())){
                uid = $(this).val();
                uidf = uid[0];
                uide = uid.substr(1,uid.length);
                for(var i=uid.length;i<12;i++)
                    uidf = uidf + '0';
                $(this).val(uidf+uide);
            }
        });
    });
</script>
<script src="<?php echo $base_url ?>js/app.js"></script>
</body>
</html>