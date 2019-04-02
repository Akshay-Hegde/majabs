<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 17:27
 */

class Leave extends MY_Controller {

    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["leaves"] = $this->LeaveModel->getLeaves();
        //var_dump($data['employees']); die();
        return $this->load->view('admin/leave/manage_leave',$data);
    }


    public function loadApplyLeave()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["leaves"] = $this->LeaveModel->getLeave();
        return $this->load->view('supervisor/leave/apply_leave',$data);
    }

    public function loadLeaveManager()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data['LeaveRequests'] = $this->LeaveModel->getLeaveRequest();
        //var_dump($data['Leave']); die();
        return $this->load->view('manager/leave/manage_leave',$data);
    }

    public function managerLeaveList()
    {
        $data['notificationsStats'] = $this->notificationStats;
        //UNCOMMENT THIS METHOD WHEN YOU GO LIVE
        $data["leaves"] = $this->LeaveModel->getLeaves();
        //$data["leaves"] = $this->LeaveModel->getLeave();
        //var_dump( $this->LeaveModel->getLeave()); die();
        return $this->load->view('manager/leave/leave_list',$data);
    }

    public function managerLeaveReport()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["leaves"] = $this->LeaveModel->getLeave();
        //var_dump( $this->LeaveModel->getLeave()); die();
        return $this->load->view('manager/report/leave_report',$data);
    }

    public function loadLeaveHistory()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["leaves"] = $this->LeaveModel->getLeave();
        return $this->load->view('supervisor/leave/leave_history',$data);
    }

    public function retrieveLeaveReport()
    {
        $searchByLeaveType = trim($this->input->post('searchByLeaveType'));
        $searchByStatus = trim($this->input->post('searchByStatus'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = $this->input->post('date_to');

        $params = array(
            "date_from" => $date_from,
            "emp_id" => $this->employee['employee_id'],
            "date_to" => $date_to,
            "status" => (int)$searchByStatus,
            "leave_type" => (int)$searchByLeaveType
        );

        if((int)$this->employee['role'] === 3) {
            $report = $this->LeaveModel->getManagerLeaveReport($params);
        }else{
            $report = $this->LeaveModel->getEmpLeaveReport($params);
        }

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
                "message" => "Failed to retrieve leaves."));
        }
    }

    public function loadLeaveList()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $days_left = array();

        $data["leaves"] = $this->LeaveModel->getLeave();

        foreach ($data["leaves"] as $key=>$leave){
            $days_left['days_'.$key] = $this->LeaveModel->getLeaveDaysBalance(
                array("emp_id" => $this->employee['employee_id'],
                    "leave_id" => $leave->leave_id)) ;
            //Here we can get the leave status
            $status['status_'.$key] = $this->LeaveModel->getLeaveStatus(array(
                "leave_id" => $leave->leave_id,
                "employee_id" => $this->employee['employee_id']
            ));
        }

        $data["days_left"] = $days_left;
        $data["status"] = $status;

        return $this->load->view('supervisor/leave/emp_leave_list',$data);
    }

    public function getLeaveDescBalance()
    {
        $leave_id = trim($this->input->get('leave_id'));

        $leave = $this->LeaveModel->getLeaveDescription($leave_id);

        $params = array(
            "leave_id" => $leave_id,
            "emp_id" => $this->employee['employee_id']
        );

        $leaveDaysBalance = $this->LeaveModel->getLeaveDaysBalance($params);

        if($leave !== null)
        {
            $this->response->withJson(array(
                "status"=>"ok",
                "description" => $leave->description,
                "daysBalance" => $leaveDaysBalance));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to get leave desc."));
    }

    public function approveLeave()
    {
        $emp_leave_id = trim($this->input->post('emp_leave_id'));
        $emp_id = trim($this->input->post('emp_id'));
        $leave_id = trim($this->input->post('leave_id'));

        $isApproved = $this->LeaveModel->approveLeave($emp_leave_id);

        if($isApproved)
        {
            $leave = $this->LeaveModel->getLeaveDescription($leave_id);

            $notificationParams = array(
                "receiver_id" => $emp_id,
                "sender_id" => $this->employee['employee_id'],
                "type" => "LEAVE_APPROVED",
                "title" => "Leave Application feedback",
                "message" => "Good day , I trust that this finds you well. Your application for 
                              ".$leave->type." leave you applied has been approved."
            );

            $this->NotificationModel->createNotification($notificationParams);
            $this->response->withJson(array("status"=>"ok",
                "message" => "Leave approved!"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to approve leave."));
    }

    public function rejectLeave()
    {
        $leave_id = trim($this->input->post('leave_id'));
        $leave_handler_id = trim($this->input->post('leave_handler_id'));
        $emp_leave_id = trim($this->input->post('emp_leave_id'));
        $emp_id = trim($this->input->post('emp_id'));

        $params = array(
            "leave_id" => $leave_id,
            "leave_handler_id" => $leave_handler_id,
            "emp_leave_id" => $emp_leave_id
        );

        $isRejected = $this->LeaveModel->rejectLeave($params);

        if($isRejected)
        {
            $leave = $this->LeaveModel->getLeaveDescription($leave_id);

            $notificationParams = array(
                "receiver_id" => $emp_id,
                "sender_id" => $this->employee['employee_id'],
                "type" => "LEAVE_REJECTED",
                "title" => "Leave Application feedback",
                "message" => "Good day , I trust that this finds you well. Unfortunately your application for 
                              ".$leave->type." leave you have recently applied for has been rejected due to 
                             management reasons."
            );

            $this->NotificationModel->createNotification($notificationParams);

            $this->response->withJson(array("status"=>"ok",
                "message" => "Leave rejected!!"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to reject leave."));
    }

    public function applyLeave()
    {
        $days_left = trim($this->input->post('days_left'));
        $leave_type = trim($this->input->post('leave_type'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = trim($this->input->post('date_to'));
        $reason = trim($this->input->post('reason'));
        //die($this->employee['employee_id']);
        //Check if an employee already have an active leave before going any further
        $isLeaveActive = $this->LeaveModel->checkActiveLeave($this->employee['employee_id']);

        if($isLeaveActive){
            $this->response->withJson(array(
                "status" => "fail",
                "message" => "Already have an active leave"));
        }

        $dates = array(
            "date_from" => $date_from,
            "date_to"=> $date_to);
        //Check if an employee has enough days balance
        $days_requested = $this->LeaveModel->calculateLeaveDays($dates);

        if((int)$days_requested > (int)$days_left || (int)$days_requested < 0){
                $this->response->withJson(array(
                    "status" => "fail",
                    "message" => "Pick days that do not exceed your leave balance"));
        }

        $days_remaining = (int)$days_left - (int)$days_requested;

        if(empty($leave_type)){
            $this->response->withJson(array(
                "status" => "fail",
                "message" => "Pick a leave type"));
        }

        if(empty($date_from)){
            $this->response->withJson(array(
                "status" => "fail",
                "message" => "Date from is required"));
        }

        if(empty($date_to)){
            $this->response->withJson(array(
                "status" => "fail",
                "message" => "Date from is required"));
        }

        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $reason),
            array("name" => "max", "value" => 50, "field" => $reason)
        );

        $valid = $this->validator->validate($reason,$validationRules,"Reason");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "emp_id" => $this->employee['employee_id'],
            "leave_id" => $leave_type,
            "days_left" => $days_remaining,
            "days_requested" => $days_requested,
            "date_from" => $date_from,
            "date_to" => $date_to,
        );

        $isApplied = $this->LeaveModel->applyLeave($params);

        if($isApplied !== false)
        {
            $leave = $this->LeaveModel->getLeaveDescription($leave_type);
            //Get manager id
            $managerIDs = $this->EmployeeModel->getManagerIDs();

            foreach ($managerIDs as $id) {
                $notificationParams = array(
                    "receiver_id" => $id,
                    "sender_id" => $this->employee['employee_id'],
                    "type" => "LEAVE_REQUEST",
                    "title" => "Leave request",
                    "message" => $this->employee['name'].' '.$this->employee['surname']. ' has requested for ' . $leave->type . ' leave from ' . $date_from . ' to ' . $date_to
                );
                $this->NotificationModel->createNotification($notificationParams);
            }


            $this->response->withJson(array("status"=>"ok",
                "message" => "Leave Successfully applied"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to apply leave."));
    }

    public function addLeave()
    {
        $description = trim($this->input->post('description'));
        $days = trim($this->input->post('days'));
        $type = trim($this->input->post('type'));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $description),
            array("name" => "max", "value" => 250, "field" => $description)
        );

        $valid = $this->validator->validate($description,$validationRules,"Description");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 1, "field" => $days),
            array("name" => "max", "value" => 5, "field" => $days)
        );

        $valid = $this->validator->validate($days,$validationRules,"Days");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $type),
            array("name" => "max", "value" => 50, "field" => $type)
        );

        $valid = $this->validator->validate($type,$validationRules,"Leave type");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "description" =>$description,
            "leave_type" =>$type,
            "days" =>$days
        );

        $leave = $this->LeaveModel->addLeave($params);

        if($leave !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Leave Successfully registered",
                "leave" => $leave));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to add leave."));
    }

    public function editLeave()
    {
        $description = trim($this->input->post('description'));
        $days = trim($this->input->post('days'));
        $type = trim($this->input->post('type'));
        $leave_id = trim($this->input->post('leave_id'));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $description),
            array("name" => "max", "value" => 250, "field" => $description)
        );

        $valid = $this->validator->validate($description,$validationRules,"Description");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 1, "field" => $days),
            array("name" => "max", "value" => 5, "field" => $days)
        );

        $valid = $this->validator->validate($days,$validationRules,"Days");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $type),
            array("name" => "max", "value" => 50, "field" => $type)
        );

        $valid = $this->validator->validate($type,$validationRules,"Leave type");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "description" =>$description,
            "leave_type" =>$type,
            "days" =>$days,
            "leave_id" =>$leave_id
        );

        $leave = $this->LeaveModel->editLeave($params);

        if($leave !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Leave Successfully updated",
                "leave" => $leave));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update leave."));
    }

    public function deleteLeave()
    {
        $leave_id = trim($this->input->post('leave_id'));

        $isLeaveDeleted = $this->LeaveModel->deleteLeave($leave_id);

        if($isLeaveDeleted !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Successfully deleted"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to delete leave."));
    }

    //Employee
    public function loadEmpApplyLeave()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["leaves"] = $this->LeaveModel->getLeave();
        return $this->load->view('employee/leave/apply_leave',$data);
    }

    public function loadEmpLeaveHistory()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data["leaves"] = $this->LeaveModel->getLeave();
        return $this->load->view('employee/leave/leave_history',$data);
    }

    public function retrieveEmpLeaveReport()
    {
        $searchByLeaveType = trim($this->input->post('searchByLeaveType'));
        $searchByStatus = trim($this->input->post('searchByStatus'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = $this->input->post('date_to');

        $params = array(
            "date_from" => $date_from,
            "emp_id" => $this->employee['employee_id'],
            "date_to" => $date_to,
            "status" => (int)$searchByStatus,
            "leave_type" => (int)$searchByLeaveType
        );

        $report = $this->LeaveModel->getEmpLeaveReport($params);
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
                "message" => "Failed to retrieve leaves."));
        }
    }

    public function loadEmpLeaveList()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $days_left = array();

        $data["leaves"] = $this->LeaveModel->getLeave();

        foreach ($data["leaves"] as $key=>$leave){
            $days_left['days_'.$key] = $this->LeaveModel->getLeaveDaysBalance(
                array("emp_id" => $this->employee['employee_id'],
                    "leave_id" => $leave->leave_id)) ;
            //Here we can get the leave status
            $status['status_'.$key] = $this->LeaveModel->getLeaveStatus(array(
                "leave_id" => $leave->leave_id,
                "employee_id" => $this->employee['employee_id']
            ));
        }

        $data["days_left"] = $days_left;
        $data["status"] = $status;

        return $this->load->view('employee/leave/emp_leave_list',$data);
    }

}