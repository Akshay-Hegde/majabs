<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:57 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/plugins/images/favicon.png'); ?>">
    <title>Klubbars Admin Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bower_components/dropify/dist/css/dropify.min.css'); ?>">
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
	  <!-- Cropper CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/cropper/cropper.min.css'); ?>" rel="stylesheet">
	<!-- Date picker plugins css -->
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
	<!-- Typehead CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/typeahead.js-master/dist/typehead-min.css'); ?>" rel="stylesheet">
    <!-- Daterange picker plugins css -->	
    <link href="<?php echo base_url('assets/plugins/bower_components/timepicker/bootstrap-timepicker.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
	<!-- Page plugins css -->
    <link href="<?php echo base_url('assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css'); ?>" rel="stylesheet">
	<!-- page CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bower_components/switchery/dist/switchery.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/bower_components/multiselect/css/multi-select.css'); ?>" rel="stylesheet" type="text/css" />

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
        <?php
        $topNav = APP_VIEWS.'navigations/top-nav-index.php';
        $sideNav = APP_VIEWS.'navigations/left-nav-index.php';
        require_once($topNav);
        require_once($sideNav);
        ?>
<!-- End Left Sidebar -->

<!-- =================================================================================================== -->  
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
                <!--.row-->
					
					<div class="error-body2 text-center">
						<h1><?php echo $info["header"]; ?></h1>
						<h3 class="text-uppercase"><?php echo $info["msg"]; ?></h3>
						<!--p class="text-muted m-t-30 m-b-30">Please try after some time</p-->
                        <?php
                            if($info["button"]["status"]) {
                                echo $info["button"]["link"];
                            }
                        ?>
					</div>		
				</div>
                <!-- /.row -->
		</div>	                
            
            <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
    </div>
        <!-- /#page-wrapper -->
 
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/plugins/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/plugins/bower_components/moment/moment.js'); ?>"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url('assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"'); ?>"></script>

    <script src="<?php echo base_url('assets/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/plugins/bower_components/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
		<!--slimscroll JavaScript -->
    <script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
    <script type="text/javascript">
    $('#slimtest1').slimScroll({
        height: '700px'
		
    });
    $('#slimtest2').slimScroll({
        height: '750px'
    });
    $('#slimtest3').slimScroll({
        position: 'left',
        height: '250px',
        railVisible: true,
        alwaysVisible: true
    });
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '250px',
        alwaysVisible: true
    });
    </script>
	
	<script>

    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
    <!--Style Switcher -->
    <script src="<?php echo base_url('plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>

	<!-- Typehead Plugin JavaScript -->
    <script src="<?php echo base_url('plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bower_components/typeahead.js-master/dist/typeahead-init.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bower_components/footable/js/footable.all.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bower_components/bootstrap-select/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="<?php echo base_url('js/footable-init.js'); ?>"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/form-layout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:58 GMT -->
</html>
