<?php
/**
 * User: Md. Munir Hossain
 */
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        @include('common.head')
        @include('common.css')
        <link rel="stylesheet" href="<?php echo $baseUrl ?>css/feather.css?v=<?php echo $version ?>">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>css/theme-style.css?v=<?php echo $version ?>">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>css/style.css?v=<?php echo $version ?>">
        @include('common.js')
        
        @include('common.favicon')
    </head>
    <body>
        <div class="horizontal-menu">
            @include('layouts.header')
            @include('layouts.menu')
        </div>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </body>
</html>