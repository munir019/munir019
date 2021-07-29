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
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $baseUrl ?>css/app.css?v=<?php echo $version ?>">

        @include('common.js')
        
        @include('common.favicon')
    </head>
    <body>
        @include('layouts.header')
        @include('layouts.menu')
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