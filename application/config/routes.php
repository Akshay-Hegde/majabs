<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Login';
//Manager
$route['manager-logs'] = 'Employee/loadManagerLogs';
$route['manage-emp-leave'] = 'Leave/loadLeaveManager';
$route['leave-list'] = 'Leave/managerLeaveList';
$route['leave-report'] = 'Leave/managerLeaveReport';
$route['task-report'] = 'Task/managerTaskReport';
$route['employee-report'] = 'Employee/manageEmpReport';
$route['vehicle-report'] = 'Vehicle/loadVehicleReport';
$route['service-report'] = 'Service/loadVehicleList';
$route['employees-onleave/(.*)'] = 'Employee/loadEmpOnLeave/$1';
$route['vehicles-onservice/(.*)'] = 'Service/loadVehicleOnService/$1';
$route['manager-notifications'] = 'Notification/loadManagerNotification';
//$route['leave-list'] = 'Leave/loadLeaveList';
//Employee
$route['employee-logs'] = 'Employee/loadEmpLogs';
$route['apply-employee-leave'] = 'Leave/loadEmpApplyLeave';
$route['history-leave'] = 'Leave/loadEmpLeaveHistory';
$route['employee-leave'] = 'Leave/loadEmpLeaveList';
$route['employee-notifications'] = 'Notification/loadEmpNotification';
$route['employee-task-report'] = 'Task/loadEmpTaskReport';
//Supervisor routes
$route['supervisor-logs'] = 'Employee/loadSupervisorLogs';
$route['manage-supervisor-task'] = 'Task/loadAssignEmpTask';
$route['manage-assigned-task'] = 'Task/manageAssignedTask';
$route['supervisor-task-report'] = 'Task/loadTaskReport';
$route['apply-supervisor-leave'] = 'Leave/loadApplyLeave';
$route['leave-history'] = 'Leave/loadLeaveHistory';
$route['supervisor-leave'] = 'Leave/loadLeaveList';
$route['supervisor-notifications'] = 'Notification';

//-------------------------------------------------------------------------------------
$route['login'] = 'Login';
$route['dashboard'] = 'Dashboard';
$route['manage-leave'] = 'Leave';
$route['manage-vehicle'] = 'Vehicle';
$route['manage-task'] = 'Task';
$route['manage-employee'] = 'Employee';
$route['manage-attribute'] = 'Attribute';
$route['manage-service'] = 'Service';
$route['assign-vehicle-service'] = 'Service/serviceAssignment';
$route['assign-emp-task'] = 'Task/assignEmpTask';
$route['register-employee'] = 'Employee/register';
$route['logout'] = 'Employee/logout';
$route['employee-profile'] = 'Employee/profile';
$route['change-password'] = 'Employee/password';
$route['edit-employee/(.*)'] = 'Employee/editEmployee/$1';
$route['edit-vehicle/(.*)'] = 'Vehicle/editVehicle/$1';
$route['edit-task/(.*)'] = 'Task/editTask/$1';
$route['admin-logs'] = 'Employee/loadAdminLogs';
$route['404_override'] = '404';
$route['translate_uri_dashes'] = TRUE;