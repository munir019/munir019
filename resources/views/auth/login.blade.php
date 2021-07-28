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
    <link rel="stylesheet" href="<?php echo $baseUrl ?>css/login.css?v=<?php echo $version ?>">

    @include('common.js')
    <script src="<?php echo $baseUrl ?>js/login.js?v=<?php echo $version ?>"></script>
    @include('common.favicon')
</head>
<body>
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-400 modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100">
                        <img class="" src="<?php echo $baseUrl ?>img/logo.png" title="Orange News Panel Logo"/>
                    </h5>
                </div>
                <form action="<?php echo $baseUrl ?>auth" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" name="user_id" class="form-control" autocomplete="off" placeholder="Email or Mobile or User Id" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
