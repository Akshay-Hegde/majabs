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
    <title> <?php echo APP_NAME.' Assign Supervisor task'; ?></title>
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
                    <h4 class="page-title">Tasks Management</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class=""><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="active"> Manage Tasks </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->

            <!--Add Task Modal-->
            <div id="add-task" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Add New Task</h4> </div>
                        <div class="modal-body">
                            <from class="form-horizontal form-material">

                                <div class="form-group">
                                    <label class="col-sm-12 m-b-20">Task Titile</label>
                                    <div class="col-md-12 m-b-20">
                                        <input type="text" class="form-control" placeholder="Task Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 m-b-20">Task Description</label>
                                    <div class="col-sm-12 m-b-20">
                                        <textarea class="form-control" rows="4" id="taskDescription" placeholder="Task Description" required></textarea><span class="highlight"></span> <span class="bar"></span>
                                        <label for="input7" class="hidden">Text area</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="attribute-task" class="col-sm-12 m-b-20">Task Attributes</label>
                                    <div class="col-sm-12 m-b-20">
                                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose Attribute">
                                            <option>Mustard</option>
                                            <option>Ketchup</option>
                                            <option selected>Relish</option>
                                        </select>
                                    </div>
                                </div>

                            </from>
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

            <!--Edit Task Modal-->
            <div id="edit-task-assign" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form class="form-horizontal form-material" id="frmUpdateTaskAssign" action="<?php echo base_url('Task/updateTaskAssign')?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Edit Task Assignment</h4> </div>
                        <div class="modal-body">

                                <div class="form-group">
                                    <label for="attribute-task" class="col-sm-12 m-b-20">Pick Vehicle</label>
                                    <div class="col-sm-12 m-b-20">
                                        <select name="vehicle" id="edit-vehicle-assign" class="select2 m-b-10 select2-multiple form-control" data-placeholder="Pick Vehicle">
                                            <?php
                                                if($vehicles !== null) {
                                                    foreach ($vehicles as $vehicle) {

                                                        echo '<option value="' . $vehicle->vehicle_id . '">' . $vehicle->vehicle_name . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="attribute-task" class="col-sm-12 m-b-20">Pick Supervisor</label>
                                    <div class="col-sm-12 m-b-20">
                                        <select  name="supervisor" id="edit-supervisor-assign" class="form-control select2 m-b-10 select2-multiple" data-placeholder="Pick Supervisor">
                                            <?php
                                                if($supervisors !== null) {
                                                    foreach ($supervisors as $supervisor) {

                                                        echo '<option value="' . $supervisor->employee_id . '">' . $supervisor->name . ' ' . $supervisor->surname . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnUpdateTaskAssign" class="btn btn-info waves-effect">Save Changes</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

                <div class="col-md-8">
                    <div class="white-box">

                        <h3 class="box-title">Task List</h3>

                        <div class="table-responsive">
                            <table class="table product-overview" id="myTable">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Supervisor</th>
                                    <th>Vehicle</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tbl-supervisor-task">

                                <?php
                                    if($assignedTasks !== null) {

                                        foreach ($assignedTasks as $assignedTask){

                                            $modal = '#edit-task-assign';

                                            echo

                                            '<tr id="row_task_ass_' . $assignedTask->task_id . '">
                                                <td>' . $assignedTask->title . '</td>
                                                <td>' . $assignedTask->description . '</td>
                                                <td id="task_ass_supervisor_' . $assignedTask->task_id . '">' . $assignedTask->supervisor . '</td>
                                                <td id="task_ass_vehicle_' . $assignedTask->task_id . '">' . $assignedTask->vehicle_name . '</td>
                                               <td>
                                                    <a href="javascript:void(0)" class="btn btn-warning edit-task-assign" data-toggle="modal" data-target="'.$modal.'" title="Edit" role="button">Edit</a>
                                                    <a class="btn btn-danger delete-task-assign" href="javascript:void(0)" title="Delete" data-toggle="tooltip" role="button">Delete</a>
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

                <div class="col-md-4">
                    <div class="white-box">
                        <h3 class="box-title">Assign Task(s) To Supervisor</h3>

                            <form class="form-material" id="frmAssignSuperVisor" action="<?php echo base_url('Task/assignTasksSuperVisor')?>" method="POST">

                                <div class="form-group">
                                    <label>Pick Supervisor</label>
                                    <div class="form-group">
                                        <select  name="supervisor" id="supervisor-assign" class="form-control select2 m-b-10 select2-multiple" data-placeholder="Pick Supervisor">
                                            <?php
                                                if($supervisors !== null) {
                                                    foreach ($supervisors as $supervisor) {

                                                        echo '<option value="' . $supervisor->employee_id . '">' . $supervisor->name . ' ' . $supervisor->surname . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                    <div class="form-group">

                                        <label>Pick Task</label>
                                        <div class="form-group">
                                            <select name="task" id="task-assgn" class="form-control select2 m-b-10 select2-multiple" data-placeholder="Pick Task">

                                                <?php
                                                if($tasks !== null) {
                                                    foreach ($tasks as $task) {

                                                        echo '<option id = "task-assgn-'.$task->task_id.'" value="' . $task->task_id . '">' . $task->description.'</option>';
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label>Pick Vehicle</label>
                                        <div class="form-group">
                                            <select name="vehicle" id="vehicle-assign" class="form-control select2 m-b-10 select2-multiple" data-placeholder="Pick Vehicle">

                                                <?php
                                                    if($vehicles !== null) {
                                                        foreach ($vehicles as $vehicle) {

                                                            echo '<option value="' . $vehicle->vehicle_id . '">' . $vehicle->vehicle_name . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                <div class="form-group ">
                                    <div class="form-group">
                                        <button name="btnAssignSuperVisor" id="btnAssignSuperVisor" type="submit" class="btn btn-block btn-success btn-lg btn-block">Submit</button>
                                    </div>
                                </div>

                            </form>

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

</script>
<script src="<?php echo base_url('assets/plugins/bower_components/toast-master/js/jquery.toast.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator/additional-methods.min.js'); ?>"></script>
<!--Style Switcher -->
<script src="<?php echo base_url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/majabs/task.js'); ?>"></script>
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 12:58:56 GMT -->
</html>