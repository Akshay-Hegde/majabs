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
    <title> <?php echo APP_NAME.'-Leave history'; ?></title>
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
    include APP_VIEWS."employee/navigation/top-nav.php";
    include APP_VIEWS."employee/navigation/side-nav.php";
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">My Details</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active">Leave List</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-12">
                <div class="white-box">

                    <h3 class="box-title">Employee Leave List</h3>

                    <div class="table-responsive">
                        <table class="table product-overview" id="myTable">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Days</th>
                                <th>Days Left</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="tbl-supervisor-task-report">
                            <?php

                                    if($leaves !== null) {
                                        foreach ($leaves as $key=>$leave) {

                                            if($status['status_'.$key] === 'approved'){
                                                    $value = array("status" => "Active",
                                                        "klass" => "label label-success label-rouded");
                                                }elseif($status['status_'.$key] === 'pending'){
                                                    $value = array("status" => "Pending",
                                                            "klass" => "label label-info label-rouded");
                                                }else{

                                                    $value = array("status" => "In-active",
                                                        "klass" => "label label-warning label-rouded");
                                            }

                                            echo '                                
                                                <tr>
                                                    <td>' . $leave->type . '</td>
                                                    <td>' . $leave->days . '</td>
                                                    <td>' . $days_left['days_'.$key] . '</td>
                                                    <td> <span class="'.$value["klass"].'">'.$value["status"].'</span> </td>                           
                                                </tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
<script src="<?php echo base_url('assets/plugins/bower_components/calendar/dist/cal-init.js'); ?>"></script>
<script src='<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bower_components/multiselect/js/jquery.multi-select.js'); ?>'></script>
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/majabs/employee.js'); ?>" type="text/javascript"></script>

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

    $(function() {
        $('#task-assgn').select2({
            maximumSelectionSize: 2
        });
    });

</script>
</body>
</html>