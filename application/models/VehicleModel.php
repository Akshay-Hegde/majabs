<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 18:05
 */

class VehicleModel extends CI_Model
{
    private $database;

    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    public function getManagerVehicleReport($params){

        $stmt = $this->database->prepare("CALL managerVehicleReport(:status,:date_from,:date_to);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function addVehicle($params){

        $stmt = $this->database->prepare("INSERT INTO `vehicle`(`vehicle_name`,`vehicle_registration_number`,
                                          `disc_expiry_date`, `next_service_date`, `is_active`) 
                                          VALUES(:vehicle_name,:vehicle_reg_number,:disc_expiry,:service_date,:active )");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){

            $vehicleID = $this->database->lastInsertId();

            $stmt = $this->database->query("SELECT * FROM `vehicle` 
                                              WHERE `vehicle_id` = ".(int)$vehicleID." 
                                              AND `is_active` = 1");

            $vehicle = $stmt->fetch(PDO::FETCH_OBJ);

            if($vehicle !== false) {
                return VehicleTransformer::toModel($vehicle);
            }
            return null;
        }
        return null;
    }

    public function updateVehicle($params)
    {
        $qry = "UPDATE `vehicle` SET `vehicle_name` = :vehicle_name,`vehicle_registration_number` = :vehicle_reg_number,
                `disc_expiry_date` = :disc_expiry, `next_service_date` = :service_date,`date_created` = NOW()
                WHERE `vehicle_id` = :vehicle_id;";

        $stmnt = $this->database->prepare($qry);

        $stmnt->execute($params);

        if ($stmnt->rowCount() > 0) {

            $vehicleID = $params['vehicle_id'];

            $stmt = $this->database->query("SELECT * FROM `vehicle` 
                                              WHERE `vehicle_id` = " . (int)$vehicleID . " 
                                              AND `is_active` = 1");

            $vehicle = $stmt->fetch(PDO::FETCH_OBJ);

            if ($vehicle !== false) {
                return VehicleTransformer::toModel($vehicle);
            }
            return null;
        }
        return null;
    }

    public function deleteVehicle($vehicleID)
    {
        $qry = "UPDATE `vehicle` 
              SET `is_active` = 0 
              WHERE `vehicle_id` = ".(int)$vehicleID.";";

        $stmnt = $this->database->query($qry);

        if($stmnt) {

            return true;
        }
        return false;
    }

    public function getAllVehicles(){

        $stmt = $this->database->prepare("SELECT *                                        
                                          FROM `vehicle` 
                                          WHERE `is_active` = 1;");

        $stmt->execute();

        if($stmt){
            $vehicles = $stmt->fetchAll(PDO::FETCH_OBJ);
            return VehicleTransformer::toModel($vehicles);
        }
        return null;
    }

}