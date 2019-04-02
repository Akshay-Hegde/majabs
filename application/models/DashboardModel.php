<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2018/10/12
 * Time: 15:32
 */

class DashboardModel extends  CI_Model
{
    private $database;

    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }


    public function empStats($emp_id)
    {
        $qry = "SELECT calculateDaysAtWork('.$emp_id.');";

        $stmnt = $this->database->query($qry);
        $totalDays  = $stmnt->fetchColumn(0);

        $qry = "SELECT getEmpTotalTasks('.$emp_id.');";

        $stmnt = $this->database->query($qry);
        $totalTasks = $stmnt->fetchColumn(0);


        $empStats = array(
                "totalDays" => ($totalDays === false ? 0 : $totalDays),
                "totalTasks" => ($totalTasks === false ? 0 : $totalTasks));

        return $empStats;
    }

    public function managerStats()
    {
        $qry = "SELECT COUNT(`vehicle_id`) 
                FROM `vehicle` 
                WHERE `is_active` = 1;";

        $stmnt = $this->database->query($qry);
        $totalVehicles = $stmnt->fetchColumn(0);

        $qry = "SELECT COUNT(`employee_id`) 
                FROM `employee` 
                WHERE `is_active` = 1
                AND `role` != 3;";

        $stmnt = $this->database->query($qry);
        $totalEmployees = $stmnt->fetchColumn(0);

        $qry = "SELECT COUNT(`task_id`) 
                FROM `task` 
                WHERE `is_active` = 1;";

        $stmnt = $this->database->query($qry);
        $totalTasks = $stmnt->fetchColumn(0);

        $qry = "SELECT SUM(`price`) 
                FROM `vehicle_service`;";

        $stmnt = $this->database->query($qry);
        $totalServiceAmount = $stmnt->fetchColumn(0);

        $qry = "SELECT COUNT(`employee_id`) 
                FROM `employee`
                WHERE `is_active` = 1
                AND `is_on_leave` = 1;";

        $stmnt = $this->database->query($qry);
        $totalEmpOnLeave = $stmnt->fetchColumn(0);

        $qry = "SELECT COUNT(`vehicle_id`) 
                FROM `vehicle`
                WHERE `is_assigned_to_task` = 1;";

        $stmnt = $this->database->query($qry);
        $vehiclesOnTask = $stmnt->fetchColumn(0);


        $managerStats = array(
                "totalVehicles" => ($totalVehicles === false ? 0 : $totalVehicles),
                "totalEmployees" => ($totalEmployees === false ? 0 : $totalEmployees),
                "totalTasks" => ($totalTasks === false ? 0 : $totalTasks),
                "totalServiceAmount" => ($totalServiceAmount === false ? 0 : $totalServiceAmount),
                "totalEmpOnLeave" => ($totalEmpOnLeave === false ? 0 : $totalEmpOnLeave),
                "vehiclesOnTask" => ($vehiclesOnTask === false ? 0 : $vehiclesOnTask));

        return $managerStats;
    }

    public function adminStats()
    {
        $qry = "SELECT IFNULL(COUNT(`vehicle_id`), 0) as 'totalVehicles'
				FROM `vehicle`
			    WHERE `is_active` = 1;";

        $stmnt = $this->database->query($qry);
        $totalVehicles  = $stmnt->fetchColumn(0);

        $qry = "SELECT IFNULL(COUNT(`task_id`), 0) as 'totalTasks'
				FROM `task`
				WHERE `is_active` = 1;";

        $stmnt = $this->database->query($qry);
        $totalTasks = $stmnt->fetchColumn(0);

        $qry = "SELECT IFNULL(COUNT(`employee_id`), 0) as 'totalEmployees'
				FROM `employee`
			    WHERE `is_active` = 1;";

        $stmnt = $this->database->query($qry);
        $totalEmployees = $stmnt->fetchColumn(0);

        $adminStats = array(
                "total_vehicles" => $totalVehicles,
                "total_tasks" => $totalTasks,
                "total_employees" => $totalEmployees);

        return $adminStats;
    }

    public function supervisorStats($supervisorID){

        $totalTask = $this->database->query("SELECT COUNT(t.`task_id`) AS 'totalTask'
                                        FROM `task` t
                                        INNER JOIN `supervisor_task` et ON t.`task_id` = et.`task_id`
                                        INNER JOIN `employee` e ON et.`supervisor_id` = e.`employee_id`
                                        WHERE e.`role` = 2
                                        AND t.`is_active` = 1
                                        AND t.`is_assigned` = 1
                                        AND et.`is_active` = 1
                                        AND et.`supervisor_id` = ".$supervisorID.";");

        $totalCompletedTask = $this->database->query("SELECT COUNT(t.`task_id`) AS 'totalCompleted'
                                                        FROM `task` t
                                                        INNER JOIN `employee_task` et ON t.`task_id` = et.`task_id`
                                                        INNER JOIN `employee` e ON et.`employee_id` = e.`employee_id`
                                                        WHERE e.`role` = 4
                                                        AND t.`is_active` = 1
                                                        AND t.`is_assigned` = 1
                                                        AND t.`is_completed` = 1
                                                        AND et.`is_active` = 1
                                                        AND et.`supervisor_id` = ".$supervisorID.";");

        $totalPendingTask = $this->database->query("SELECT COUNT(t.`task_id`) AS 'totalPending'
                                        FROM `task` t
                                        INNER JOIN `employee_task` et ON t.`task_id` = et.`task_id`
                                        INNER JOIN `employee` e ON et.`employee_id` = e.`employee_id`
                                        WHERE e.`role` = 4
                                        AND t.`is_active` = 1
                                        AND t.`is_assigned` = 1
                                        AND t.`is_completed` = 0
                                        AND et.`is_active` = 1
                                        AND et.`supervisor_id` = ".$supervisorID.";");

        return array("totalTasks" => $totalTask->fetchColumn(0),
            "totalCompletedTasks" => $totalCompletedTask->fetchColumn(0),
            "totalPendingTasks" => $totalPendingTask->fetchColumn(0));
    }
}