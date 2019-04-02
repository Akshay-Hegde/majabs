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
    <title><?php echo APP_NAME.' Manage leave'; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
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
    <link href="<?php echo base_url('assets/plugins/bower_components/chartist-js/dist/chartist.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/plugins/bower_components/calendar/dist/fullcalendar.css'); ?>" rel="stylesheet" />

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
        include APP_VIEWS."navigations/top-nav.php";
        include APP_VIEWS."navigations/side-nav.php";

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
                    <h4 class="page-title">Leave Management</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class=""><a href="../../dashboard.php">Dashboard</a></li>
                        <li class="active">Manage Leave</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->


            <!--Add Service Modal-->
            <div id="add-leave" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form id="frmAddLeave" class="form-material" method="POST" action="<?php echo base_url('Leave/addLeave')?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Add Leave</h4> </div>
                        <div class="modal-body">

                                <div class="form-group">
                                    <label>Leave Type</label>
                                    <div class="form-group">
                                        <input type="text" name="type" id="leave-type" class="form-control" placeholder="Leave Type"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <textarea name="description" id="leave-description" class="form-control" placeholder="Description"> </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Number of days</label>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="days" id="leave-days" placeholder="Number of days"/>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnAddLeave" class="btn btn-info waves-effect">Save</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!--Edit Service Modal-->
            <div id="edit-leave" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form id="frmEditLeave" class="form-material" method="POST" action="<?php echo base_url('Leave/editLeave')?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Edit Leave</h4> </div>
                        <div class="modal-body">

                                <div class="form-group">
                                    <label>Leave Type</label>
                                    <div class="form-group">
                                        <input type="text" name="type" id="type-edit" class="form-control" placeholder="Leave Type"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <textarea name="description" id="description-edit" class="form-control" placeholder="Description"> </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Number of days</label>
                                    <div class="form-group">
                                        <input type="number" name="days" id="days-edit" class="form-control" placeholder="Number of days"/>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnEditLeave" class="btn btn-info waves-effect" >Save Changes</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="p-20 row">
                <div class="col-lg-4 col-md-4 col-md-offset-4">
                    <a href="javascript:void" data-toggle="modal" data-target="#add-leave" class="btn btn-outline btn-default btn-lg btn-block">
                        <span class="circle circle-sm bg-success di"><i class="ti-plus"></i></span><span>  Add Leave</span>
                    </a>
                </div>
            </div>

                <div class="col-md-12">
                    <div class="white-box">

                        <div class="table-responsive">
                            <table class="table product-overview" id="myTable">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Days</th>
                                    <th>Employees on Leave</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tbl-leave">

                                <?php

                                if($leaves !== null) {

                                    foreach ($leaves as $leave) {
                                        echo '                            
                                        <tr id="row_leave_' . $leave->leave_id . '">
                                            <td id="leave_type_' . $leave->leave_id . '">' . $leave->type . '</td>
                                            <td id="leave_description_' . $leave->leave_id . '">' . $leave->description . '</td>
                                            <td id="leave_days_' . $leave->leave_id . '">' . $leave->days . '</td>
                                            <td id="leave_emp_' . $leave->leave_id . '">' . $leave->employeesOnLeave . '</td>
                                                
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-warning edit-leave" data-toggle="modal" data-target="#edit-leave" title="Edit" role="button">Edit</a>
                                                <a class="btn btn-danger delete-leave" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>
                                            </td>
                                            
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
        <!-- /.container-fluid -->
        <footer class="footer text-center"><?php echo APP_FOOTER; ?> </footer>
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
<script src="<?php echo base_url('assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"'); ?>"></script>
<!--Morris JavaScript -->
<script src="<?php echo base_url('assets/plugins/bower_components/raphael/raphael-min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/morrisjs/morris.js'); ?>"></script>
<!-- chartist chart -->
<script src="<?php echo base_url('assets/plugins/bower_components/chartist-js/dist/chartist.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js'); ?>"></script>
<!-- Calendar JavaScript -->
<script src="<?php echo base_url('assets/plugins/bower_components/moment/moment.js'); ?>"></script>
<script src='<?php echo base_url('assets/plugins/bower_components/calendar/dist/fullcalendar.min.js'); ?>'></script>
<script src="<?php echo base_url('assets/plugins/bower_components/calendar/dist/cal-init.js'); ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dashboard1.js'); ?>"></script>
<!-- Custom tab JavaScript -->
<script src="<?php echo base_url('assets/js/cbpFWTabs.js'); ?>"></script>
<script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();

</script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.min.js'); ?>"></script>
<!--Style Switcher -->
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/majabs/leave.js'); ?>"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>