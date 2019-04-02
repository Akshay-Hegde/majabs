<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/02/26
 * Time: 18:43
 */

class AttributeModel extends CI_Model
{
    private $database;

    /**
     * UserModel constructor.
     * @param $db
     */
    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    public function getAttributes()
    {
        $qry = "SELECT *, countEmpAttributes(`attribute_id`) AS 'numberOfEmployees',
                countTaskAttributes(`attribute_id`) AS 'numberOfTasks'  
                FROM `attribute` 
                WHERE `is_active` = 1;";

        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getEmployeeAttributes($params)
    {
        $qry = "SELECT * FROM `employee_attribute` 
                WHERE `employee_id` = :employee_id
                AND is_active = 1;";
        $smt = $this->database->prepare($qry);

        $smt->execute($params);

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function addAttribute($description){

        $stmt = $this->database->prepare("INSERT INTO `attribute`(`description`,`is_active`) 
                                          VALUES(:description,1 );");

        $stmt->execute(array("description" => $description));

        if($stmt->rowCount() > 0){

            $attributeID = $this->database->lastInsertId();

            $attribute = self::getAttributeByID($attributeID);

            if($attribute !== null) {
                return $attribute;
            }
            return null;
        }
        return null;
    }

    private function getAttributeByID($attributeID)
    {

        $stmt = $this->database->query("SELECT * , countEmpAttributes(`attribute_id`) AS 'numberOfEmployees',
                                        countTaskAttributes(`attribute_id`) AS 'numberOfTasks' 
                                        FROM `attribute` 
                                        WHERE `attribute_id` = ".(int)$attributeID." 
                                        AND `is_active` = 1");

        $attribute = $stmt->fetch(PDO::FETCH_OBJ);

        if($attribute !== false) {
            return $attribute;
        }
        return null;
    }

    public function editAttribute($params)
    {
        $qry = "UPDATE `attribute` SET `description` = :description, `date_created` = NOW()
                WHERE `attribute_id` = :attribute_id;";

        $stmnt = $this->database->prepare($qry);

        $stmnt->execute($params);

        if ($stmnt->rowCount() > 0) {

            $attribute = self::getAttributeByID($params['attribute_id']);

            if ($attribute !== false) {
                return $attribute;
            }
            return null;
        }
        return null;
    }

    public function deleteAttribute($attributeID)
    {
        $qry = "UPDATE `attribute` SET `is_active` = 0,`date_updated` = NOW() 
                WHERE `attribute_id` = ".(int)$attributeID.";";

        $stmnt = $this->database->query($qry);

        if($stmnt) {

            return true;
        }
        return false;
    }
}