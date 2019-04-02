<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    protected $club;

    function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
        $data['notificationsStats'] = $this->notificationStats;

        if((int)$this->employee['role'] === 1) {
            $data['adminStats'] = $this->DashboardModel->adminStats();
            $this->dashboard = 'admin/admin_dashboard';
        }elseif ((int)$this->employee['role'] === 2){
            $data['supervisorStats'] = $this->DashboardModel->supervisorStats($this->employee['employee_id']);
            $this->dashboard = 'supervisor/supervisor_dashboard';
        }elseif ((int)$this->employee['role'] === 3){
            $data['managerStats'] = $this->DashboardModel->managerStats();
            $this->dashboard = 'manager/manager_dashboard';
        }elseif ((int)$this->employee['role'] === 4){
            $data['empStats'] = $this->DashboardModel->empStats($this->employee['employee_id']);
            //var_dump($data['empStats']); die();
            $this->dashboard = 'employee/employee_dashboard';
        }
        $data['role'] = (int)$this->employee['role'];
        //var_dump($data['adminStats']['total_vehicles']); die();
        $this->load->view($this->dashboard, $data);

	}
}