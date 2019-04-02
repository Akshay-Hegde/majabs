<?php
/**
 * Created by PhpStorm.
 * UserModel: Calvin
 * Date: 10/11/2018
 * Time: 1:12 PM
 */
class EmployeeModel extends CI_Model
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

    public function loggedin(){
        return (bool)$this->session->has_userdata(Utils::$USER_DATA);
    }
    //Here we register a user as well as a business
    public function register($paramsEmp, $paramAttribute, $paramContract)
    {
        try{

            $this->db->trans_begin();

            //Get the maximum id
            $qryEmp = "INSERT INTO `employee`(`name`, `surname`, `gender`,`id_number`, `salary`, `password`,`email`,`phone`,`role`,`license_expiry_date`, `is_active`) 
                    VALUES(:name, :surname, :gender,:id_number,:salary,:password,:email,:phone,:role,:licenseExpiryDate,:is_active);";

            $stmt = $this->database->prepare($qryEmp);

            $stmt->execute($paramsEmp);

            if (!($stmt->rowCount() > 0))
            {
                return null;
            }

            $employeeID = $this->database->lastInsertId();

            foreach ($paramAttribute as $attribute) {

                $qryAttribute = "INSERT INTO `employee_attribute`(`attribute_id`,`employee_id`,`is_active`) 
                    VALUES(:attribute_id,:employee_id,:is_active);";

                $stmnt = $this->database->prepare($qryAttribute);

                $stmnt->execute(array(
                    "attribute_id" => $attribute,
                    "employee_id" => $employeeID,
                    "is_active" => 1
                ));
            }

            $qryContract = "INSERT INTO `employee_contract`(`contract_type_id`,`employee_id`,`contract_expiry_date`,`contract_document`,`is_active`) 
                            VALUES(:contract_type_id,:employee_id,:contract_expiry_date,:contract_document,:is_active);";

            $stmnt = $this->database->prepare($qryContract);

            $stmnt->execute(array(
                "contract_type_id" => $paramContract['contractType'],
                "employee_id" => $employeeID,
                "contract_expiry_date" => $paramContract['contractExpiryDate'],
                "contract_document" => $paramContract['contractDocument'],
                "is_active" => 1
            ));

            //Commit if both business and user is registered
            if($stmnt->rowCount() > 0)
            {
                $this->db->trans_commit();
                return true;
            }
            $this->db->trans_rollback();
            return null;

        }catch (Exception $e){
            $this->db->trans_rollback();
            return null;
        }

    }

    private function updateAttributes($employeeID,$attributesIDs)
    {
        $deactivateAttributes = "UPDATE `employee_attribute` SET `is_active` = 0 WHERE `employee_id` = ".(int)$employeeID.";";

        $stmnt = $this->database->query($deactivateAttributes);

        if($stmnt) {
            foreach ($attributesIDs as $id) {

                $existingID = $this->database->prepare("SELECT * FROM `employee_attribute` WHERE `employee_id` = :employee_id
                                                      AND `attribute_id` = :attribute_id;");
                $existingID->execute(array("attribute_id"=>$id,"employee_id"=>$employeeID));
                if ($existingID->rowCount() > 0) {
                    $this->database->query("UPDATE `employee_attribute` SET `is_active` = 1 WHERE `employee_id` = " . (int)$employeeID . " 
                                            AND `attribute_id` = " . (int)$id . ";");
                }
                else
                {
                    $this->database->query("INSERT INTO employee_attribute (`employee_id`,`attribute_id`) 
                                            VALUES(" . (int)$employeeID . "," . (int)$id . ");");
                }
            }
            return true;
        }
        return false;
    }

    public function updateEmployee($paramsEmp, $paramAttributeIDs, $paramContract)
    {
        try{

            $this->db->trans_begin();

            //Get the maximum id
            $qryEmp = "UPDATE `employee` SET `name` = :name, `surname` = :surname, `gender` = :gender,`id_number` = :id_number,
                      `salary` = :salary,`email` = :email,`phone` = :phone,`role` = :role,`license_expiry_date` = :licenseExpiryDate,
                      `date_updated` = NOW()
                      WHERE `employee_id` = :employee_id;";

            $stmt = $this->database->prepare($qryEmp);

            $stmt->execute($paramsEmp);

            if (!($stmt->rowCount() > 0))
            {
                $this->db->trans_rollback();
                return null;
            }

            //Update the attributes
            $isAttributesUpdated = self::updateAttributes($paramsEmp['employee_id'],$paramAttributeIDs);

            if(!$isAttributesUpdated)
            {
                $this->db->trans_rollback();
                return null;
            }

            //Update contract
            //self::updateContract($paramsEmp['employee_id']);

            $qryContract = "UPDATE `employee_contract` SET `contract_type_id` = :contract_type_id,`contract_expiry_date` = :contract_expiry_date,
                            `contract_document` = :contract_document,`is_active` = :is_active, `date_updated` = NOW() 
                            WHERE `employee_id` = :employee_id;";

            $stmnt = $this->database->prepare($qryContract);

            $stmnt->execute(array(
                "contract_type_id" => $paramContract['contractType'],
                "employee_id" => $paramsEmp['employee_id'],
                "contract_expiry_date" => $paramContract['contractExpiryDate'],
                "contract_document" => $paramContract['contractDocument'],
                "is_active" => 1
            ));

            //Commit if both business and user is registered
            if($stmnt->rowCount() > 0)
            {
                $this->db->trans_commit();
                return true;
            }
            $this->db->trans_rollback();
            return null;

        }catch (Exception $e){
            $this->db->trans_rollback();
            return null;
        }

    }

    public function updateAdminProfile($paramsEmp)
    {
            //Get the maximum id
            $qryEmp = "UPDATE `employee` SET `name` = :name, `surname` = :surname, `gender` = :gender,`phone` = :phone,
                      `date_updated` = NOW()
                      WHERE `employee_id` = :employee_id;";

            $stmt = $this->database->prepare($qryEmp);

            $stmt->execute($paramsEmp);

            if ($stmt->rowCount() > 0) {

                return self::getEmployee($paramsEmp['employee_id']);
            }
            return false;
    }

    public function changePassword($params)
    {
            //Get the maximum id
            $qryEmp = "UPDATE `employee` SET `password` = :password , `date_updated` = NOW()
                      WHERE `employee_id` = :employee_id;";

            $stmt = $this->database->prepare($qryEmp);

            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {

                return self::getEmployee($params['employee_id']);
            }
            return false;
    }

    public function knockOff($params)
    {
        //Get the maximum id
        $qryEmp = "CALL `knockOff`(:emp_id);";

        $stmt = $this->database->prepare($qryEmp);

        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {

            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function login($params){
        $stmt = $this->database->prepare("SELECT * FROM employee WHERE `email` = :email;");
        $stmt->execute(array("email" => $params['email']));

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if($user->password === md5($params["password"])){
                return self::getEmployee($user->employee_id);
            }
        }
        return null;
    }

    public function userExist($email){
        $qry = "SELECT * FROM `employee` WHERE `email` = :email ;";
        $smt = $this->database->prepare($qry);
        $param = array(
            "email" => $email
        );

        $smt->execute($param);

        if($smt->rowCount() > 0)
        {
            return $smt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getRole()
    {
        $qry = "SELECT * FROM `role`
                WHERE role_id != 1;";
        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getEmployee($employeeID){
        $stmt = $this->database->prepare("SELECT e.`employee_id`, e.`is_blocked`,e.`password`,e.`is_active`,e.`is_on_leave`,e.`license_expiry_date`, e.`name`, e.`surname`, e.`email`, e.`gender`, e.`salary`, 
                                        e.`id_number`,e.`phone`,e.`role`,IFNULL(ec.`contract_expiry_date`,'Permenant') as 'contract_expiry_date', 
                                        c.`contract_type`, c.`contract_id`
                                        FROM `employee` e
                                        INNER JOIN `employee_contract` ec ON e.`employee_id` = ec.`employee_id`
                                        INNER JOIN `contract` c ON ec.`contract_type_id` = c.`contract_id`
                                        WHERE e.`employee_id` = :employee_id;");

        $stmt->execute(array("employee_id" => $employeeID));

        if($stmt){
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return EmployeeTransformer::toModelDetailedEmployee($user);
        }
        return null;
    }

    public function getEmpContract($employeeID)
    {
        $stmt = $this->database->prepare("SELECT `contract_document` 
                                          FROM `employee_contract` 
                                          WHERE `employee_id` = :employee_id;");

        $stmt->execute(array("employee_id" => $employeeID));

        if($stmt){
            $employeeContract = $stmt->fetchColumn(0);
            return $employeeContract;
        }
        return null;
    }

    public function getAllEmployees(){

        $stmt = $this->database->prepare("SELECT e.`employee_id`,e.`is_blocked`,e.`password`,e.`is_active`,e.`is_on_leave`, e.`license_expiry_date`, e.`name`, e.`surname`, e.`email`, e.`gender`, e.`salary`, 
                                        e.`id_number`,e.`phone`,e.`role`,IFNULL(ec.`contract_expiry_date`,'Permenant') as 'contract_expiry_date', 
                                        c.`contract_type`, c.`contract_id`
                                        FROM `employee` e
                                        INNER JOIN `employee_contract` ec ON e.`employee_id` = ec.`employee_id`
                                        INNER JOIN `contract` c ON ec.`contract_type_id` = c.`contract_id`
                                        WHERE e.`role` != 1
                                        AND e.`is_active` = 1;");

        $stmt->execute();

        if($stmt){
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            return EmployeeTransformer::toModelDetailedEmployee($user);
        }
        return null;
    }

    public function getManagerIDs(){

        $stmt = $this->database->prepare("SELECT `employee_id`
                                          FROM `employee` 
                                          WHERE `is_active` = 1
                                          AND `role` = 3;");

        $stmt->execute();

        if($stmt){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function deleteEmployee($employeeID)
    {
        $deactivateEmployee = "UPDATE `employee` SET `is_active` = 0, `date_updated` = NOW() WHERE `employee_id` = ".(int)$employeeID.";";

        $stmnt = $this->database->query($deactivateEmployee);

        if($stmnt) {

            return true;
        }
        return false;
    }

    public function isExisting($values)
    {
        $qry = "SELECT * FROM ".$values['table']." WHERE ".$values['field']." = ".$values['value'].";";

        $smt = $this->database->prepare($qry);
        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return array(
                "status" => "fail",
                "message" => $values["caption"]." already exist, please enter a different one."
            );
        }
        return null;
    }
    //SUPERVISOR QUERIES
    public function getAllEmployeesToAssign(){

        $stmt = $this->database->prepare("SELECT e.`employee_id`,e.`is_blocked`,e.`password`,e.`is_active`,e.`is_on_leave`, e.`license_expiry_date`, e.`name`, e.`surname`, e.`email`, e.`gender`, e.`salary`, 
                                        e.`id_number`,e.`phone`,e.`role`,IFNULL(ec.`contract_expiry_date`,'Permenant') as 'contract_expiry_date', 
                                        c.`contract_type`, c.`contract_id`
                                        FROM `employee` e
                                        INNER JOIN `employee_contract` ec ON e.`employee_id` = ec.`employee_id`
                                        INNER JOIN `contract` c ON ec.`contract_type_id` = c.`contract_id`
                                        WHERE e.`role` = 4
                                        AND e.`is_assigned_task` = 0
                                        AND e.`is_on_leave` = 0
                                        AND e.`is_active` = 1;");

        $stmt->execute();

        if($stmt){
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            return EmployeeTransformer::toModelDetailedEmployee($user);
        }
        return null;
    }

    //Employees

    public function getEmployeeLogs($params){

        $stmt = $this->database->prepare("call empLogs(:emp_id);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function createInitialLogOnLogin($params){

        $stmt = $this->database->prepare("call createInitialLogOnLogin(:emp_id);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    //Manager
    public function getAllEmployeesByLeaveID($params){

        $stmt = $this->database->prepare("SELECT e.`name`, e.`surname`, e.`gender`, e.`email`,
                                        e.`id_number`,e.`phone`,r.`type`, r.`role_id`, l.`type` AS 'leaveType'
                                        FROM `employee` e
                                        INNER JOIN `role` r ON e.`role` = r.`role_id`
                                        INNER JOIN `employee_leave` el ON e.`employee_id` = el.`employee_id`
                                        INNER JOIN `leave` l ON el.`leave_id` = l.`leave_id`
                                        WHERE el.`is_active` = 1
                                        AND el.`is_approved` = 1
                                        AND el.`leave_id` = :leave_id
                                        AND e.`is_on_leave` = 1;");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            $emp = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $emp;
        }
        return null;
    }

    public function getManagerEmpReport($params){

        $stmt = $this->database->prepare("call managerEmpReport(:role,:leave_type);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            return EmployeeTransformer::toModelDetailedEmployee($user);
        }
        return null;
    }

}