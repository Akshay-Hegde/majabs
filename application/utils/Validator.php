<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2018/12/10
 * Time: 09:20
 */

class Validator
{
    private $status;
    private $message = "";

    public function validate($value, $functions, $caption)
    {
        $methods = array("empty" => "isEmpty",
                        "number" => "isNumber",
                        "numbers" => "hasNumbers",
                        "char" => "isChar",
                        "letter" => "hasAlphabets",
                        "min" => "minLength",
                        "max" => "maxLength",
                        "space" => "hasSpace",
                        "email" => "isEmailValid",
                        "price" => "isPrice",
                        "time" => "isTime",
                        "date" => "isDate");

        $isValid = true;

        foreach($functions as $function)
        {
            if(is_array($function)) {
                $func = $methods[$function["name"]];
                $val = $function["value"];
                $field = $function["field"];

                if (method_exists($this, $func)) {
                    if(!($func = $this->$func($val,$field,$caption))) {
                        $isValid = false;
                    }
                }
            }else{
                $func = $methods[$function];
                if (method_exists($this, $func)) {
                    if(!$this->$func($value,$caption)){
                        $isValid = false;
                    }
                }
            }

        }
        return $isValid;
    }

    private function minLength($min,$field,$caption){

       if( (int)$min > strlen($field) ){
           $this->message .= $caption." cannot be less than $min characters.";
           return false;
       }
        return true;
    }

    private function maxLength($max,$field,$caption){

        if( (int)$max < strlen($field)){
            $this->message .= $caption." cannot be greater than $max characters long.";
            return false;
        }
        return true;
    }

    private function isEmpty($value, $name = "This value"){

        if(empty($value) || $value === null) {
            $this->message = $this->message . $name ." cannot be empty.";
            return false;
        }
        return true;
    }

    //Returns true if only numeric characters are found
    private function isNumber($value, $name = "This value")
    {
        if(!preg_match('/^[0-9]+$/', $value)) {
            $this->message .= $name ." ensure that only numerical digits are entered.";
            return false;
        }
        return true;
    }
    //Returns true if only alphabetic characters are found
    private function isChar($value, $name = "This value"){

        if(!preg_match('/^[A-Za-z0-9\s]+$/', $value)) {
            $this->message .= $name ." cannot contain special characters.";
            return false;
        }
        return true;
    }
    //Returns true if it finds letters on the string
    //It does not recognize a space a letter
    private function hasAlphabets($value, $name = "This value") {

        if(preg_match( '/[a-zA-Z]/', $value )) {
            $this->message .=  $name ." cannot contain alphabets.";
            return false;
        }
        return true;
    }
    //Retruns false if space are found on a string)
    private function hasSpace($value, $name = "This value") {

        if (preg_match('/\s/',$value))
        {
            $this->message .= $name ." cannot contain a space.";
            return false;
        }
        return true;
    }
    //Return false if numeric values are found on a value
    private function hasNumbers( $value,$name = "This value" ) {
        if(preg_match( '/\d/', $value ))
        {
            $this->message .= $name ." cannot contain numbers";
            return false;
        }
        return true;
    }
    //Return true if the provided email is valid
    private function isEmailValid($email,$name = "This value"){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->message .= $name ." entered is invalid";
            return false;
        }
        return true;
    }
    //Returns true if a price has the maximum of two digits after decimal
    private function isPrice($value,$name = "This value")
    {
        if(!preg_match( '/^[0-9]+(?:\.[0-9]{1,2})?$/', $value ))
        {
            $this->message .= $name ."entered is not valid";
            return false;
        }
        return true;
    }

    private function isTime($time,$name = "This value")
    {
        if(!preg_match( '/^([0-1][0-9]|2[0-3]):([0-5][0-9])$/', $time ))
        {
            $this->message .= $name." time entered is invalid";
            return false;
        }
        return true;
    }

    function isDate($date,$name = "This value")
    {
        if(empty($date))
        {
            $this->message .= $name." provided is not valid";
            return false;
        }

        $date = explode('-', $date);

        $day = (int)$date[2];
        $year = (int)$date[0];
        $month = (int)$date[1];

        if($month === 0 || $year  === 0 || $day  === 0)
        {
            $this->message .= $name." provided is not valid";
            return false;
        }

        if(is_int($day) && is_int($year) && is_int($year))
        {
           if (!checkdate($month, $day, $year))
           {
               $this->message .= $name." provided is not valid";
               return false;
           }
           return true;
        }
        $this->message .= $name." provided is not valid";
        return false;
    }

    private function isPassValid($password){
        //Should be changed to 6
        if(!(strlen($password) >= 0)) {
            $this->status = "fail";
            $this->message .= "Password must be greater than 6 character long.";
            return false;
        }
        //Oth
        //Lets work on this later, just showing how you must do it.
        return true;
    }

    public function getResponse(){
        return  array(
            "status"=>"fail",
            "message"=>$this->message
        );
    }
}