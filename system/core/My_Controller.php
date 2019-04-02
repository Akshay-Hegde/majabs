<?php
/**
 * Created by PhpStorm.
 * User: Calvin
 * Date: 1/2/2019
 * Time: 12:34 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $employee = null;
    protected $dashboard = null;
    protected $user_role = null;
    protected $contractType = null;
    protected $attributes = null;
    protected $notificationStats = null;

    function __construct()
    {
        parent::__construct();

        if( $this->EmployeeModel->loggedin() ) {
            $employee = $this->session->userdata(Utils::$USER_DATA);
            $this->employee = $employee;
            $this->user_roles = $this->EmployeeModel->getRole();
            $this->contractType = $this->ContractModel->getContractTypes();
            $this->attributes = $this->AttributeModel->getAttributes();
            $this->notificationStats = $this->NotificationModel->countNotifications($this->employee['employee_id']);
            /*$this->club_owner = $this->UserModel->getUser($userID);
            $this->clubId = $this->ClubModel->getClubId($userID);

            if($this->clubId !== null){
                $this->clubAdded = true;
            }

            if($this->clubId !== null){
                $this->clubStats = $this->DashboardModel->clubStats($this->clubId);
            }else{
                $this->clubStats = array("up_coming_events" => 0,
                    "following" => 0,
                    "reviews" => 0);
            }*/

        }
        else{
            //These are the page that do not need to be validated for session expiry
            $exception_pages = array("login", "logout", "forgot-password");

            if(in_array(uri_string(), $exception_pages) == FALSE){
                if($this->EmployeeModel->loggedin() == FALSE){
                    redirect("login");
                }
            }
        }

    }
}