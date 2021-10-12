<?php
    $version = '2.0.1'.time();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php if (isset($title)) {
    echo $title.' | ';
} ?>Causelist</title>

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $baseUrl ?>img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $baseUrl ?>img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $baseUrl ?>img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $baseUrl ?>img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $baseUrl ?>img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $baseUrl ?>img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $baseUrl ?>img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $baseUrl ?>img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $baseUrl ?>img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $baseUrl ?>img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $baseUrl ?>img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $baseUrl ?>img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $baseUrl ?>img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $baseUrl ?>img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $baseUrl ?>img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/lobipanel/lobipanel.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/separate/vendor/lobipanel.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/jqueryui/jquery-ui.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/separate/pages/widgets.min.css?v=<?php echo $version ?>">

    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/font-awesome/font-awesome.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/bootstrap/bootstrap.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/select2/select2.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/easyautocomplete/easy-autocomplete.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/bootstrap-sweetalert/sweetalert.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/separate/vendor/sweet-alert-animations.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/bootstrap-table/bootstrap-table.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/summernote/summernote.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/separate/pages/editor.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/lib/flatpickr/flatpickr.min.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/separate/vendor/flatpickr.min.css?v=<?php echo $version ?>">
    

    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/main.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/obd.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/bootstrap-multiselect.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css?v=<?php echo $version ?>">
    
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/yearpicker.css?v=<?php echo $version ?>">
    <script src="<?php echo $baseUrl ?>js/lib/jquery/jquery-3.2.1.min.js?v=<?php echo $version ?>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo $baseUrl ?>js/lib/popper/popper.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/tether/tether.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/bootstrap/bootstrap.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/select2/select2.full.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/list/list.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/bootstrap-sweetalert/sweetalert.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/plugins.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/bootstrap-table/bootstrap-table.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/summernote/summernote.min.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/lib/flatpickr/flatpickr.min.js?v=<?php echo $version ?>"></script>

    <script type="text/javascript" src="<?php echo $baseUrl ?>js/lib/jqueryui/jquery-ui.min.js?v=<?php echo $version ?>"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>js/lib/jquery-validation/jquery.validate.min.js?v=<?php echo $version ?>"></script>

    <script type="text/javascript" src="<?php echo $baseUrl ?>js/lib/lobipanel/lobipanel.min.js?v=<?php echo $version ?>"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>js/lib/match-height/jquery.matchHeight.min.js?v=<?php echo $version ?>"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>js/lib/easyautocomplete/jquery.easy-autocomplete.min.js?v=<?php echo $version ?>"></script>
    <script type="text/javascript" src="<?php echo $baseUrl ?>js/lib/bootstrap-notify/bootstrap-notify.min.js?v=<?php echo $version ?>"></script>
    
    <script type="text/javascript" src="<?php echo $baseUrl ?>js/jquery.bangla.js?v=<?php echo $version ?>"></script>

    <script src="<?php echo $baseUrl ?>js/app.js?v=<?php echo $version ?>"></script>
    <script src="<?php echo $baseUrl ?>js/yearpicker.js?v=<?php echo $version ?>"></script>

    <script src="<?php echo $baseUrl ?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $baseUrl ?>js/bootstrap-multiselect.js"></script>
    <script src="<?php echo $baseUrl ?>js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>

</head>
<body class="with-side-menu control-panel control-panel-compact">
    @include('layouts.header')
    @include('layouts.menu')

<div class="page-content bg-light">
    <div class="container-fluid">
        @include('layouts.nav-bar')
        @yield('content')
    </div>
</div>
<div class="wait-overlay">
    <div class="wait"><i class="fa fa-spin fa-spinner mr-2"></i> Please Wait</div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#datatable').DataTable({
            ordering:false,
            fixedHeader: {
                header: true,
                footer: false,
                headerOffset: 60
            }
        });
        
    });
</script>
</body>
</html>
