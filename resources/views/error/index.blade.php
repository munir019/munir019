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
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/error.css?v=<?php echo $version ?>">

    @include('common.js')
    @include('common.favicon')
</head>
<body>
    <div class="container-fluid">
        <div class="error-page">
            <div class="row flex-grow">
                <div class="col-lg-8 mx-auto text-white">
                    <div class="row align-items-center d-flex flex-row">
                        <div class="col-lg-6 text-lg-right pr-lg-4">
                            <h1 class="error-code mb-0"><?php echo $code ?></h1>
                        </div>
                        <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                            <h2>Sorry!</h2>
                            <h3 class="font-weight-light"><?php echo $message ?></h3>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-center mt-xl-2">
                            <a class="text-white font-weight-medium" href="<?php echo $baseUrl ?>">Back to home</a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 mt-xl-2">
                            <p class="text-white font-weight-medium text-center">Copyright &copy; 2021  All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
