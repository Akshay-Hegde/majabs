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
    <title>Majabulakuphakwa</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <!-- chartist CSS -->
    <link href="../plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="../plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />

    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/zela.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/megna-dark.css" id="theme" rel="stylesheet">
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
    <?php include "top-nav.php"; ?>
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    <!--SIDE NAV HERE-->
    <?php include "side-nav.php"; ?>
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
                    <h4 class="page-title">Notification Management</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class=""><a href="dashboard.php">Dashboard</a></li>
                        <li class="active">Manage Notification</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!--Add Service Modal-->
            <div id="add-leave" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Add Leave</h4> </div>
                        <div class="modal-body">

                            <form class="form-material">

                                <div class="form-group">
                                    <label>Leave Type</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Leave Type"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Description"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Number of days</label>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Number of days"/>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="row">

                <div class="col-md-6 col-lg-8 col-sm-12 col-md-offset-2">
                    <div class="white-box bg-theme m-b-0 p-b-0 mailbox-widget">
                        <h2 class="text-white p-b-20">Your Mailbox</h2>
                        <ul class="nav customtab nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home1" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-email"></i></span><span class="hidden-xs"> INBOX</span></a></li>
                            <li role="presentation" class=""><a href="#profile1" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-export"></i></span> <span class="hidden-xs">SENT</span></a></li>
                            <li role="presentation" class=""><a href="#messages1" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-panel"></i></span> <span class="hidden-xs">SPAM</span></a></li>
                            <li role="presentation" class=""><a href="#settings1" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-trash"></i></span> <span class="hidden-xs">DELETED</span></a></li>
                        </ul>
                    </div>
                    <div class="white-box p-0">
                        <div class="tab-content m-t-0">
                            <div role="tabpanel" class="tab-pane fade active in" id="home1">

                                <div class="p-30">
                                    <ul class="side-icon-text pull-right">
                                        <li><a href="#"><span class="circle circle-sm bg-success di"><i class="ti-plus"></i></span><span>Compose</span></a></li>
                                        <li><a href="#"><span class="circle circle-sm bg-danger di"><i class="ti-trash"></i></span><span>Delete</span></a></li>
                                    </ul>
                                    <h3><i class="ti-email"></i> 350 Unread emails</h3>
                                </div>

                                <div class="inbox-center table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr class="unread">
                                            <td>&nbsp;</td>
                                            <td style="width: 50px">
                                                <div class="checkbox checkbox-info m-t-0 m-b-0">
                                                    <input type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs" style="width: 50px"><i class="fa fa-star-o"></i></td>
                                            <td class="hidden-xs">Hritik Roshan</td>
                                            <td class="max-texts"> <a href="inbox-detail.html"><span class="label label-info m-r-10">Work</span> Lorem ipsum perspiciatis unde omnis iste</a></td>
                                            <td class="hidden-xs"><i class="fa fa-paperclip"></i></td>
                                            <td class="text-right"> May 13 </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr class="unread">
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="checkbox checkbox-info m-t-0 m-b-0">
                                                    <input type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs"><i class="fa fa-star text-warning"></i></td>
                                            <td class="hidden-xs">Genelia Roshan</td>
                                            <td class="max-texts"><a href="inbox-detail.html">Lorem ipsum perspiciatis unde omnis iste</a></td>
                                            <td class="hidden-xs"><i class="fa fa-paperclip"></i></td>
                                            <td class="text-right"> May 13 </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="checkbox checkbox-info m-t-0 m-b-0">
                                                    <input type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs"><i class="fa fa-star-o"></i></td>
                                            <td class="hidden-xs">Akshay Kumar</td>
                                            <td class="max-texts"><a href="inbox-detail.html"><span class="label label-warning">Work</span> Lorem ipsum perspiciatis unde</a></td>
                                            <td class="hidden-xs"><i class="fa fa-paperclip"></i></td>
                                            <td class="text-right"> May 12 </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="checkbox checkbox-info m-t-0 m-b-0">
                                                    <input type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs"><i class="fa fa-star text-warning"></i></td>
                                            <td class="hidden-xs">Genelia Roshan</td>
                                            <td class="max-texts"><a href="inbox-detail.html">Lorem ipsum perspiciatis unde omnis iste</a></td>
                                            <td class="hidden-xs"><i class="fa fa-paperclip"></i></td>
                                            <td class="text-right"> May 11 </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="checkbox checkbox-info m-t-0 m-b-0">
                                                    <input type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs"><i class="fa fa-star-o"></i></td>
                                            <td class="hidden-xs">Ritesh Deshmh</td>
                                            <td class="max-texts"><a href="inbox-detail.html"><span class="label label-success">Elite</span> Lorem ipsum perspiciatis unde omnis</a></td>
                                            <td class="hidden-xs"></td>
                                            <td class="text-right"> May 11 </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="checkbox checkbox-info m-t-0 m-b-0">
                                                    <input type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs"><i class="fa fa-star-o"></i></td>
                                            <td class="hidden-xs">Akshay Kumar</td>
                                            <td class="max-texts"><a href="inbox-detail.html"><span class="label label-warning">Work</span> Lorem ipsum perspiciatis undeem</a></td>
                                            <td class="hidden-xs"><i class="fa fa-paperclip"></i></td>
                                            <td class="text-right"> May 11 </td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile1">
                                <div class="col-md-6">
                                    <h3>Lets check profile</h3>
                                    <h4>you can use it with the small code</h4>
                                </div>
                                <div class="col-md-5 pull-right">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="messages1">
                                <div class="col-md-6">
                                    <h3>Come on you have a lot message</h3>
                                    <h4>you can use it with the small code</h4>
                                </div>
                                <div class="col-md-5 pull-right">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="settings1">
                                <div class="col-md-6">
                                    <h3>Just do Settings</h3>
                                    <h4>you can use it with the small code</h4>
                                </div>
                                <div class="col-md-5 pull-right">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
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
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<script src="../plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="../plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<!--Counter js -->
<script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="../plugins/bower_components/raphael/raphael-min.js"></script>
<!-- chartist chart -->
<script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- Calendar JavaScript -->
<script src="../plugins/bower_components/moment/moment.js"></script>
<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src='../plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
<script src="../plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script src="../plugins/bower_components/calendar/dist/cal-init.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<script src="js/dashboard1.js"></script>
<!-- Custom tab JavaScript -->
<script src="js/cbpFWTabs.js"></script>
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
        endDate: moment().add(6, 'M').format('YYYY-MM-DD'),
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
<script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>