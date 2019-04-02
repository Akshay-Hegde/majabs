<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {

    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["employees"] = $this->EmployeeModel->getAllEmployees();
        //var_dump($data['employees']); die();
	    return $this->load->view('admin/employee/manage_employee',$data);
	}

	public function loadEmpLogs()
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["empLogs"] = $this->EmployeeModel->getEmployeeLogs(array("emp_id" => $this->employee['employee_id']));
        //var_dump($data['empLogs']); die();
	    return $this->load->view('employee/logs/emp_log',$data);
	}

	public function loadManagerLogs()
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["empLogs"] = $this->EmployeeModel->getEmployeeLogs(array("emp_id" => $this->employee['employee_id']));
        //var_dump($data['empLogs']); die();
	    return $this->load->view('manager/logs/logs',$data);
	}

	public function loadAdminLogs()
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["empLogs"] = $this->EmployeeModel->getEmployeeLogs(array("emp_id" => $this->employee['employee_id']));
        //var_dump($data['empLogs']); die();
	    return $this->load->view('admin/logs/logs',$data);
	}

	public function loadSupervisorLogs()
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["empLogs"] = $this->EmployeeModel->getEmployeeLogs(array("emp_id" => $this->employee['employee_id']));
        //var_dump($data['empLogs']); die();
	    return $this->load->view('supervisor/logs/logs',$data);
	}

	public function manageEmpReport()
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["roles"] = $this->EmployeeModel->getRole();
        //var_dump($data['empLogs']); die();
	    return $this->load->view('manager/report/employee_report',$data);
	}

	public function loadEmpOnLeave($leaveID = null)
	{
        $data['notificationsStats'] = $this->notificationStats;
	    $data["empLists"] = $this->EmployeeModel->getAllEmployeesByLeaveID(array("leave_id" => $leaveID));
	    if($data["empLists"] !== null) {
            $data["leaveType"] = $data["empLists"][0]->leaveType;
        }

	    return $this->load->view('manager/leave/emp_on_leave',$data);
	}

	public function profile()
    {
        $profile = '';

        //$data['roles'] = $this->user_roles;
        //$data['attributes'] = $this->attributes;
        //$data['contractTypes'] = $this->contractType;
        $data['notificationsStats'] = $this->notificationStats;
        $data['employee'] = $this->employee;
        //var_dump($data['employee']); die();
        //$data['employeeAttributes'] = $this->AttributeModel->getEmployeeAttributes(array("employee_id" => $this->employee['employee_id']));

        //$data["employees"] = $this->EmployeeModel->getAllEmployees();
        return $this->load->view('admin/employee/profile',$data);
    }

    public function password()
    {
        $data['notificationsStats'] = $this->notificationStats;
        return $this->load->view('change_password',$data);
    }


    public function updateAdmin($adminID = null)
    {
        $name = trim($this->input->post("name"));
        $surname = trim($this->input->post("surname"));
        $phone = trim($this->input->post("phone"));
        $gender = trim($this->input->post("gender"));

        //Validating first name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $name),
            array("name" => "max", "value" => 50, "field" => $name)
        );

        $valid = $this->validator->validate(trim($name),$validationRules,"Name");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating last name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $surname),
            array("name" => "max", "value" => 50, "field" => $surname)
        );

        $valid = $this->validator->validate(trim($surname),$validationRules,"Surname");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Phone
        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 10, "field" => $phone),
            array("name" => "max", "value" => 10, "field" => $phone)
        );

        $valid = $this->validator->validate(trim($phone),$validationRules,"Phone");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "name" =>  $name,
            "surname" => $surname,
            "phone" => $phone,
            "gender" => $gender,
            "employee_id" => $adminID
        );

        $admin = $this->EmployeeModel->updateAdminProfile($params);

        if($admin !== null)
        {
            $this->session->set_userdata(array(Utils::$USER_DATA => $admin));
            //Send an email to user
            $this->response->withJson(array("status"=>"success",
                "message" => "Successfully updated"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update profile."));
    }

    public function getManagerEmpReport()
    {
        $role = trim($this->input->post("searchKey"));
        $leave_type = trim($this->input->post("searchLeaveKey"));

        $params = array(
            "role" =>  (int)$role,
            "leave_type" => (int)$leave_type
        );

        $report = $this->EmployeeModel->getManagerEmpReport($params);

        if($report !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Report Successfully retrieved",
                "report" => $report));
        }elseif ($report === null){
            $this->response->withJson(array("status"=>"warning",
                "message" => "No results found."));
        }else {

            $this->response->withJson(array("status" => "fail",
                "message" => "Failed to retrieve employees."));
        }
    }

    public function changePassword()
    {
        $currentpassword = trim($this->input->post("current_password"));
        $confirmPassword = trim($this->input->post("confirm_password"));
        $password = trim($this->input->post("password"));

        //Validating first name
        $validationRules = array(
            "empty"
        );

        $valid = $this->validator->validate(trim($currentpassword),$validationRules,"Current password");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating last name
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $confirmPassword),
            array("name" => "max", "value" => 50, "field" => $confirmPassword)
        );

        $valid = $this->validator->validate(trim($confirmPassword),$validationRules,"Confirm password");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Phone
        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 3, "field" => $password),
            array("name" => "max", "value" => 50, "field" => $password)
        );

        $valid = $this->validator->validate(trim($password),$validationRules,"New password");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        if(!Utils::passwordMatches(md5($currentpassword),$this->employee['password']))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Wrong current password entered"));
        }

        if(!Utils::passwordMatches($confirmPassword,$password))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Password do not match"));
        }

        $params = array(
            "password" => md5($password),
            "employee_id" => $this->employee['employee_id']
        );

        $employee = $this->EmployeeModel->changePassword($params);

        if($employee !== null)
        {
            $this->session->set_userdata(array(Utils::$USER_DATA => $employee));
            $this->response->withJson(array("status"=>"success",
                "message" => "Successfully changed"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to change password."));
    }

	public function register()
	{
        $data['notificationsStats'] = $this->notificationStats;
        $data['roles'] = $this->user_roles;
        $data['attributes'] = $this->attributes;
        $data['contractTypes'] = $this->contractType;

        $this->load->view('admin/employee/register_employee',$data);
	}

	public function editEmployee($employeeID = null)
	{
        $data['notificationsStats'] = $this->notificationStats;
        $data['roles'] = $this->user_roles;
        $data['attributes'] = $this->attributes;
        $data['contractTypes'] = $this->contractType;
        $data['emp'] = $this->EmployeeModel->getEmployee($employeeID);
        $data['employeeAttributes'] = $this->AttributeModel->getEmployeeAttributes(array("employee_id" => $employeeID));
        //var_dump($data['employee']); die();

        $this->load->view('admin/employee/edit_employee',$data);
	}

	public function registerEmployee()
	{
        $name = trim($this->input->post("name"));
        $surname = trim($this->input->post("surname"));
        $email = trim($this->input->post("email"));
        $salary = trim($this->input->post("salary"));
        $id_number = trim($this->input->post("id_number"));
        $phone = trim($this->input->post("phone"));
        $gender = trim($this->input->post("gender"));
        $role = trim($this->input->post("role"));
        $contract_type = trim($this->input->post("contract_type"));
        $contractFile = $_FILES['contractFile']['name'];
        $license_expiry_date = trim($this->input->post("license_expiry_date"));
        $contract_expiry_date = trim($this->input->post("contract_expiry_date"));
        $attributes = $this->input->post("attributes");
        $attributes = array(1,2);

        //Validating first name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $name),
            array("name" => "max", "value" => 50, "field" => $name)
        );

        $valid = $this->validator->validate(trim($name),$validationRules,"Name");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating last name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $surname),
            array("name" => "max", "value" => 50, "field" => $surname)
        );

        $valid = $this->validator->validate(trim($surname),$validationRules,"Surname");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating email
        $maxUser = 64;
        $maxDomain = 255;
        $max = ($maxDomain + $maxUser);

        $validationRules = array(
            "empty",
            "email",
            array("name" => "min", "value" => 3, "field" => $email),
            array("name" => "max", "value" => $max, "field" => $email)
        );

        $valid = $this->validator->validate(trim($email),$validationRules,"Email");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Phone
        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 10, "field" => $phone),
            array("name" => "max", "value" => 10, "field" => $phone)
        );

        $valid = $this->validator->validate(trim($phone),$validationRules,"Phone");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //ID
        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 13, "field" => $id_number),
            array("name" => "max", "value" => 13, "field" => $id_number)
        );

        $valid = $this->validator->validate(trim($id_number),$validationRules,"ID number");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $tempFile = $_FILES['contractFile']['tmp_name'];
        $uploadedFile = array(
            "file_name" => $contractFile,
            "temp_name" => $tempFile
        );

        //Attributes
        if($attributes === null){
            $this->response->withJson(array("status"=>"fail",
                "message" => "Attributes cannot be empty."));
            return;
        }

        //Salary
        $validationRules = array(
            "empty",
            "price",
            array("name" => "min", "value" => 1, "field" => $salary),
            array("name" => "max", "value" => 7, "field" => $salary)
        );

        $valid = $this->validator->validate(trim($salary),$validationRules,"Salary");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //License expiry date
        $validationRules = array(
            "empty",
            "date");

        $valid = $this->validator->validate(trim($license_expiry_date),$validationRules,"license");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Check if email already exist
        $isUserExisting = $this->EmployeeModel->userExist($email);

        if($isUserExisting !== null)
        {
            $this->response->withJson(array(
                "status" => "warning",
                "message" => "User already exist"
            ));
        }

        $contractDocument = Utils::moveUploadedFile(FileDirectory::$LOCAL_FILE_SERVER, $uploadedFile);

        if($contractDocument === null){
            $this->response->withJson(array("status"=>"fail",
                "message" => "Failed to move image."));
            return;
        }

        $paramsEmp = array(
              "name" =>  $name,
              "surname" => $surname,
              "email" => $email,
              "phone" => $phone,
              "gender" => $gender,
              "salary" => $salary,
              "id_number" => $id_number,
              "role" => $role,
              "licenseExpiryDate" => $license_expiry_date,
              "password" => md5($phone),
              "is_active" => 1
        );

        $paramsContract = array(
            "contractExpiryDate" => $contract_expiry_date,
            "contractDocument" => $contractDocument,
            "contractType" => (int)$contract_type,
            "is_active" => 1
            );


        if((int)$contract_type === 1)
        {
            $paramsContract['contractExpiryDate'] = null;
        }
        else{

            if(empty($contract_expiry_date)){
                $this->response->withJson(array("status"=>"fail",
                    "message" => "Contract expiry date is required for temporary employees."));
            }
        }

        $isEmpRegistered = $this->EmployeeModel->register($paramsEmp, $attributes, $paramsContract);

        if($isEmpRegistered !== null)
        {
                //Send an email to user
                self::sendRegistrationEmail(
                    array("email" => $email,
                        "password" => $phone
                ));

                $this->response->withJson(array("status"=>"success",
                    "message" => "Successfully registered"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to add employee."));
	}

	public function updateEmployee($employeeID = null)
    {
        $name = trim($this->input->post("name"));
        $surname = trim($this->input->post("surname"));
        $email = trim($this->input->post("email"));
        $salary = trim($this->input->post("salary"));
        $id_number = trim($this->input->post("id_number"));
        $phone = trim($this->input->post("phone"));
        $gender = trim($this->input->post("gender"));
        $role = trim($this->input->post("role"));
        $contract_type = trim($this->input->post("contract_type"));
        $contractFile = $_FILES['contractFile']['name'];
        $license_expiry_date = trim($this->input->post("license_expiry_date"));
        $contract_expiry_date = trim($this->input->post("contract_expiry_date"));
        $attributes = $this->input->post("attributes");

        //Validating first name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $name),
            array("name" => "max", "value" => 50, "field" => $name)
        );

        $valid = $this->validator->validate(trim($name),$validationRules,"Name");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating last name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $surname),
            array("name" => "max", "value" => 50, "field" => $surname)
        );

        $valid = $this->validator->validate(trim($surname),$validationRules,"Surname");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating email
        $maxUser = 64;
        $maxDomain = 255;
        $max = ($maxDomain + $maxUser);

        $validationRules = array(
            "empty",
            "email",
            array("name" => "min", "value" => 3, "field" => $email),
            array("name" => "max", "value" => $max, "field" => $email)
        );

        $valid = $this->validator->validate(trim($email),$validationRules,"Email");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Phone
        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 10, "field" => $phone),
            array("name" => "max", "value" => 10, "field" => $phone)
        );

        $valid = $this->validator->validate(trim($phone),$validationRules,"Phone");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //ID
        $validationRules = array(
            "empty",
            "number",
            array("name" => "min", "value" => 13, "field" => $id_number),
            array("name" => "max", "value" => 13, "field" => $id_number)
        );

        $valid = $this->validator->validate(trim($id_number),$validationRules,"ID number");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Attributes
        if($attributes === null){
            $this->response->withJson(array("status"=>"fail",
                "message" => "Attributes cannot be empty."));
            return;
        }

        //Salary
        $validationRules = array(
            "empty",
            "price",
            array("name" => "min", "value" => 1, "field" => $salary),
            array("name" => "max", "value" => 15, "field" => $salary)
        );

        $valid = $this->validator->validate(trim($salary),$validationRules,"Salary");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //License expiry date
        $validationRules = array(
            "empty",
            "date");

        $valid = $this->validator->validate(trim($license_expiry_date),$validationRules,"license");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        if(!empty($contractFile)) {

            $tempFile = $_FILES['contractFile']['tmp_name'];
            $uploadedFile = array(
                "file_name" => $contractFile,
                "temp_name" => $tempFile
            );

            $contractDocument = Utils::moveUploadedFile(FileDirectory::$LOCAL_FILE_SERVER, $uploadedFile);

            if ($contractDocument === null) {
                $this->response->withJson(array("status" => "fail",
                    "message" => "Failed to move image."));
                return;
            }
        }
        else
        {
            $contractDocument = $this->EmployeeModel->getEmpContract($employeeID);
        }

        if($contract_type == 2 && empty($contract_expiry_date))
        {
            $this->response->withJson(array("status" => "fail",
                "message" => "Contract expiry date cannot be null for temporary employee."));
        }

        $paramsEmp = array(
            "name" =>  $name,
            "surname" => $surname,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "salary" => $salary,
            "id_number" => $id_number,
            "role" => $role,
            "licenseExpiryDate" => $license_expiry_date,
            "employee_id" => $employeeID
        );

        $paramsContract = array(
            "contractExpiryDate" => $contract_expiry_date,
            "contractDocument" => $contractDocument,
            "contractType" => (int)$contract_type,
            "is_active" => 1
        );

        if((int)$contract_type === 1)
        {
            $paramsContract['contractExpiryDate'] = null;
        }
        else{
            if($contract_expiry_date === null){
                $this->response->withJson(array(
                    "status"=>"fail",
                    "message" => "Contract expiry date is required for temporary employees."));
                return;
            }
        }

        $isEmpUpdated = $this->EmployeeModel->updateEmployee($paramsEmp, $attributes, $paramsContract);

        if($isEmpUpdated !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Successfully updated"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update employee."));
    }

    private function sendRegistrationEmail($params){
        $config['protocol'] = 'mail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->load->library('email',$config);

        $to = array($params["email"]);

        $subject = "Majabulakuphakwa employee registration";

        $message_body = Utils::emailRegisterBody($params);
        $this->email->from("do-not-reply@mjabulakuphakwa.co.za", "Majabulakuphakwa");
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message_body);

        $this->email->send();

    }

    public function deleteEmployee()
    {
        $employee_id = trim($this->input->post("employee_id"));

        $isEmpDeleted = $this->EmployeeModel->deleteEmployee($employee_id);

        if($isEmpDeleted !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Successfully updated"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to delete employee."));
    }

    private function sendEmail($params){

        $config['protocol'] = 'mail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->load->library('email',$config);

        $to = array($params["email"]);

        $subject = "Majabulakuphakwa Password";

        $message_body = Utils::emailBody($params);
        $this->email->from("do-not-reply@majabs.co.za", "Majabs");
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message_body);

        $this->email->send();

    }

    public function knockOff()
    {
        $log = $this->EmployeeModel->knockOff(array("emp_id" => $this->employee['employee_id']));

        if($log !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Thank you for being with us today. 
                We looking forward to spending time with you tomorrow again."));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to Knock off, Maybe you should stay for sometime."));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        delete_cookie("u_token");
        redirect('/');
    }
}
