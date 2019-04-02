<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 18:04
 */

class LeaveModel extends CI_Model
{
    private $database;

    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    //Manager
    public function getLeaveRequest()
    {
        $qry = "SELECT el.`emp_leave_id`,l.`type`,CONCAT(e.`name`,' ',e.surname) AS 'name',el.`employee_id`,el.`leave_id`,
                el.`is_active`,el.`is_approved`,el.`from_date`,el.`to_date`,
                el.`date_created`, lh.`leave_handler_id`, lh.`days_left`, lh.`days_added`
                FROM `employee_leave` el
                INNER JOIN `leave_days_handler` lh ON el.`emp_leave_id` = lh.`leave_handler_id`
                INNER JOIN `employee` e ON el.`employee_id` = e.`employee_id`
                INNER JOIN `leave` l ON el.`leave_id` = l.`leave_id`
                WHERE el.`is_approved` = 0
                AND el.`is_active` = 1;";

        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function approveLeave($emp_leave_id)
    {
        $qry = "CALL `approveLeave`(:emp_leave_id);";

        $smt = $this->database->prepare($qry);

        $smt->execute(array("emp_leave_id" => $emp_leave_id));

        if($smt->rowCount() > 0)
        {
            return true;
        }
        return false;
    }

    public function rejectLeave($params)
    {
        $qry = "CALL `rejectLeave`(:leave_id,:leave_handler_id,:emp_leave_id);";

        $smt = $this->database->prepare($qry);

        $smt->execute($params);

        if($smt->rowCount() > 0)
        {
            return true;
        }
        return false;
    }

    public function getLeave()
    {
        $qry = "SELECT * 
                FROM `leave` 
                WHERE `is_active` = 1;";

        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getLeaveDescription($leaveID)
    {
        $qry = "SELECT * 
                FROM `leave` 
                WHERE `is_active` = 1
                AND leave_id = :leave_id;";

        $smt = $this->database->prepare($qry);

        $smt->execute(array("leave_id" => $leaveID));

        if($smt->rowCount() > 0)
        {
            return $smt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function applyLeave($params){

        $stmt = $this->database->prepare("call applyLeave(:leave_id, :emp_id, :days_left, :date_from, :date_to,:days_requested);");

        $stmt->execute($params);

        if($stmt){
            return true;
        }
        return false;
    }

    public function getLeaveDaysBalance($params){

        $stmt = $this->database->prepare("SELECT getLeaveDaysBalance(:leave_id, :emp_id);");

        $stmt->execute($params);

        if($stmt){
            return $stmt->fetchColumn(0);
        }
        return null;
    }

    public function getEmpLeaveReport($params){

        $stmt = $this->database->prepare("CALL empLeaveHistory(:emp_id,:date_from,:date_to,:status,:leave_type);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getManagerLeaveReport($params){

        $stmt = $this->database->prepare("CALL leaveHistoryReport(:date_from,:date_to,:status,:leave_type);");

        $stmt->execute(array(
            "date_from" => $params['date_from'],
            "date_to" => $params['date_to'],
            "status" => $params['status'],
            "leave_type" => $params['leave_type']
        ));

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function calculateLeaveDays($params){

        $stmt = $this->database->prepare("SELECT calculateLeaveDays(:date_from, :date_to);");

        $stmt->execute($params);

        if($stmt){
            return $stmt->fetchColumn(0);
        }
        return null;
    }

    public function checkActiveLeave($employeeID)
    {
        $qry = "SELECT * 
                FROM `employee_leave` 
                WHERE `is_active` = 1
                AND `employee_id` = ".(int)$employeeID.";";

        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return true;
        }
        return false;
    }

    public function getLeaveStatus($params)
    {
        $qry = "SELECT el.`is_approved` AS 'approved'
                FROM `employee_leave` el
                INNER JOIN `leave_days_handler` lh ON el.`leave_id` = lh.`leave_id`
                WHERE el.`is_active` = 1
                AND lh.`is_active` = 1
                AND el.`is_active` = 1
                AND el.`leave_id` = ".(int)$params['leave_id']."
                AND lh.`employee_id` = ".(int)$params['employee_id'].";";

        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return LeaveTransformer::transformLeaveStatus($smt->fetch(PDO::FETCH_OBJ));
        }
        return null;
    }

    public function getLeaveByID2($leaveID)
    {

        $stmt = $this->database->query("SELECT *
                                        FROM `leave` 
                                        WHERE `is_active` = 1
                                        AND `leave_id` = ".(int)$leaveID.";");

        $leave = $stmt->fetch(PDO::FETCH_OBJ);

        if($leave !== false) {
            return $leave;
        }
        return null;
    }

    public function getLeaves()
    {
        $qry = "SELECT *, countEmployeesOnLeave(`leave_id`) AS 'employeesOnLeave' 
                FROM `leave` 
                WHERE `is_active` = 1;";

        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function addLeave($params){

        $stmt = $this->database->prepare("INSERT INTO `leave`(`description`, `type`, `days` ,`is_active`) 
                                          VALUES(:description, :leave_type, :days,1 );");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){

            $leaveID = $this->database->lastInsertId();

            $leave = self::getLeaveByID($leaveID);

            if($leave !== null) {
                return $leave;
            }
            return null;
        }
        return null;
    }

    private function getLeaveByID($leaveID)
    {

        $stmt = $this->database->query("SELECT *, countEmployeesOnLeave(`leave_id`) AS 'employeesOnLeave' 
                                        FROM `leave` 
                                        WHERE `is_active` = 1
                                        AND `leave_id` = ".(int)$leaveID.";");

        $leave = $stmt->fetch(PDO::FETCH_OBJ);

        if($leave !== false) {
            return $leave;
        }
        return null;
    }

    public function editLeave($params)
    {
        $qry = "UPDATE `leave` SET `description` = :description,`days` = :days,`type` = :leave_type, 
                `date_created` = NOW()
                WHERE `leave_id` = :leave_id;";

        $stmnt = $this->database->prepare($qry);

        $stmnt->execute($params);

        if ($stmnt->rowCount() > 0) {

            $leave = self::getLeaveByID($params['leave_id']);

            if($leave !== null) {
                return $leave;
            }
            return null;
        }
        return null;
    }

    public function deleteLeave($leaveID)
    {
        $qry = "UPDATE `leave` SET `is_active` = 0,`date_updated` = NOW() 
                WHERE `leave_id` = ".(int)$leaveID.";";

        $stmnt = $this->database->query($qry);

        if($stmnt) {

            return true;
        }
        return false;
    }
}