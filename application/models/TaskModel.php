
<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 18:05
 */

class TaskModel extends CI_Model
{
    private $database;

    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    //Emp
    public function getEmpTaskReport($params){

        $stmt = $this->database->prepare("call empTaskHistory(:emp_id, :date_from, :date_to, :status);");

        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getSupervisorTaskReport($params){

        $stmt = $this->database->prepare("call supervisorTaskHistory(:supervisor_id, :date_from, :date_to, :status);");

        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }
    //Supervisor
    public function getTaskToBeAssignedToEmp($employeeID)
    {
        //JOIN employee_task to check if the task is assigned to employee
        $stmt = $this->database->prepare("SELECT t.`task_id`, t.`title`, t.`description`
                                        FROM `task` t
                                        INNER JOIN `supervisor_task` st ON t.`task_id` = st.`task_id`
                                        WHERE t.`is_active` = 1
                                        AND t.`is_completed` = 0
                                        AND t.`is_assigned` = 1
                                        AND t.`assigned_to_emp` = 0
                                        AND st.`is_active` = 1
                                        AND st.`supervisor_id` =".$employeeID.";");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getTaskAssignedToEmp($supervisor_id)
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT t.`task_id`, t.`title`, t.`description`, e.`name` AS 'employee',et.`employee_id`
                                        FROM `task` t
                                        INNER JOIN `employee_task` et ON t.`task_id` = et.`task_id`
                                        INNER JOIN `employee` e ON et.`employee_id` = e.`employee_id`
                                        WHERE e.`role` = 4
                                        AND t.`is_active` = 1
                                        AND t.`is_assigned` = 1
                                        AND t.`is_completed` = 0
                                        AND et.`is_active` = 1
                                        AND et.`supervisor_id` = ".$supervisor_id.";");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getTaskAssignedToEmpByID($taskID)
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT t.`task_id`, t.`title`, t.`description`, e.`name` 'employee',et.`employee_id`
                                        FROM `task` t
                                        INNER JOIN `employee_task` et ON t.`task_id` = et.`task_id`
                                        INNER JOIN `employee` e ON et.`employee_id` = e.`employee_id`
                                        WHERE e.`role` = 4
                                        AND t.`task_id` = :task_id;");

        $stmt->execute(array("task_id" => $taskID));

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function assignEmployeeTask($params)
    {

        try{

            $this->db->trans_begin();

            $stmt = $this->database->prepare("INSERT INTO `employee_task`(`employee_id`,`task_id`,`supervisor_id`) 
                                              VALUES(:employee_id,:task_id,:supervisor_id );");

            $stmt->execute($params);

            //Update employee to assigned task
            $assignEmp = $this->database->query("UPDATE `employee` SET `is_assigned_task` = 1, `date_updated` = NOW() 
                                                WHERE `employee_id` = ".$params['employee_id'].";");

            //Update vehicle to is on task
            $assignTask = $this->database->query("UPDATE `task` SET `is_assigned` = 1,`assigned_to_emp` = 1, `date_updated` = NOW() 
                                                WHERE `task_id` = ".$params['task_id'].";");

            if ($assignTask !== false) {

                $assignedTask = self::getTaskAssignedToEmpByID($params['task_id']);

                $this->db->trans_commit();
                return $assignedTask;
            }

        }catch (Exception $e){
            $this->db->trans_rollback();
            return null;
        }
        return null;
    }

    public function updateEmpTaskAssign($params)
    {
        //Get old supervisor and old vehicle and remove them from being assigned a service
        $oldSupervisor = $this->database->query("SELECT * FROM `employee_task` 
                                                WHERE `is_active` = 1
                                                AND `task_id` = ".$params['task_id'].";");

        $this->database->query("UPDATE `employee` SET `is_assigned_task` = 0,`date_updated` = NOW() 
                                                  WHERE `employee_id` = ".$oldSupervisor->fetch(PDO::FETCH_OBJ)->employee_id.";" );


            $stmt = $this->database->prepare("UPDATE `employee_task` SET `employee_id` = :employee_id, `date_updated` = NOW() 
                                              WHERE `is_active` = 1 
                                              AND `task_id` = :task_id");

            $stmt->execute(array("employee_id" => $params['employee_id'],
                "task_id" => $params['task_id']));

            $this->database->query("UPDATE `employee` SET `is_assigned_task` = 1,`date_updated` = NOW() 
                                                  WHERE `employee_id` = ".$params['employee_id'].";" );

            //Get new employee name and new vehicle name
            $supervisor = $this->database->query("SELECT * FROM `employee` WHERE `employee_id` = ".$params['employee_id'].";");

            if($supervisor !== false) {
                return $supervisor->fetch(PDO::FETCH_OBJ);
            }

        return null;
    }

    public function deleteEmpTaskAssigned($taskID)
    {
        //The purpose for this is to detach the vehicle and supervisor that is linked to this task
        $taskSupervisor = $this->database->query("SELECT * FROM `employee_task` 
                                                  WHERE `is_active` = 1 
                                                  AND`task_id` = ".$taskID.";");
        //var_dump($taskSupervisor); die();
        //Set free a vehicle and supervisor
        $this->database->query("UPDATE `employee` SET `is_assigned_task` = 0,`date_updated` = NOW() 
                                WHERE `employee_id` = ".$taskSupervisor->fetch(PDO::FETCH_OBJ)->employee_id.";" );

        $this->database->query("UPDATE `task` SET `assigned_to_emp` = 0,`date_updated` = NOW() 
                                WHERE `task_id` = ".$taskID.";" );


        $isUpdated = $this->database->query("UPDATE `employee_task` SET `is_active` = 0, `date_updated` = NOW() 
                                            WHERE `is_active` = 1 
                                            AND `task_id` = ".$taskID.";" );

        if($isUpdated !== false){
            return true;
        }
        return false;
    }

    public function updateEmpTaskStatus($task_id){

            $employeeID = $this->database->query("SELECT  et.`employee_id` 
                                                      FROM `employee_task` et  
                                                      INNER JOIN `employee` e ON et.`employee_id` = e.`employee_id` 
                                                      WHERE et.`is_active` = 1 
                                                      AND et.`task_id` = ".$task_id.";");

            $supervisorID = $this->database->query("SELECT  st.`supervisor_id` 
                                                        FROM `supervisor_task` st  
                                                        INNER JOIN `employee` e ON st.`supervisor_id` = e.`employee_id` 
                                                        WHERE st.`is_active` = 1 
                                                        AND st.`task_id` = ".$task_id.";");

            $vehicleID = $this->database->query("SELECT tv.`vehicle_id`
                                                    FROM `task_vehicle` tv
                                                    INNER JOIN vehicle v ON tv.`vehicle_id` = v.`vehicle_id`
                                                    WHERE tv.`is_active` = 1
                                                    AND tv.`task_id` = ".$task_id.";");
            //die($vehicleID->fetchColumn(0).' '.$supervisorID->fetchColumn(0).' '.$employeeID->fetchColumn(0).' '.$task_id);
            //Get a vehicle
            $this->database->query("UPDATE `employee` SET `is_assigned_task` = 0, `date_updated` = NOW() 
                                      WHERE `employee_id` = ".$supervisorID->fetchColumn(0).";");

            $this->database->query("UPDATE `employee` SET `is_assigned_task` = 0, `date_updated` = NOW() 
                                      WHERE `employee_id` = ".$employeeID->fetchColumn(0).";");


            $this->database->query("UPDATE `vehicle` SET `is_assigned_to_task` = 0, `date_updated` = NOW() 
                                          WHERE `vehicle_id` = ".$vehicleID->fetchColumn(0).";");
            //------
            $this->database->query("UPDATE `employee_task` SET `is_completed` = 1, `date_updated` = NOW() 
                                  WHERE `is_active` = 1 
                                  AND `task_id` = ".$task_id.";");

            $this->database->query("UPDATE `supervisor_task` SET `is_completed` = 1, `date_updated` = NOW() 
                                  WHERE `is_active` = 1 
                                  AND `task_id` = ".$task_id.";");

            $this->database->query("UPDATE `task_vehicle` SET `is_done` = 1, `date_updated` = NOW() 
                                  WHERE `is_active` = 1 
                                  AND `task_id` = ".$task_id.";");

            $this->database->query("UPDATE `task` SET `is_completed` = 1, `date_updated` = NOW() 
                                  WHERE `is_active` = 1 
                                  AND `task_id` = ".$task_id.";");

    }

    public function getManagerTaskReport($params){

        $stmt = $this->database->prepare("call taskHistoryReport(:status);");

        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function registerTask($params){

        try{

            $this->db->trans_begin();

            $stmt = $this->database->prepare("INSERT INTO `task`(`title`,`description`) 
                                          VALUES(:title,:description )");

            $stmt->execute(array(
                "title" => $params['title'],
                "description" => $params['description']
            ));

            if (!($stmt->rowCount() > 0))
            {
                return null;
            }

            $taskID = $this->database->lastInsertId();

            foreach ($params['attributes'] as $attribute) {

                $qryAttribute = "INSERT INTO `task_attribute`(`task_id`,`attribute_id`) 
                    VALUES(:task_id,:attribute_id);";

                $stmnt = $this->database->prepare($qryAttribute);

                $stmnt->execute(array(
                    "task_id" => $taskID,
                    "attribute_id" => $attribute
                ));
            }

            //Commit if both business and user is registered
            $stmt = $this->database->prepare("SELECT t.`task_id`, t.`title`, t.`description`,getTaskAttributes(t.`task_id`) AS 'attributes'
                                                FROM `task` t
                                                WHERE t.`task_id` = :task_id;");

            $stmt->execute(array("task_id" => $taskID));

            if ($stmt) {
                $task = $stmt->fetch(PDO::FETCH_OBJ);
                $this->db->trans_commit();
                return $task;
            }

        }catch (Exception $e){
            $this->db->trans_rollback();
            return null;
        }
    }

    public function assignTasksSuperVisor($task_id,$supervisor_id,$vehicle_id){

        try{

                $this->db->trans_begin();

                $stmt = $this->database->prepare("INSERT INTO `supervisor_task`(`supervisor_id`,`task_id`) 
                                              VALUES(:supervisor_id,:task_id );");

                $stmt->execute(array(
                    "supervisor_id" => $supervisor_id,
                    "task_id" => $task_id
                ));

                //Update employee to assigned task
                $stmt = $this->database->query("UPDATE `employee` SET `is_assigned_task` = 1, `date_updated` = NOW() 
                                                WHERE `employee_id` = ".$supervisor_id.";");

                //Update vehicle to is on task
                $stmt = $this->database->query("UPDATE `vehicle` SET `is_assigned_to_task` = 1, `date_updated` = NOW() 
                                                WHERE `vehicle_id` = ".$vehicle_id.";");
                //Update vehicle to is on task
                $stmt = $this->database->query("UPDATE `task` SET `is_assigned` = 1, `date_updated` = NOW() 
                                                WHERE `task_id` = ".$task_id.";");

                $qryAttribute = "INSERT INTO `task_vehicle`(`task_id`,`vehicle_id`) 
                                VALUES(:task_id,:vehicle_id);";

                $stmnt = $this->database->prepare($qryAttribute);

                $stmnt->execute(array(
                    "task_id" => $task_id,
                    "vehicle_id" => $vehicle_id
                ));

            if ($stmt) {

                $assignedTask = self::getAssignedTaskByID($task_id);

                $this->db->trans_commit();
                return $assignedTask;
            }

        }catch (Exception $e){
            $this->db->trans_rollback();
            return null;
        }
        return null;
    }

    public function getTaskAttributes($taskID)
    {
        //Commit if both business and user is registered
        $stmt = $this->database->query("SELECT ta.`task_attribute_id`, ta.`task_id`, ta.`attribute_id`
                                        FROM `task_attribute` ta
                                        WHERE ta.`is_active` = 1
                                        AND ta.`task_id` = $taskID");

        $task = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($task !== false) {
            return $task;
        }
        return null;
    }

    public function getTasks()
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT `task_id`, `title`, `description`,getTaskAttributes(`task_id`) AS 'attributes'
                                        FROM `task`
                                        WHERE `is_active` = 1;");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getTaskToBeAssigned()
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT `task_id`, `title`, `description`,getTaskAttributes(`task_id`) AS 'attributes'
                                        FROM `task`
                                        WHERE `is_active` = 1
                                        AND `is_completed` = 0
                                        AND `is_assigned` = 0;");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getTaskByID($taskID)
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT `task_id`, `title`, `description`,getTaskAttributes(`task_id`) AS 'attributes'
                                        FROM `task`
                                        WHERE `task_id` = :task_id
                                        AND `is_active` = 1;");

        $stmt->execute(array(
            "task_id" => $taskID
        ));

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetch(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getTaskVehicles()
    {
        $stmt = $this->database->prepare("SELECT `vehicle_id`, `vehicle_name`
                                        FROM `vehicle`
                                        WHERE `is_active` = 1
                                        AND `is_assigned_to_task` = 0;");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getTaskSuperVisors()
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT `employee_id`, `name`, `surname`
                                        FROM `employee`
                                        WHERE `is_active` = 1
                                        AND `is_on_leave` = 0
                                        AND `is_blocked` = 0
                                        AND `role` = 2;");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $supervisors = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $supervisors;
        }
        return null;
    }

    public function getAssignedTasks()
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT t.`task_id`, t.`title`, t.`description`, e.`name` AS 'supervisor',
                                        st.`supervisor_id` AS 'employee_id',v.`vehicle_name`
                                        FROM `task` t
                                        INNER JOIN `supervisor_task` st ON t.`task_id` = st.`task_id`
                                        INNER JOIN `task_vehicle` tv ON t.`task_id` = tv.`task_id`
                                        INNER JOIN `vehicle` v ON tv.`vehicle_id` = v.`vehicle_id`
                                        INNER JOIN `employee` e ON st.`supervisor_id` = e.`employee_id`
                                        WHERE e.`role` = 2
                                        AND t.`is_active` = 1
                                        AND t.`is_assigned` = 1
                                        AND st.`is_active` = 1
                                        AND tv.`is_active` = 1;");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function getAssignedTaskByID($taskID)
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT t.`task_id`, t.`title`, t.`description`, e.`name` 'supervisor',
                                        st.`supervisor_id` AS 'employee_id',v.`vehicle_name`
                                        FROM `task` t
                                        INNER JOIN `supervisor_task` st ON t.`task_id` = st.`task_id`
                                        INNER JOIN `task_vehicle` tv ON t.`task_id` = tv.`task_id`
                                        INNER JOIN `vehicle` v ON tv.`vehicle_id` = v.`vehicle_id`
                                        INNER JOIN `employee` e ON st.`supervisor_id` = e.`employee_id`
                                        WHERE e.`role` = 2
                                        AND t.`task_id` = :task_id;");

        $stmt->execute(array("task_id" => $taskID));

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $task;
        }
        return null;
    }

    public function UpdateTask($params,$attributeIDs)
    {
        $stmt = $this->database->prepare("UPDATE `task` SET `title` = :title, `description` = :description 
                                          WHERE `task_id` = :task_id" );

        $stmt->execute($params);

        if ($stmt) {
            $isAttributesUpdated = self::updateAttributes($params['task_id'],$attributeIDs);

            if($isAttributesUpdated)
            {
                $task = self::getTaskByID($params['task_id']);

                return $task;
            }

            return null;
        }
        return null;
    }

    public function updateTaskAssign($params)
    {
        //Get old supervisor and old vehicle and remove them from being assigned a service
        $oldSupervisor = $this->database->query("SELECT * FROM `supervisor_task` WHERE `task_id` = ".$params['task_id'].";");
        $oldVehicle = $this->database->query("SELECT * FROM `task_vehicle` WHERE `task_id` = ".$params['task_id'].";");

        $this->database->query("UPDATE `vehicle` SET `is_assigned_to_task` = 0,`date_updated` = NOW() 
                                                    WHERE `vehicle_id` = ".$oldVehicle->fetch(PDO::FETCH_OBJ)->vehicle_id.";" );

        $this->database->query("UPDATE `employee` SET `is_assigned_task` = 0,`date_updated` = NOW() 
                                                  WHERE `employee_id` = ".$oldSupervisor->fetch(PDO::FETCH_OBJ)->supervisor_id.";" );

        //var_dump($params); die();
        $stmt = $this->database->prepare("UPDATE `task_vehicle` SET `vehicle_id` = :vehicle_id, `date_updated` = NOW() 
                                          WHERE `task_id` = :task_id AND `is_done` = 0" );

        $stmt->execute(array("vehicle_id" => $params['vehicle_id'],
                            "task_id" => $params['task_id']));

        if ($stmt) {

            $stmt = $this->database->prepare("UPDATE `supervisor_task` SET `supervisor_id` = :supervisor_id, `date_updated` = NOW() 
                                              WHERE `task_id` = :task_id");

            $stmt->execute(array("supervisor_id" => $params['employee_id'],
                "task_id" => $params['task_id']));

            $this->database->query("UPDATE `vehicle` SET `is_assigned_to_task` = 1,`date_updated` = NOW() 
                                                    WHERE `vehicle_id` = ".$params['vehicle_id'].";" );

            $this->database->query("UPDATE `employee` SET `is_assigned_task` = 1,`date_updated` = NOW() 
                                                  WHERE `employee_id` = ".$params['employee_id'].";" );

            //Get new employee name and new vehicle name
            $supervisor = $this->database->query("SELECT * FROM `employee` WHERE `employee_id` = ".$params['employee_id'].";");
            $vehicle = $this->database->query("SELECT * FROM `vehicle` WHERE `vehicle_id` = ".$params['vehicle_id'].";");

            return array("vehicle" => $vehicle->fetch(PDO::FETCH_OBJ),"supervisor" => $supervisor->fetch(PDO::FETCH_OBJ));
        }
        return null;
    }

    private function updateAttributes($taskID,$attributesIDs)
    {
        $deactivateAttributes = "UPDATE `task_attribute` SET `is_active` = 0 WHERE `task_id` = ".(int)$taskID.";";

        $stmnt = $this->database->query($deactivateAttributes);

        if($stmnt) {
            foreach ($attributesIDs as $id) {

                $existingID = $this->database->prepare("SELECT * FROM `task_attribute` WHERE `task_id` = :task_id
                                                      AND `attribute_id` = :attribute_id;");
                $existingID->execute(array("attribute_id"=>$id,"task_id"=>$taskID));
                if ($existingID->rowCount() > 0) {
                    $this->database->query("UPDATE `task_attribute` SET `is_active` = 1 WHERE `task_id` = " . (int)$taskID . " 
                                            AND `attribute_id` = " . (int)$id . ";");
                }
                else
                {
                    $this->database->query("INSERT INTO task_attribute (`task_id`,`attribute_id`) 
                                            VALUES(" . (int)$taskID . "," . (int)$id . ");");
                }
            }
            return true;
        }
        return false;
    }

    public function deleteTask($taskID)
    {
        $qry = "UPDATE `task` SET `is_active` = 0,`date_updated` = NOW() WHERE `task_id` = ".(int)$taskID.";";

        $stmnt = $this->database->query($qry);

        if($stmnt) {

            return true;
        }
        return false;
    }

    public function deleteTaskAssigned($taskID)
    {
        //The purpose for this is to detach the vehicle and supervisor that is linked to this task
        $taskSupervisor = $this->database->query("SELECT * FROM `supervisor_task` 
                                                WHERE `is_active` = 1 
                                                AND`task_id` = ".$taskID.";");
        $taskVehicle = $this->database->query("SELECT * FROM `task_vehicle` 
                                                WHERE `is_active` = 1
                                                AND `task_id` = ".$taskID.";");

        //Set free a vehicle and supervisor
        $this->database->query("UPDATE `employee` SET `is_assigned_task` = 0,`date_updated` = NOW() 
                              WHERE `employee_id` = ".$taskSupervisor->fetch(PDO::FETCH_OBJ)->supervisor_id.";" );

        $this->database->query("UPDATE `vehicle` SET `is_assigned_to_task` = 0,`date_updated` = NOW() 
                                WHERE `vehicle_id` = ".$taskVehicle->fetch(PDO::FETCH_OBJ)->vehicle_id.";" );


        $this->database->query("UPDATE `task` SET `is_assigned` = 0,`date_updated` = NOW() 
                                WHERE `task_id` = ".$taskID.";" );

        $this->database->query("UPDATE `task_vehicle` SET `is_active` = 0, `date_updated` = NOW() 
                                WHERE `is_active` = 1 
                                AND `task_id` = ".$taskID.";" );

        $isUpdated = $this->database->query("UPDATE `supervisor_task` SET `is_active` = 0, `date_updated` = NOW() 
                                            WHERE `is_active` = 1 
                                            AND `task_id` = ".$taskID.";" );

        if($isUpdated !== false){
            return true;
        }
    return false;
    }
    //This method will be used to check existence of supervisor and vehice in the project
    public function CHECK_EXISTENCE($tableName, $fields)
    {
        //Commit if both business and user is registered
        $stmt = $this->database->prepare("SELECT * FROM $tableName WHERE $fields;");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}