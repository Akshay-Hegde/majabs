<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/plugins/images/favicon.png'); ?>">
    <title> <?php echo APP_NAME.'-Change Password'; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css'); ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bower_components/switchery/dist/switchery.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/multiselect/css/multi-select.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url('assets/css/zela.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/colors/megna-dark.css'); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo base_url('assets/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">
</head>

<body class="fix-header">
<div id="wrapper">
    <?php

        $employee = $this->session->userdata(Utils::$USER_DATA);

        $sideNav = '';
        $topNav = '';

        if((int)$employee['role'] === 1){
            $topNav = APP_VIEWS."navigations/top-nav.php";
            $sideNav = APP_VIEWS."navigations/side-nav.php";
        }elseif ((int)$employee['role'] === 2){
            $topNav = APP_VIEWS."supervisor/navigation/top-nav.php";
            $sideNav = APP_VIEWS."supervisor/navigation/side-nav.php";
        }elseif ((int)$employee['role'] === 3){
            $topNav = APP_VIEWS."manager/navigation/top-nav.php";
            $sideNav = APP_VIEWS."manager/navigation/side-nav.php";
        }else{
            $topNav = APP_VIEWS."employee/navigation/top-nav.php";
            $sideNav = APP_VIEWS."employee/navigation/side-nav.php";
        }

        require_once ($topNav);
        require_once ($sideNav);
    ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">My Details</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active">Change password</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <form class="form-material form-horizontal" id="frmChangePassword" action="<?php echo base_url('Employee/changePassword'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="panel panel-info">

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"> Current Password <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="password" id="current-password" name="current_password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"> New Password <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="password" id="new-password" name="password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"> Confirm Password <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="password" id="confirm-password" name="confirm_password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button name="btnChangePassword" id="btnChangePassword" type="submit" class="btn btn-block btn-success btn-lg btn-block">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--col end-->
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="row show-grid">
                                            <div class="col-lg-8 col-md-8 col-md-offset-2 text-info">  Tips for a good password
                                                <br>
                                                Use both upper and lowercase characters
                                                Include at least one of these symbols below
                                                <br/>
                                                ( ._#-=!@&* )
                                                <br>
                                                Don't use dictionary words
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <footer class="footer text-center"><?php echo APP_FOOTER; ?></footer>
    </div>
</div>

<script src="<?php echo base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/moment/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/calendar/dist/cal-init.js'); ?>"></script>
<script src='<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bower_components/multiselect/js/jquery.multi-select.js'); ?>'></script>
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/majabs/employee.js'); ?>" type="text/javascript"></script>

</body>
</html>