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
    <title> <?php echo APP_NAME.'-Apply leave'; ?></title>
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

    include APP_VIEWS."supervisor/navigation/top-nav.php";
    include APP_VIEWS."supervisor/navigation/side-nav.php";
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">My Details</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active">Apply for Leave</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <form class="form-material form-horizontal" id="frmApplyLeave" action="<?php echo base_url('Leave/applyLeave'); ?>" method="POST">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <h3 class="panel panel-heading">Request for a leave</h3>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-sm-12">Leave Type</label>
                                        <div class="col-sm-12">
                                            <select name="leave_type" id="leave-type" class="form-control leaves">
                                                <option selected>-----select leave type-----</option>
                                                <?php

                                                    if($leaves !== null){
    
                                                        foreach ($leaves as $leave){

                                                            echo
                                                                '<option value="'.$leave->leave_id.'">'.$leave->type.'</option>';
                                                        }
                                                    }



                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12" for="leave-to">Days balance for selected leave type</label>
                                        <div class="col-md-12 input-group">
                                            <input name="days_left" id="days_left" type="text" class="form-control manipulate-date" placeholder="days balance" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"> Leave Description <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="4" name="description" id="leave-description" disabled></textarea><span class="highlight"></span> <span class="bar"></span>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12" for="leave-from">Date from</label>
                                        <div class="col-md-12 input-group">
                                            <input name="date_from" id="leave-from" type="text" class="form-control manipulate-date" onkeydown="return false" placeholder="YYYY-MM-DD" autocomplete="off" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--col end-->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <h3 class="panel panel-heading"></h3>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12" for="leave-to">Date to</label>
                                        <div class="col-md-12 input-group">
                                            <input name="date_to" id="leave-to" type="text" class="form-control manipulate-date" onkeydown="return false" placeholder="YYYY-MM-DD" autocomplete="off" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"> Reason for leave <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="4" name="reason" id="reason"></textarea><span class="highlight"></span> <span class="bar"></span>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button name="btnApplyLeave" id="btnApplyLeave" type="submit" class="btn btn-block btn-success btn-lg btn-block">Submit</button>
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
<script src="<?php echo base_url('assets/js/validator/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/moment/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src='<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bower_components/multiselect/js/jquery.multi-select.js'); ?>'></script>
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/majabs/leave.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();

    jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
    });

    jQuery('#leave-to').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#leave-from').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

</script>
</body>
</html>