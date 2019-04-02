<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 18:05
 */

class ServiceModel extends CI_Model
{
    private $database;

    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    public function getServiceVehiclesByID($params){

        $stmt = $this->database->prepare("CALL getServiceVehicleByID(:service_id);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getManagerVehicleReport($params){

        $stmt = $this->database->prepare("CALL managerVehicleReport(:status,:date_from,:date_to);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function addService($service_type){

        $stmt = $this->database->prepare("INSERT INTO `service`(`service_type`,`is_active`) 
                                          VALUES(:service_type,1 )");

        $stmt->execute(array("service_type" => $service_type));

        if($stmt->rowCount() > 0){

            $serviceID = $this->database->lastInsertId();

            $stmt = $this->database->query("SELECT * , countNumberOfVehicles(`service_id`) AS 'numberOfVehicles' FROM `service` 
                                              WHERE `service_id` = ".(int)$serviceID." 
                                              AND `is_active` = 1");

            $service = $stmt->fetch(PDO::FETCH_OBJ);

            if($service !== false) {
                return $service;
            }
            return null;
        }
        return null;
    }

    public function assignService($params,$service_date){

        $stmt = $this->database->prepare("INSERT INTO `vehicle_service`(`service_id`,`vehicle_id`,`price`) 
                                          VALUES(:service_id,:vehicle_id,:price)");

        $stmt->execute($params);
        $vehicle_service_id = $this->database->lastInsertId();

        if($stmt->rowCount() > 0){

                $qry = "UPDATE `vehicle` SET `next_service_date` = :service_date, `date_updated` = NOW()
                        WHERE `vehicle_id` = :vehicle_id;";

                $stmt = $this->database->prepare($qry);
                $stmt->execute(array("service_date" => $service_date,
                                     "vehicle_id" => $params['vehicle_id']));

                if($stmt->rowCount() > 0)
                {
                    $stmt = $this->database->query("SELECT vs.`vehicle_service_id`,v.`vehicle_registration_number`, 
                                                    v.`vehicle_id`, v.`vehicle_name`, 
                                                    v.`next_service_date`, s.`service_type`, vs.`price`, vs.`service_active`
                                                    FROM `vehicle` v
                                                    INNER JOIN `vehicle_service` vs ON v.`vehicle_id` = vs.vehicle_id
                                                    INNER JOIN `service` s ON vs.`service_id` = s.`service_id`
                                                    AND vs.`vehicle_service_id` = ".$vehicle_service_id.";");

                    $assignedService = $stmt->fetch(PDO::FETCH_OBJ);

                    if ($assignedService !== false) {
                        return $assignedService;
                    }
                }
           return null;
        }
        return null;
    }

    public function updateService($params)
    {
        $qry = "UPDATE `service` SET `service_type` = :service_type,`date_updated` = NOW()
                WHERE `service_id` = :service_id;";

        $stmnt = $this->database->prepare($qry);

        $stmnt->execute($params);

        if ($stmnt->rowCount() > 0) {

            $stmt = $this->database->query("SELECT * FROM `service` 
                                              WHERE `service_id` = " . (int)$params['service_id'] . " 
                                              AND `is_active` = 1");

            $service = $stmt->fetch(PDO::FETCH_OBJ);

            if ($service !== false) {
                return $service;
            }
            return null;
        }
        return null;
    }

    public function editServiceAssignment($params)
    {
        $stmt = $this->database->query("SELECT v.`vehicle_id`
                                        FROM vehicle v
                                        INNER JOIN vehicle_service vs ON v.vehicle_id = vs.vehicle_id
                                        WHERE vs.vehicle_service_id = ".(int)$params['vehicle_service_id'].";");

        $vehicleID = $stmt->fetchColumn(0);

        $qry = "UPDATE `vehicle` SET `next_service_date` = :service_date,`date_updated` = NOW()
                WHERE `vehicle_id` = :vehicle_id;";

        $stmnt = $this->database->prepare($qry);

        $stmnt->execute(array(
            "vehicle_id" => $vehicleID,
            "service_date" => $params['service_date']
        ));

        if ($stmnt->rowCount() > 0) {

            $qry = "UPDATE `vehicle_service` SET `price` = :price,`date_updated` = NOW()
                    WHERE `vehicle_service_id` = :vehicle_service_id;";

            $stmnt = $this->database->prepare($qry);

            $stmnt->execute(array(
                "price" => $params['price'],
                "vehicle_service_id" => $params['vehicle_service_id']
            ));
//I just made changes here
            if($stmnt->rowCount() > 0)
            {
                $stmt = $this->database->query("SELECT vs.`vehicle_service_id`,v.`vehicle_registration_number`, v.`vehicle_id`, v.`vehicle_name`, 
                                                v.`next_service_date`, s.`service_type`, vs.`price`, vs.`service_active`
                                                FROM `vehicle` v
                                                INNER JOIN `vehicle_service` vs ON v.`vehicle_id` = vs.vehicle_id
                                                INNER JOIN `service` s ON vs.`service_id` = s.`service_id`
                                                WHERE vs.`vehicle_service_id` = ".(int)$params['vehicle_service_id']."
                                                AND vs.`service_active` = 1");

                $newServiceVehicle = $stmt->fetch(PDO::FETCH_OBJ);
                return $newServiceVehicle;
            }
        }
        return null;
    }

    public function deleteService($serviceID)
    {
        $qry = "UPDATE `service` 
              SET `is_active` = 0, `date_updated` = NOW() 
              WHERE `service_id` = ".(int)$serviceID.";";

        $stmnt = $this->database->query($qry);

        if($stmnt) {

            return true;
        }
        return false;
    }

    public function deleteAssignedService($serviceID)
    {
        $qry = "UPDATE `vehicle_service` 
              SET `service_active` = 0, `date_updated` = NOW() 
              WHERE `vehicle_service_id` = ".(int)$serviceID.";";

        $stmnt = $this->database->query($qry);

        if($stmnt) {

            return true;
        }
        return false;
    }

    public function getAllServices(){

        $stmt = $this->database->prepare("SELECT *, countNumberOfVehicles(`service_id`)  AS 'numberOfVehicles'                                       
                                          FROM `service` 
                                          WHERE `is_active` = 1;");

        $stmt->execute();

        if($stmt){
            $service = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $service;
        }
        return null;
    }

    public function getVehiclesService(){

        $stmt = $this->database->prepare("SELECT vs.`vehicle_service_id`,v.`vehicle_registration_number`, v.`vehicle_id`, v.`vehicle_name`, 
                                        v.`next_service_date`, s.`service_type`, vs.`price`, vs.`service_active`
                                        FROM `vehicle` v
                                        INNER JOIN `vehicle_service` vs ON v.`vehicle_id` = vs.vehicle_id
                                        INNER JOIN `service` s ON vs.`service_id` = s.`service_id`
                                        AND vs.`service_active` = 1;");

        $stmt->execute();

        if($stmt){
            $vehicleService = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $vehicleService;
        }
        return null;
    }
}