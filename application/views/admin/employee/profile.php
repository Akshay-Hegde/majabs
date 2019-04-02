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
    <title> <?php echo APP_NAME.'-User profile'; ?></title>
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
                        <li class="active">Edit Profile</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <form class="form-material form-horizontal" id="frmUpdateAdmin" action="<?php echo base_url('Employee/updateAdmin/'.$employee['employee_id']); ?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="panel panel-info">

                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"> First Name <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="text" id="name-edit" name="name" class="form-control form-control-line" value="<?php echo $employee['name'];?>" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"> Last Name <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="text" id="surname-edit" name="surname" class="form-control form-control-line" value="<?php echo $employee['surname'];?>" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12" for="email">Email <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="email" id="email-edit" disabled name="email" class="form-control" placeholder="Email" value="<?php echo $employee['email'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12" for="phone">Phone <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="text" id="phone-edit" name="phone" class="form-control" placeholder="Phone" value="<?php echo $employee['phone'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12" for="id-number">ID Number <span class="help"></span></label>
                                        <div class="col-md-12">
                                            <input type="text" id="id-number-edit" disabled name="id_number" class="form-control" placeholder="ID Number" value="<?php echo $employee['id_number'];?>">
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

                        <div class="form-group">
                            <label class="col-sm-12">Gender</label>
                            <div class="col-sm-12">

                                <?php

                                if($employee['gender'] === "Male")
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

                        <?php
                            $role = '';
                            if((int)$employee['role'] === 1){
                                $role = 'ADMIN';
                            }elseif ((int)$employee['role'] === 2){
                                $role = 'SUPERVISOR';
                            }elseif ((int)$employee['role'] === 3){
                                $role = 'MANAGER';
                            }else{
                                $role = 'EMPLOYEE';
                            }
                        ?>

                        <div class="form-group">
                            <label class="col-md-12" for="phone">Empoyee Role <span class="help"></span></label>
                            <div class="col-md-12">
                                <input type="text"  class="form-control" placeholder="Role" value="<?php echo $role;?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="contract_type">Contract Type <span class="help"></span></label>
                            <div class="col-md-12">
                                <input type="text"  name="contract_type" id="contract_type" class="form-control" placeholder="Contract Type" value="<?php echo $employee['contract_type'];?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="salary">Salary <span class="help"></span></label>
                            <div class="col-md-12">
                                <input type="text" id="salary-edit" name="salary" class="form-control" placeholder="Salary" value="<?php  echo $employee["salary"]; ?>" disabled="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Contract Expiry Date</label>
                            <div class="col-md-12 input-group">
                                <input name="contract_expiry_date"  type="text" disabled class="form-control manipulate-date" value="<?php  echo $employee["contract_expiry_date"]; ?>" /><span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                            </div>
                        </div>

                        <div class="form-group ">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button name="btnUpdateEmp" id="btnUpdateAdmin" type="submit" class="btn btn-block btn-success btn-lg btn-block">Submit</button>
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