<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 13:01:33 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo  base_url( APP_ICON); ?>">
    <title><?php echo APP_NAME; ?></title>
    <!-- Bootstrap Core CSS -->

    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url('assets/css/colors/default.css'); ?>" id="theme"  rel="stylesheet">


</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="alerttopright" class="myadmin-alert alert-danger myadmin-alert-top-right"><a href="#" class="closed">&times;</a>
    <h4>Oops error!</h4> <p id="error_msg"></p>
</div>
<section id="wrapper" class="new-login-register">
    <div class="lg-info-panel">
        <div class="inner-panel">
            <a href="javascript:void(0)" class="p-20 di"><img src="<?php echo base_url('assets/plugins/images/admin-logo.png'); ?>" /></a>
            <div class="lg-content">
                <h2>Majabulakuphakwa System</h2>
                <img src="<?php echo base_url('assets/plugins/images/site.jpg'); ?>" alt="home" class="" />
                <img src="<?php echo base_url('assets/plugins/images/truck.jpg'); ?>" alt="home" class="" />
                </div>
        </div>
    </div>
    <div class="new-login-box">
        <div class="white-box">
            <h3 class="box-title m-b-0">Sign In to Admin</h3>
            <small>Enter your details below</small>
            <form class="form-horizontal new-lg-form" id="loginform" action="" method="POST">

                <?php
                    if($error === true){
                        echo ' <div class="form-group  m-t-20">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        '. $message .'
                                    </div>
                                </div>';
                    }
                ?>

                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                        <label>Email Address</label>
                        <input id="email" name="email" class="form-control" type="text"  value="admin@majabs.co.za" placeholder="Username" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Password</label>
                        <input id="password" name="password" class="form-control" type="password"  value="123" placeholder="Password" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-info pull-left p-t-0">
                            <input name="chkRememberMe" id="checkbox-signin" type="checkbox" value="1" />
                            <label for="checkbox-signin"> Remember me </label>
                        </div>
                        <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" name="btnLogin" type="submit">Log In</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


</section>
<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js'); ?>"></script>

<!--slimscroll JavaScript -->
<script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>

<!--Wave Effects -->
<script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>
<!--Style Switcher -->
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/toast-master/js/jquery.toast.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastr.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/klubbars/login.js'); ?>"></script>

<script type="text/javascript">
    //Alerts
    $(".myadmin-alert .closed").click(function(event) {
        $(this).parents(".myadmin-alert").fadeToggle(350);
        return false;
    });
    /* Click to close */
    $(".myadmin-alert-click").click(function(event) {
        $(this).fadeToggle(350);
        return false;
    });
</script>
</body>

<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 13:01:34 GMT -->
</html>
