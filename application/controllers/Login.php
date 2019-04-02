<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends My_Controller {


    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dashboard = "dashboard";

        $this->EmployeeModel->loggedin() == FALSE || redirect($dashboard);

        if(isset($_POST["btnLogin"])){

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $rememberMe = $this->input->post("chkRememberMe");


            $values = array("email" => $email, "password" => $password);

            $employee = $this->EmployeeModel->login($values);

            if(true) {
                if ($employee === null) {

                    $data["error"] = true;
                    $data["message"] = "Email and password do not match.";
                    $this->load->view('login_view', $data);
                    return;

                } else {

                    if( (int)$employee['is_active'] === 1 && (int)$employee['is_blocked'] === 0) {
                        $this->session->set_userdata(array(Utils::$USER_DATA => $employee));
                        if($employee !== 3) {
                            $this->EmployeeModel->createInitialLogOnLogin(array('emp_id' => $employee['employee_id']));
                        }
                        //die($logCreated);
                        redirect('dashboard');
                    }

                    $data["error"] = true;
                    $data["message"] = "Your account has been blocked, contact your administrator";
                    $this->load->view('login_view', $data);
                    return;
                }
            }else{
                $data["error"] = true;
                $data["message"] = "";
                $this->load->view('login_view', $data);
                return;
            }
        }

        $data["error"] = false;
        $this->load->view('login_view', $data);

    }
}