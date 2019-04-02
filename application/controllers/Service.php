<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 17:53
 */

class Service extends My_Controller
{
    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data['services'] = $this->ServiceModel->getAllServices();

        return $this->load->view('admin/service/manage_service',$data);
    }

    public function loadVehicleList()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data['services'] = $this->ServiceModel->getAllServices();
        return $this->load->view('manager/report/service_list',$data);
    }

    public function loadVehicleOnService($servceID)
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data['vehiclesOnServices'] = $this->ServiceModel->getServiceVehiclesByID(array("service_id" =>$servceID));
        if($data['vehiclesOnServices'] !== null) {
            $data['serviceType'] = $data['vehiclesOnServices'][0]->service_type;
        }

        return $this->load->view('manager/report/vehicle_service_report',$data);
    }


    public function addService()
    {
        $service_type = trim($this->input->post('service_type'));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $service_type),
            array("name" => "max", "value" => 50, "field" => $service_type)
        );

        $valid = $this->validator->validate($service_type,$validationRules,"Service");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $service = $this->ServiceModel->addService($service_type);

        if($service !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Service Successfully registered",
                "service" => $service));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to register service."));
    }
    public function assignService()
    {
        $price = trim($this->input->post('price'));
        $vehicle_id = trim($this->input->post('vehicle'));
        $service_type_id = trim($this->input->post('service_type'));
        $service_date = trim($this->input->post('service_date'));

        //Validating vehicle name
        $validationRules = array(
            "empty"
        );

        $valid = $this->validator->validate($service_type_id,$validationRules,"Service");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        //Validating vehicle name
        $validationRules = array(
            "empty",
        );

        $valid = $this->validator->validate($vehicle_id,$validationRules,"Service type");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        // Validate price
        $validationRules = array(
            "empty",
            "price",
            array("name" => "min", "value" => 1, "field" => $price),
            array("name" => "max", "value" => 7, "field" => $price)
        );

        $isValid = $this->validator->validate($price,$validationRules,"Service fee");

        if(!$isValid) {
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array("service_id" => $service_type_id,
                        "vehicle_id" => $vehicle_id,
                        "price" => $price);

        $serviceAssigned = $this->ServiceModel->assignService($params,$service_date);

        if($serviceAssigned !== null)
        {
            $this->response->withJson(array(
                "status"=>"success",
                "message" => "Service Successfully assigned",
                "service_assigned" => $serviceAssigned));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to assign service."));
    }

    public function serviceAssignment()
    {
        $data['notificationsStats'] = $this->notificationStats;
        $data['services'] = $this->ServiceModel->getAllServices();
        $data['vehicles'] = $this->VehicleModel->getAllVehicles();
        $data['vehiclesService'] = $this->ServiceModel->getVehiclesService();

        $this->load->view('admin/service/assign_service',$data);
    }

    public function editService()
    {
        $service_type = trim($this->input->post('service_type'));
        $service_id = trim($this->input->post("service_id"));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $service_type),
            array("name" => "max", "value" => 50, "field" => $service_type)
        );

        $valid = $this->validator->validate($service_type,$validationRules,"Service");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "service_type" => $service_type,
            "service_id" => $service_id
        );

        $service = $this->ServiceModel->updateService($params);

        if($service !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Service Successfully updated",
                "service" => $service));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update service."));
    }

    public function editServiceAssignment()
    {
        $service_date = trim($this->input->post('service_date'));
        $price = trim($this->input->post("price"));
        $vehicle_service_id = trim($this->input->post("vehicle_service_id"));


        //Validating vehicle name
        /*$validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $service_type),
            array("name" => "max", "value" => 50, "field" => $service_type)
        );

        $valid = $this->validator->validate($service_type,$validationRules,"Service");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }*/

        $params = array(
            "service_date" => $service_date,
            "price" => $price,
            "vehicle_service_id" => $vehicle_service_id
        );

        $newServiceAssignment = $this->ServiceModel->editServiceAssignment($params);
        //var_dump($newServiceAssignment); die();
        if($newServiceAssignment !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Service Assignment Successfully updated",
                "service_vehicle" => $newServiceAssignment));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update service assignment."));
    }

    public function deleteService()
    {
        $service_id = trim($this->input->post("service_id"));

        $isServiceDeleted = $this->ServiceModel->deleteService($service_id);

        if($isServiceDeleted)
        {
            $this->response->withJson(array(
                "status" => "ok",
                "message" => "Service successfully deleted"));
        }

        $this->response->withJson(array(
            "status" => "fail",
            "message" => "Opps something went wrong"));
    }

    public function deleteAssignedService()
    {
        $service_id = trim($this->input->post("service_id"));

        $isServiceDeleted = $this->ServiceModel->deleteAssignedService($service_id);

        if($isServiceDeleted)
        {
            $this->response->withJson(array(
                "status" => "ok",
                "message" => "Assigned Service successfully deleted"));
        }

        $this->response->withJson(array(
            "status" => "fail",
            "message" => "Opps something went wrong"));
    }
}