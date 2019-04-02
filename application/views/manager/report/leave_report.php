<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:37 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title> <?php echo APP_NAME.'-Assign employee task'; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/footable/css/footable.core.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css'); ?>" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bower_components/switchery/dist/switchery.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/multiselect/css/multi-select.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- animation CSS -->
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/zela.css'); ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url('assets/css/colors/megna-dark.css'); ?>" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <!--INCLUDE TOP NAV HERE-->
    <?php
    include APP_VIEWS."manager/navigation/top-nav.php";
    include APP_VIEWS."manager/navigation/side-nav.php";

    ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Leave Report</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class=""><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="active"> Employee Leave Report </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->

            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-1 col-sm-6"></div>
                        <form action = "<?php echo base_url('Leave/retrieveLeaveReport'); ?>" method="POST" id="frmRetrieveLeaveReport">

                            <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                <label>Search by Leave Type</label>

                                <select name="searchByLeaveType" class="form-control select2 m-b-10 select2-multiple" data-placeholder="Pick Search Key">
                                    <option selected value="1000">All</option>
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

                            <div class="form-group col-lg-2 col-md-3 col-sm-6">
                                <label>Search by status</label>

                                <select name="searchByStatus" class="form-control select2 m-b-10 select2-multiple" data-placeholder="Pick Search Key">
                                    <option selected value="1000">All</option>
                                    <option value="1">Approved</option>
                                    <option value="-1">Rejected</option>
                                    <option value="0">Pending</option>
                                </select>

                            </div>


                            <div class="form-group col-lg-2 col-md-3 col-sm-6">
                                <label>From</label>
                                <input class="form-control" name="date_from" id="leave-date-from" type="text" placeholder="YYYY-MM-DD" onkeydown="return false" autocomplete="off"/>
                            </div>

                            <div class="form-group col-lg-2 col-md-3 col-sm-6">
                                <label>To</label>
                                <input class="form-control" name="date_to" id="leave-date-to" type="text" placeholder="YYYY-MM-DD" onkeydown="return false" autocomplete="off"/>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-6">
                                <label>.</label><br/>
                                <button type="submit" id="btnLeaveHistory" class="btn btn-md btn-success">Submit Search </button>
                            </div>
                        </form>
                        <div class="col-md-1 col-sm-6"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="white-box">

                    <h3 class="box-title">Employee Leave Report</h3>

                    <div class="scrollable">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody id="tbl-emp-leave-report">

                                </tbody>
                                <tfoot>
                                <tr>

                                    <td colspan="7">
                                        <div class="text-right">
                                            <ul class="pagination"> </ul>
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> <?php echo APP_FOOTER; ?> </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js'); ?>"></script>
<!--Counter js -->
<!-- chartist chart -->
<!-- Calendar JavaScript -->
<script src="<?php echo base_url('assets/plugins/bower_components/moment/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src='<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/bower_components/bower_components/multiselect/js/jquery.multi-select.js'); ?>'></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dashboard1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/cbpFWTabs.js'); ?>"></script>
<script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();

    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
    });

    $(function() {
        $('#task-assgn').select2({
            maximumSelectionSize: 2
        });
    });

    jQuery('#leave-date-from').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: moment().format('YYYY-MM-DD'),
        todayHighlight: true
    });

    jQuery('#leave-date-to').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
</script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/footable/js/footable.all.min.js'); ?>"></script>
<!--Style Switcher -->
<script src="<?php echo base_url('assets/js/footable-init.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/majabs/leave.js'); ?>"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>