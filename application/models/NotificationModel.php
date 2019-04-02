<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/24
 * Time: 20:23
 */

class NotificationModel extends CI_Model
{
    private $database;

    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    public function createNotification($params){

        $stmt = $this->database->prepare("INSERT INTO `notification`(`sender_id`, `receiver_id`, 
                                          `type` ,`title`, `message`, `is_active`,`is_read`) 
                                          VALUES(:sender_id, :receiver_id, :type,:title,:message,1,0);");

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function getEmployeeNotification($employeeID){

        $stmt = $this->database->prepare("SELECT n.`notification_id`, n.`receiver_id`,n.`sender_id` , n.`receiver_id`,
                                          n.`type`,n.`title`,n.`message`, n.`is_read`,n.`is_active`,
                                          date_format(n.`date_created`,'%d %M %y') AS 'date_created'                                     
                                          FROM `notification` n 
                                          INNER JOIN `employee` e ON n.`receiver_id` = e.`employee_id`
                                          WHERE e.`is_active` = 1
                                          AND n.`receiver_id` = :employee_id;");

        $stmt->execute(array("employee_id" => (int)$employeeID));

        if($stmt->rowCount() > 0){
            $notifications = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $notifications;
        }
        return null;
    }

    public function getSenderDetails($employeeID){

        $stmt = $this->database->prepare("SELECT `name`, `surname`, `email`                                     
                                          FROM `employee` 
                                          WHERE `employee_id` = :employee_id;");

        $stmt->execute(array("employee_id" => (int)$employeeID));

        if($stmt->rowCount() > 0){
            $senderDetails = $stmt->fetch(PDO::FETCH_OBJ);
            return $senderDetails;
        }
        return null;
    }

    public function getMessage($notification_id){

        $stmt = $this->database->prepare("SELECT n.`title`,n.`message`, date_format(n.`date_created`,'%H:%i') AS 'time'                                     
                                          FROM `notification` n 
                                          INNER JOIN `employee` e ON n.`receiver_id` = e.`employee_id`
                                          WHERE e.`is_active` = 1
                                          AND n.`notification_id` = :notification_id;");

        $stmt->execute(array("notification_id" => $notification_id));

        if($stmt->rowCount() > 0){
            $notifications = $stmt->fetch(PDO::FETCH_OBJ);
            return $notifications;
        }
        return null;
    }

    public function updateNotificationStatus($notification_id){

        $stmt = $this->database->prepare("UPDATE `notification` 
                                          SET `is_read` = 1, `date_updated` = NOW() 
                                          WHERE `notification_id` = :notification_id;");

        $stmt->execute(array("notification_id" => $notification_id));

        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function countNotifications($employeeID){

        $qry = "SELECT IFNULL(COUNT(`notification_id`), 0) as 'totalNotifications'
				FROM `notification`
			    WHERE `is_read` = 0
			    AND `receiver_id` = ".(int)$employeeID.";";

        $stmnt = $this->database->query($qry);

        return $stmnt->fetchColumn(0);
    }


}