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
    <title> <?php echo APP_NAME.' Edit Employee'; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/bower_components/sweetalert/sweetalert.cssbootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css'); ?>" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/toast-master/css/jquery.toast.css'); ?>" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('assets/plugins/bower_components/morrisjs/morris.cs'); ?>" rel="stylesheet">
    <!-- chartist CSS -->
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
    <link href="<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.css'); ?>" rel="stylesheet">
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
                    <h4 class="page-title"><?php  echo $emp["name"].' '.$emp["surname"]; ?></h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class=""><a href="<?php echo base_url('manage-employee'); ?>">Manage Employee</a></li>
                        <li class="active">Edit Employee</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->

            <!-- .row -->
            <!-- .row -->
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2"">
                <div class="white-box p-l-20 p-r-20">
                    <h3 class="box-title m-b-0">Edit account</h3>
                    <p class="text-muted m-b-30 font-13"> </p>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-material form-horizontal" id="frmAddEmployee-edit" action="<?php echo base_url('Employee/updateEmployee/'.$emp['employee_id']); ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-12"> First Name <span class="help"></span></label>
                                    <div class="col-md-12">
                                        <input type="text" id="name-edit" name="name" class="form-control form-control-line" value="<?php  echo $emp["name"]; ?>" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"> Last Name <span class="help"></span></label>
                                    <div class="col-md-12">
                                        <input type="text" id="surname-edit" name="surname" class="form-control form-control-line" value="<?php  echo $emp["surname"]; ?>" placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12" for="email">Email <span class="help"></span></label>
                                    <div class="col-md-12">
                                        <input type="email" id="email-edit" name="email" class="form-control" placeholder="Email" value="<?php  echo $emp["email"]; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12" for="phone">Phone <span class="help"></span></label>
                                    <div class="col-md-12">
                                        <input type="text" id="phone-edit" name="phone" class="form-control" placeholder="Phone" value="<?php  echo $emp["phone"]; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12" for="id-number">ID Number <span class="help"></span></label>
                                    <div class="col-md-12">
                                        <input type="text" id="id-number-edit" name="id_number" class="form-control" placeholder="ID Number" value="<?php  echo $emp["id_number"]; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Gender</label>
                                    <div class="col-sm-12">

                                        <?php

                                            if($emp['gender'] === "Male")
                                            {
                                                echo
                                                    '<select name="gender" id="gender-edit" class="form-control">
                                                        <option selected value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>';
                                            }else {
                                                echo
                                                    '<select name="gender" id="gender-edit" class="form-control">
                                                        <option value="Male">Male</option>
                                                        <option selected value="Female">Female</option>
                                                    </select>';
                                            }
                                        ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Employee Role</label>
                                    <div class="col-sm-12">
                                        <select name="role" id="role-edit" class="form-control">
                                            <?php

                                                if($roles !== null) {

                                                foreach ($roles as $role) {
                                                    $selected = '';
                                                    $selected = ($role->role_id == $emp["role"] ? 'selected' : '');
                                                    echo '<option '.$selected.' value="'.$role->role_id.'">'.$role->type.'</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Employee Attributes</label>
                                    <div class="col-sm-12">
                                        <select name="attributes[]" id="attributes-edit" class="form-control select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose Type">
                                            <?php

                                            if($attributes !== null) {

                                                foreach ($attributes as $attribute) {

                                                    if($employeeAttributes !== null) {

                                                        $selected = '';

                                                        foreach ($employeeAttributes as $key=>$empAttribute) {
                                                            if($attribute->attribute_id == $empAttribute->attribute_id) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                        echo  '<option  '.$selected.' value="'.$attribute->attribute_id.'">' . $attribute->description . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Contract Type</label>
                                    <div class="col-sm-12">
                                        <select name="contract_type" id="contract_typeedit" class="form-control">
                                            <?php
                                            if($contractTypes !== null) {

                                                foreach ($contractTypes as $key=>$contractType) {

                                                    if((int)$contractType->contract_id == (int)$emp['contract_id'])
                                                    {
                                                        echo '<option selected value="'.$contractType->contract_id.'">'.$contractType->contract_type.'</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="'.$contractType->contract_id.'">'.$contractType->contract_type.'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Upload Contract Document</label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="contractFile" id="contract-file-edit"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12" for="salary">Salary <span class="help"></span></label>
                                    <div class="col-md-12">
                                        <input type="text" id="salary-edit" name="salary" class="form-control" placeholder="Salary" value="<?php  echo $emp["salary"]; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Contract Expiry Date</label>
                                    <div class="col-md-12 input-group">
                                        <input name="contract_expiry_date"  type="text" onkeydown="return false" autocomplete="off" id="contract_expiry_date-edit" class="form-control manipulate-date" value="<?php  echo $emp["contract_expiry_date"]; ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Driver License Expiry Date</label>
                                    <div class="col-md-12 input-group">
                                        <input name="license_expiry_date"  type="text" onkeydown="return false" autocomplete="off" id="license-expiry-edit" class="form-control manipulate-date" value="<?php  echo $emp["license_expiry_date"]; ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button name="btnUpdateEmp" id="btnUpdateEmp" type="submit" class="btn btn-block btn-success btn-lg btn-block">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"><?php echo APP_FOOTER; ?></footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
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
<!--Counter js -->
<script src="<?php echo base_url('assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/counterup/jquery.counterup.min.jss"'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/raphael/raphael-min.js'); ?>"></script>
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
<script src="<?php echo base_url('assets/js/jasny-bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/custom-select/custom-select.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/bower_components/multiselect/js/jquery.multi-select.js'); ?>"></script>
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

<script>

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

    jQuery('#contract_expiry_date-edit').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#license-expiry-edit').datepicker({
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        autoclose: true,
        todayHighlight: true
    });
</script>

</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>
