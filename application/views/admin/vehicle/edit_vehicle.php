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
    <title> <?php echo APP_NAME.' Edit Vehicle'; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css'); ?>" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/morrisjs/morris.cs'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/chartist-js/dist/chartist.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/plugins/bower_components/calendar/dist/fullcalendar.css'); ?>" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/zela.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
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
                    <h4 class="page-title">BMW M4</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class=""><a href="../../index.php">Dashboard</a></li>
                        <li class="active">Manage Vehicle</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->

            <!--Edit vehicle Modal-->
            <div id="edit-service-date" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Edit Date</h4> </div>
                        <div class="modal-body">
                            <from class="form-horizontal form-material">
                                <div class="form-group">

                                    <label class="col-sm-12 m-b-20">Next Service Date</label>
                                    <div class="col-md-12 m-b-20 input-group">
                                        <input name="eventDate"  type="text" onkeydown="return false" autocomplete="off" id="next-service-date-edit" class="manipulate-date form-control" value="2018-08-18" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                    </div>

                                </div>
                            </from>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Save Changes</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div id="edit-vehicle-name" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Vehicle Name</h4> </div>
                                    <div class="modal-body">
                                        <from class="form-horizontal form-material">
                                            <div class="form-group">

                                                <label class="col-sm-12 m-b-20">Vehicle Name</label>
                                                <div class="col-md-12 m-b-20 input-group">
                                                    <input name="eventDate"  type="text" class="form-control manipulate-date" value="BMW" />
                                                </div>

                                            </div>
                                        </from>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Save Changes</button>
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>


            <div class="row">
                <div class="col-sm-8 col-sm-offset-2"">
                <div class="white-box p-l-20 p-r-20">
                    <h3 class="box-title m-b-0">Edit Vehicle</h3>
                    <p class="text-muted m-b-30 font-13"> </p>
                    <div class="row">
                        <div class="col-md-12">
                            <from class="form-horizontal form-material">
                                <div class="form-group">

                                    <label class="col-sm-12 m-b-20">Vehicle Name</label>
                                    <div class="col-md-12 m-b-20 input-group cursor" data-toggle="modal" data-target="#edit-vehicle-name">
                                        <p  class="form-control manipulate-date ">Hyndai Truck</p><span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span> </span>
                                    </div>

                                    <label class="col-sm-12 m-b-20">Vehicle Registration Number</label>
                                    <div class="col-md-12 m-b-20 input-group cursor" data-toggle="modal" data-target="#edit-vehicle">
                                        <p  class="form-control manipulate-date ">JJ 02 CC GP</p><span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span> </span>
                                    </div>

                                    <label class="col-sm-12 m-b-20">Next Service Date</label>
                                    <div class="col-md-12 m-b-20 input-group cursor" data-toggle="modal" data-target="#edit-vehicle">
                                        <p  class="form-control manipulate-date ">2018-08-04</p><span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span> </span>
                                    </div>

                                    <label class="col-sm-12 m-b-20">Vehicle Disc Expiry Date</label>
                                    <div class="col-md-12 m-b-20 input-group cursor" data-toggle="modal" data-target="#edit-service-date">
                                        <p  class="form-control manipulate-date ">2020-08-06</p><span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span> </span>
                                    </div>


                                </div>
                            </from>
                        </div>
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
<script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
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

    jQuery('#vehicle-disc-expiry').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        endDate: moment().add(6, 'M').format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#next-service-date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        endDate: moment().add(6, 'M').format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#vehicle-disc-expiry-edit').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        endDate: moment().add(6, 'M').format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#next-service-date-edit').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

    $(".delete-vehicle").on('click',function () {

        swal({
            title: "Delete Vehicle",
            text: "Are you sure you want to delete a vehicle",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm){
            if(isConfirm) {

                swal("Deleted!", "Vehicle has been deleted.", "success");
            }
        });

    });
</script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.min.js'); ?>"></script>
<!--Style Switcher -->
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>