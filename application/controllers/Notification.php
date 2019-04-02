<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/27
 * Time: 11:53
 */

class Notification extends MY_Controller
{

    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
    {
        $senderDetails = array();
        $data["notifications"] = $this->NotificationModel->getEmployeeNotification($this->employee['employee_id']);

        if($data["notifications"] !== null) {
            foreach ($data["notifications"] as $key => $notification) {
                $senderDetails['sender_' . $key] = $this->NotificationModel->getSenderDetails($notification->sender_id);
            }
        }
        $data['notificationsStats'] = $this->notificationStats;
        $data["senderDetails"] = $senderDetails;
        //var_dump($data["senderDetails"]['sender_0'][0]->name); die();

        return $this->load->view('supervisor/notification/supervisor_notification',$data);
    }

    public function getMessage()
    {
        $notification_id = $this->input->get('id');

        $message = $this->NotificationModel->getMessage($notification_id);

        if($message !== null)
        {
            $this->NotificationModel->updateNotificationStatus($notification_id);

            $this->response->withJson(array("status"=>"success",
                "message" => "notification Successfully registered",
                "notification" => $message));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Error occured."));
    }

    public function loadEmpNotification()
    {
        $senderDetails = array();
        $data["notifications"] = $this->NotificationModel->getEmployeeNotification($this->employee['employee_id']);

        if($data["notifications"] !== null) {
            foreach ($data["notifications"] as $key => $notification) {
                $senderDetails['sender_' . $key] = $this->NotificationModel->getSenderDetails($notification->sender_id);
            }
        }
        $data['notificationsStats'] = $this->notificationStats;
        $data["senderDetails"] = $senderDetails;

        return $this->load->view('employee/notification/employee_notification',$data);
    }

    public function loadManagerNotification()
    {
        $senderDetails = array();
        $data["notifications"] = $this->NotificationModel->getEmployeeNotification($this->employee['employee_id']);

        if($data["notifications"] !== null) {
            foreach ($data["notifications"] as $key => $notification) {
                $senderDetails['sender_' . $key] = $this->NotificationModel->getSenderDetails($notification->sender_id);
            }
        }
        $data['notificationsStats'] = $this->notificationStats;
        $data["senderDetails"] = $senderDetails;

        return $this->load->view('manager/notification/manager_notification',$data);
    }

}