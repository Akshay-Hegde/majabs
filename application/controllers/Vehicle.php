<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 17:40
 */

class Vehicle extends My_Controller
{
    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
    {
        $data["vehicles"] = $this->VehicleModel->getAllVehicles();

        return $this->load->view('admin/vehicle/manage_vehicle',$data);
    }

    public function loadVehicleReport()
    {
        $data['notificationsStats'] = $this->notificationStats;
        return $this->load->view('manager/report/vehicle_report',$data);
    }

    public function retrieveManagerVehicleReport()
    {
        $searchKey = trim($this->input->post('searchKey'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = trim($this->input->post('date_to'));

        if(empty($searchKey))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Search by is not chosen"));
        }

        $params = array(
            "status" => $searchKey,
            "date_from" => $date_from,
            "date_to" => $date_to
        );

        $report = $this->VehicleModel->getManagerVehicleReport($params);
        //var_dump($report[0]->description); die();
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
                "message" => "Failed to retrieve vehicles."));
        }
    }

    public function retrieveManagerServiceVehicleReport()
    {
        $searchKey = trim($this->input->post('searchKey'));
        $date_from = trim($this->input->post('date_from'));
        $date_to = trim($this->input->post('date_to'));

        if(empty($searchKey))
        {
            $this->response->withJson(array("status"=>"fail",
                "message" => "Search by is not chosen"));
        }

        $params = array(
            "status" => $searchKey,
            "date_from" => $date_from,
            "date_to" => $date_to
        );

        $report = $this->VehicleModel->getManagerVehicleReport($params);
        //var_dump($report[0]->description); die();
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
                "message" => "Failed to retrieve vehicles."));
        }
    }

    public function addVehicle()
    {
        $vehicle_name = trim($this->input->post('vehicle_name'));
        $vehicle_reg_number = trim($this->input->post('vehicle_reg_number'));
        $service_date = trim($this->input->post("service_date"));
        $vehicle_disc_expiry = trim($this->input->post("vehicle_disc_expiry"));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $vehicle_name),
            array("name" => "max", "value" => 50, "field" => $vehicle_name)
        );

        $valid = $this->validator->validate($vehicle_name,$validationRules,"Vehicle");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle reg number
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $vehicle_reg_number),
            array("name" => "max", "value" => 50, "field" => $vehicle_reg_number)
        );

        $valid = $this->validator->validate($vehicle_reg_number,$validationRules,"Vehicle registration number");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle date
        $validationRules = array(
            "empty"
        );

        $valid = $this->validator->validate($service_date,$validationRules,"Vehicle service date");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle license
        $validationRules = array(
            "empty"
        );

        $valid = $this->validator->validate($vehicle_disc_expiry,$validationRules,"Vehicle disc date");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "vehicle_name" => $vehicle_name,
            "vehicle_reg_number" => $vehicle_reg_number,
            "disc_expiry" => $vehicle_disc_expiry,
            "service_date" => $service_date,
            "active" => 1
        );

        $vehicle = $this->VehicleModel->addVehicle($params);

        if($vehicle !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Vehicle Successfully registered",
                "vehicle" => $vehicle));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to register vehicle."));
    }

    public function editVehicle()
    {
        $vehicle_name = trim($this->input->post('vehicle_name'));
        $vehicle_reg_number = trim($this->input->post('vehicle_reg_number'));
        $service_date = trim($this->input->post("service_date"));
        $vehicle_disc_expiry = trim($this->input->post("vehicle_disc_expiry"));
        $vehicle_id = trim($this->input->post("vehicle_id"));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $vehicle_name),
            array("name" => "max", "value" => 50, "field" => $vehicle_name)
        );

        $valid = $this->validator->validate($vehicle_name,$validationRules,"Vehicle");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle reg number
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $vehicle_reg_number),
            array("name" => "max", "value" => 50, "field" => $vehicle_reg_number)
        );

        $valid = $this->validator->validate($vehicle_reg_number,$validationRules,"Vehicle registration number");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle date
        $validationRules = array(
            "empty"
        );

        $valid = $this->validator->validate($service_date,$validationRules,"Vehicle service date");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle license
        $validationRules = array(
            "empty"
        );

        $valid = $this->validator->validate($vehicle_disc_expiry,$validationRules,"Vehicle disc date");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "vehicle_name" => $vehicle_name,
            "vehicle_reg_number" => $vehicle_reg_number,
            "disc_expiry" => $vehicle_disc_expiry,
            "service_date" => $service_date,
            "vehicle_id" => $vehicle_id
        );

        $vehicle = $this->VehicleModel->updateVehicle($params);

        if($vehicle !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Vehicle Successfully updated",
                "vehicle" => $vehicle));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update vehicle."));
    }

    public function deleteVehicle()
    {
        $vehicle_id = $this->input->post('vehicle_id');

        $isVehicleDeleted = $this->VehicleModel->deleteVehicle($vehicle_id);

        if($isVehicleDeleted)
        {
            $this->response->withJson(array(
                "status" => "ok",
                "message" => "Vehicle successfully deleted"));
        }

        $this->response->withJson(array(
            "status" => "fail",
            "message" => "Opps something went wrong"));
    }
}