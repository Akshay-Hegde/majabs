<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/01
 * Time: 17:24
 */

class Attribute extends My_Controller
{
    private $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
    }

    public function index()
    {
        $data['attributes'] = $this->AttributeModel->getAttributes();
        $data['notificationsStats'] = $this->notificationStats;
        //var_dump($data['employees']); die();
        return $this->load->view('admin/attribute/manage_attribute',$data);
    }

    public function addAttribute()
    {
        $attribute = trim($this->input->post('description'));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            array("name" => "min", "value" => 3, "field" => $attribute),
            array("name" => "max", "value" => 50, "field" => $attribute)
        );

        $valid = $this->validator->validate($attribute,$validationRules,"Attribute");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $attribute = $this->AttributeModel->addAttribute($attribute);

        if($attribute !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Attribute Successfully registered",
                "attribute" => $attribute));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to add attribute."));
    }

    public function editAttribute()
    {
        $description = trim($this->input->post('description'));
        $attribute_id = trim($this->input->post('attribute_id'));

        //Validating vehicle name
        $validationRules = array(
            "empty",
            "char",
            array("name" => "min", "value" => 3, "field" => $description),
            array("name" => "max", "value" => 50, "field" => $description)
        );

        $valid = $this->validator->validate($description,$validationRules,"Vehicle");

        if(!$valid){
            $this->response->withJson($this->validator->getResponse());
        }

        $params = array(
            "description" => $description,
            "attribute_id" => $attribute_id
        );

        $attribute = $this->AttributeModel->editAttribute($params);

        if($attribute !== null)
        {
            $this->response->withJson(array("status"=>"success",
                "message" => "Attribute Successfully updated",
                "attribute" => $attribute));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to update attribute."));
    }

    public function deleteAttribute()
    {
        $attributeID = trim($this->input->post("attribute_id"));

        $isAttributeDeleted = $this->AttributeModel->deleteAttribute($attributeID);

        if($isAttributeDeleted !== null)
        {
            $this->response->withJson(array("status"=>"ok",
                "message" => "Successfully deleted"));
        }

        $this->response->withJson(array("status"=>"fail",
            "message" => "Failed to delete attribute."));
    }
}