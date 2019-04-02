<?php


/**
 * Created by PhpStorm.
 * User: Calvin
 * Date: 10/22/2018
 * Time: 1:28 PM
 */

class Response
{
    protected static $data;

    public function withJson($data){
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

}