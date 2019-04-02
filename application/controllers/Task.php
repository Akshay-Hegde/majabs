<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 17:29
 */

class Task extends MY_Controller {

    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["attributes"] = $this->AttributeModel->getAttributes();
        $data["tasks"] = $this->TaskModel->getTasks();

        return $this->load->view('admin/task/manage_tasks',$data);
    }
    //Employee
    public function managerTaskReport()
    {
        $data['notificationsStats'] = $this->notificationStats;
        return $this->load->view('manager/report/task_report',$data);
    }

    public function loadEmpTaskReport()
    {
        $data['notificationsStats'] = $this->notificationStats;
        return $this->load->view('employee/report/task_report',$data);
    }

    public function retrieveEmpTaskReport()
    {
        $searchKey = trim($this->input->post('searchKey'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = $this->input->post('date_to');

        if(empty($searchKey))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Search by is not chosen"));
        }

        if(empty($date_from))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Date from is required"));
        }

        if(empty($date_to))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Date to is required"));
        }

        $params = array(
            "date_from" => $date_from,
            "emp_id" => $this->employee['employee_id'],
            "date_to" => $date_to,
            "status" => $searchKey
        );

        $report = $this->TaskModel->getEmpTaskReport($params);
        //var_dump($report[0]->description); die();
        if($report !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Report Successfully retrieved",
                "report" => $report));
        }elseif ($report === null){
            $this->response->withJson(array("status"=>"warning",
                "message" => "No results found."));
        }else {

            $this->response->withJson(array("status" => "fail",
                "message" => "Failed to retrieve tasks."));
        }
    }

    //Supervisor methods
    public function loadAssignEmpTask()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["employees"] = $this->EmployeeModel->getAllEmployeesToAssign();
        $data["tasks"] = $this->TaskModel->getTaskToBeAssignedToEmp($this->employee['employee_id']);
        //var_dump($data["tasks"]);
        //$this->response->withJson($data["employees"]);
        $data["assignedTasks"] = $this->TaskModel->getTaskAssignedToEmp($this->employee['employee_id']);

        return $this->load->view('supervisor/task/assign_emp_task',$data);
    }

    public function retrieveSuperTaskReport()
    {
        $searchKey = trim($this->input->post('searchKey'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = $this->input->post('date_to');

        if(empty($searchKey))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Search by is not chosen"));
        }

        if(empty($date_from))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Date from is required"));
        }

        if(empty($date_to))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Date to is required"));
        }

        $params = array(
            "date_from" => $date_from,
            "supervisor_id" => $this->employee['employee_id'],
            "date_to" => $date_to,
            "status" => $searchKey
        );

        $report = $this->TaskModel->getSupervisorTaskReport($params);
        //var_dump($report[0]->description); die();
        if($report !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Report Successfully retrieved",
                "report" => $report));
        }elseif ($report === null){
            $this->response->withJson(array("status"=>"warning",
                "message" => "No results found."));
        }else {

            $this->response->withJson(array("status" => "fail",
                "message" => "Failed to retrieve tasks."));
        }
    }

    public function retrieveManagerTaskReport()
    {
        $searchKey = trim($this->input->post('searchKey'));

        if(empty($searchKey))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Search by is not chosen"));
        }

        $params = array(
            "status" => $searchKey
        );

        $report = $this->TaskModel->getManagerTaskReport($params);
        //var_dump($report[0]->description); die();
        if($report !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Report Successfully retrieved",
                "report" => $report));
        }elseif ($report === null){
            $this->response->withJson(array("status"=>"warning",
                "message" => "No results found."));
        }else {

            $this->response->withJson(array("status" => "fail",
                "message" => "Failed to retrieve tasks."));
        }
    }

    public function loadTaskReport()
    {
        $data['notificationsStats'] = $this->notificationStats;
        return $this->load->view('supervisor/report/task_report',$data);
    }

    public function assignEmployeeTask()
    {
        $employee_id = trim($this->input->post('employee'));
        $task_id = $this->input->post('task');

        //Check if a task is already assigned to a supervisor
        $isTaskAssigned = $this->TaskModel->CHECK_EXISTENCE("employee_task"," is_active = 1 AND task_id = ".$task_id);

        if($isTaskAssigned)
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Task is already assigned, pick a different one"));
        }

        //Check if a employee is already assigned to a task
        $isEmpAssigned = $this->TaskModel->CHECK_EXISTENCE("employee","is_assigned_task = 1 AND is_active = 1 AND employee_id = ".$employee_id);

        if($isEmpAssigned)
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Employee is already assigned to task, pick a different one"));
        }

        if(empty($employee_id))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Please pick an employee"));
        }

        if(empty($task_id))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Please pick at least one task"));
        }

        $params = array(
            "employee_id" => $employee_id,
            "supervisor_id" => $this->employee['employee_id'],
            "task_id" => $task_id
        );
        //var_dump($params);die();
        $task = $this->TaskModel->assignEmployeeTask($params);

        if($task !== null)
        {
            $notificationParams = array(
                "receiver_id" => $employee_id,
                "sender_id" => $this->employee['employee_id'],
                "type" => "TASK_ASSIGN",
                "title" => "Task Assigned",
                "message" => 'Good day, A new task has been assigned to you. Please check it out. Thank you.'
            );
            $this->NotificationModel->createNotification($notificationParams);

            $this->response->withJson(array("status"=>"success",
                "message" => "Task Successfully assigned",
                "task" => $task));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to assign task."));
    }

    public function updateEmpTaskAssign()
    {
        $employee_id = trim($this->input->post('employee'));
        $task_id = $this->input->post('task_id');

        //Check if a vehicle is assigned to a task
        $isEmployeeAssigned = $this->TaskModel->CHECK_EXISTENCE("employee","is_assigned_task = 1 AND employee_id = ".$employee_id);

        if($isEmployeeAssigned)
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Employee is already assigned to another task, pick a different one"));
        }

        $params = array(
            "task_id" => $task_id,
            "employee_id" => $employee_id
        );

        //$this->response->withJson($params);
        $emp = $this->TaskModel->updateEmpTaskAssign($params);

        if($emp !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Employee Successfully changed",
                "emp" => $emp));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update task."));
    }

    public function updateEmpTaskStatus()
    {
        $task_id = $this->input->post('task_id');

        $this->TaskModel->updateEmpTaskStatus($task_id);

        $this->response->withJson(array("status"=>"success",
            "message" => "Congrats, Task completed"));
    }

    public function deleteEmpTaskAssigned()
    {
        $taskID = trim($this->input->post("task_id"));

        $isTaskDeleted = $this->TaskModel->deleteEmpTaskAssigned($taskID);

        if($isTaskDeleted !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Successfully deleted"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to delete task assigned."));
    }

    public function manageAssignedTask()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["employees"] = $this->EmployeeModel->getAllEmployeesToAssign();
        $data["tasks"] = $this->TaskModel->getTaskToBeAssignedToEmp($this->employee['employee_id']);
        //var_dump($data["tasks"]);
        //$this->response->withJson($data["employees"]);
        $data["assignedTasks"] = $this->TaskModel->getTaskAssignedToEmp($this->employee['employee_id']);

        return $this->load->view('supervisor/task/manage_assigned_task',$data);
    }
    //------------------------------------------------------------------------------------------------------------------
    //Admin Methods
    public function assignEmpTask()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["attributes"] = $this->AttributeModel->getAttributes();
        $data["assignedTasks"] = $this->TaskModel->getAssignedTasks();
        $data["supervisors"] = $this->TaskModel->getTaskSuperVisors();
        $data["vehicles"] = $this->TaskModel->getTaskVehicles();
        //var_dump($data['assignedTasks']); die();
        //$this->response->withJson($data['assignedTasks']);
        $data["tasks"] = $this->TaskModel->getTaskToBeAssigned();

        return $this->load->view('admin/task/assign_emp_task',$data);
    }

    public function registerTask()
    {
        $title = trim($this->input->post('title'));
        $description = trim($this->input->post('description'));
        $attributes = $this->input->post('attributes');

        //Validating vehicle title
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $title),
            array("name" => "max", "value" => 50, "field" => $title)
        );

        $valid = $this->validator->validate($title,$validationRules,"Title");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle name
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $description),
            array("name" => "max", "value" => 500, "field" => $description)
        );

        $valid = $this->validator->validate($description,$validationRules,"Description");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        if(empty($attributes)){
            $this->response->withJson(array("status"=>"fail",
                "message" => "Attributes cannot be empty"));
        }

        $params = array(
            "attributes" => $attributes,
            "title" => $title,
            "description" => $description
        );

        $task = $this->TaskModel->registerTask($params);

        if($task !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Task Successfully registered",
                "task" => $task));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to register task."));
    }

    public function editTask($taskID = null)
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["attributes"] = $this->AttributeModel->getAttributes();
        $data["selectedTask"] = $this->TaskModel->getTaskByID($taskID);
        $data["taskAttributes"] = $this->TaskModel->getTaskAttributes($taskID);

        return $this->load->view('admin/task/edit_task',$data);
    }

    public function UpdateTask($taskID = null)
    {
        $title = trim($this->input->post('title'));
        $description = trim($this->input->post('description'));
        $attributeIDs = $this->input->post('attributes');

        //Validating vehicle title
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $title),
            array("name" => "max", "value" => 50, "field" => $title)
        );

        $valid = $this->validator->validate($title,$validationRules,"Title");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle name
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $description),
            array("name" => "max", "value" => 500, "field" => $description)
        );

        $valid = $this->validator->validate($description,$validationRules,"Description");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        if(empty($taskID)){
            $this->response->withJson(array("status"=>"fail",
                "message" => "task id is empty."));
        }

        if(empty($attributeIDs)){
            $this->response->withJson(array("status"=>"fail",
                "message" => "Please pick at least one attribute."));
        }

        $params = array(
            "task_id" => $taskID,
            "title" => $title,
            "description" => $description
        );

        $task = $this->TaskModel->UpdateTask($params,$attributeIDs);

        if($task !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Task Successfully updated",
                "task" => $task));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to register task."));
    }

    public function updateTaskAssign()
    {
        $vehicle_id = trim($this->input->post('vehicle'));
        $supervisor_id = trim($this->input->post('supervisor'));
        $task_id = $this->input->post('task_id');

        //Check if a vehicle is assigned to a task
        $isVehicleAssigned = $this->TaskModel->CHECK_EXISTENCE("vehicle","is_assigned_to_task = 1 AND vehicle_id = ".$vehicle_id);

        if($isVehicleAssigned)
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Vehicle is already assigned to another task, pick a different one"));
        }

        $params = array(
            "vehicle_id" => $vehicle_id,
            "task_id" => $task_id,
            "employee_id" => $supervisor_id
        );

        $task = $this->TaskModel->updateTaskAssign($params);

        if($task !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Task Successfully updated",
                "vehicle" => $task['vehicle'],
                "supervisor" => $task['supervisor']));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update task."));
    }

    public function deleteTask()
    {
        $taskID = trim($this->input->post("task_id"));

        $isTaskDeleted = $this->TaskModel->deleteTask($taskID);

        if($isTaskDeleted !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Successfully deleted"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to delete task."));
    }

    public function deleteTaskAssigned()
    {
        $taskID = trim($this->input->post("task_id"));

        $isTaskDeleted = $this->TaskModel->deleteTaskAssigned($taskID);

        if($isTaskDeleted !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Successfully deleted"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to delete task assigned."));
    }

    public function assignTasksSuperVisor()
    {
        $vehicle_id = trim($this->input->post('vehicle'));
        $supervisor_id = trim($this->input->post('supervisor'));
        $task_id = $this->input->post('task');

        //Check if a task is already assigned to a supervisor
        $isTaskAssigned = $this->TaskModel->CHECK_EXISTENCE("task","is_assigned = 1 AND task_id = ".$task_id);

        if($isTaskAssigned)
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Task is already assigned, pick a different one"));
        }

        //Check if a vehicle is assigned to a task
        $isVehicleAssigned = $this->TaskModel->CHECK_EXISTENCE("vehicle","is_assigned_to_task = 1 AND vehicle_id = ".$vehicle_id);

        if($isVehicleAssigned)
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Vehicle is already assigned to another task, pick a different one"));
        }


        if(empty($vehicle_id))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Please pick a vehicle"));
        }

        if(empty($supervisor_id))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Please pick a supervisor"));
        }

        if(empty($task_id))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Please pick at least one task"));
        }

        $task = $this->TaskModel->assignTasksSuperVisor($task_id,$supervisor_id,$vehicle_id);

        if($task !== null)
        {
            $notificationParams = array(
                "receiver_id" => $supervisor_id,
                "sender_id" => $this->employee['employee_id'],
                "type" => "TASK_ASSIGN",
                "title" => "Task Assigned",
                "message" => 'Good day, A new task has been assigned to you. Please check it out. Thank you.'
            );

            $this->NotificationModel->createNotification($notificationParams);

            $this->response->withJson(array("status"=>"success",
                "message" => "Task Successfully assigned",
                "task" => $task));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to assign task."));
    }

}