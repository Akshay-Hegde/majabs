<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:37 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/plugins/images/favicon.png">
    <title><?php echo APP_NAME.'-Manage Employee'?></title>
    <!-- Bootstrap Core CSS -->

    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css'); ?>" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/morrisjs/morris.cs'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/chartist-js/dist/chartist.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/plugins/bower_components/calendar/dist/fullcalendar.css'); ?>" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class=""><a href="dashboard">Dashboard</a></li>
                            <li class="active">Manage Employee</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->

                <div class="p-20 row">
                    <div class="col-lg-4 col-md-4 col-md-offset-4">
                        <a href="register-employee" class="btn btn-outline btn-default btn-lg btn-block">
                            <span class="circle circle-sm bg-success di"><i class="ti-plus"></i></span><span>  Register Employee</span>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="white-box">
                        <div class="table-responsive">
                            <table class="table product-overview" id="myTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Gender</th>
                                    <th>ID Number</th>
                                    <th>Contract Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tbl-employee-list">

                                <?php

                                    foreach ($employees as $employee)
                                    {
                                        echo '                                
                                            <tr id="emp_list_'.$employee['employee_id'].'">
                                                <td id="emp_list_name_'.$employee['employee_id'].'">'.$employee['name'].'</td>
                                                <td id="emp_surname_'.$employee['employee_id'].'">'.$employee['surname'].'</td>
                                                <td id="emp_list_gender_'.$employee['employee_id'].'">'.$employee['gender'].'</td>
                                                <td id="emp_list_id_'.$employee['employee_id'].'">'.$employee['id_number'].'</td>
                                                <td id="emp_list_contract_type_'.$employee['employee_id'].'">'.$employee['contract_type'].'</td>                             
                                                <td>
                                                    <a href="'. base_url('edit-employee/'.$employee["employee_id"]) .'" class="btn btn-warning" data-toggle="tooltip" title="Edit" role="button">Edit</a>
                                                    <a class="btn btn-danger delete-employee" href="javascript:void(0)" role="button">Delete</a>
                                                </td>
                                            </tr>';
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
    <script src="<?php echo base_url('assets/js/majabs/employee.js'); ?>"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>
