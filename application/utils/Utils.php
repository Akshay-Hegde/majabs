<?php
/**
 * Created by PhpStorm.
 * User: Calvin
 * Date: 10/22/2018
 * Time: 11:26 AM
 */

class Utils
{
    private static $SMS_URL = "http://service.creason.co.za/sms/public/sms";

    public static $NO_REVIEWS = "NO_REVIEWS";
    public static $USER_DATA = "USER_DATA";
    public static $CLUB_DATA = "CLUB_DATA ";
    public static $STATISTICS = "STATISTICS";
    public static $NO_USER_IMAGE = "assets/klubbars/no_user_img.png";
    public static $NO_PHOTOS = "assets/klubbars/no_photo.png";
    public static $NO_SPECIAL_BANNER = "assets/klubbars/no_special_banner.png";
    public static $INSERT_LOGO = "assets/klubbars/no_logo.png";
    public static $NO_CLUB_LOGO = "assets/klubbars/logo.png";
    public static $KLUBBARS_ICON = "assets/klubbars/klub_icon.png";
    public static $KLUBBARS_LOGO = "assets/klubbars/klubbars_sm8.png";
    public static $REGISTRATION_DATA = array();

    public static function getGUID($values = null){

        $token = md5(time());

        if( is_array( $values )){
            if( isset( $values["user_name"]) ){

                $username = $values["user_name"];


                if( empty( $username ))
                    $username = md5(time());

                try {
                    $token = mt_srand(((double)microtime() * 10000)) .
                        bin2hex(random_bytes(16)) .
                        hash("sha256", $username).md5(time());
                }catch (Exception $e){
                    $token = mt_srand(((double)microtime() * 10000)) .
                        bin2hex(time()) . hash("sha256", $username);
                }
            }
        }else{
            try {
                $token = mt_srand(((double)microtime() * 10000)) .
                    bin2hex(random_bytes(16)) . hash("sha256", time());
            }catch (Exception $e){
                $token = mt_srand(((double)microtime() * 10000)) . bin2hex(time()) . hash("sha256", time());
            }
        }

        return $token;
    }

    private static function fileName($ext)
    {
        $basename = null;

        try{

            $basename = bin2hex(random_bytes(32)).hash("sha256",time());
        }catch (Exception $ex){
            $basename = bin2hex(rand(1 , 100000)).hash("sha256",time());
        }

        return $basename . $ext;
    }

    public static function moveFileToCompress($directory, $uploadedFile)
    {
        $extension = pathinfo($uploadedFile["file_name"], PATHINFO_EXTENSION);
        $filename = self::fileName('.'.$extension);
        $fileDirectory = $directory.$filename;

        if(move_uploaded_file($uploadedFile["temp_name"],$fileDirectory)){

                $newFileName = self::compressImage($fileDirectory);

                if($newFileName !== null)
                {
                    return $newFileName;
                }
                return null;
        }
        return null;
    }

    private static function resizeImage($resourceType,$image_width,$image_height) {
        $resizeWidth = 256;
        $resizeHeight = 312;
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }

    private static function compressImage($tempFile)
    {
        $sourceProperties = getimagesize($tempFile);
        $ext = '.' . pathinfo($tempFile, PATHINFO_EXTENSION);
        $fileName = self::fileName($ext);
        $newFileName = FileDirectory::$LOCAL_FILE_SERVER . FileDirectory::$CLUB_GALLERY . $fileName;

        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        switch ($uploadImageType) {

            case IMAGETYPE_JPEG:

                $resourceType = imagecreatefromjpeg($tempFile);
                $imageLayer = self::resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                $uploaded = imagejpeg($imageLayer,$newFileName);


                if($uploaded)
                {
                    unlink($tempFile);
                    return $fileName;
                }
                return null;

                break;
            case IMAGETYPE_GIF:

                $resourceType = imagecreatefromgif($tempFile);
                $imageLayer = self::resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                $uploaded = imagegif($imageLayer,$newFileName);

                if($uploaded)
                {
                    unlink($tempFile);
                    return $fileName;
                }
                return null;

                break;

            case IMAGETYPE_PNG:

                $resourceType = imagecreatefrompng($tempFile);
                $imageLayer = self::resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                $uploaded = imagepng($imageLayer,$newFileName);

                if($uploaded)
                {
                    unlink($tempFile);
                    return $fileName;
                }
                return null;

                break;

            default:
                return null;
                break;
        }
    }

    public static function moveUploadedFile($directory, $uploadedFile)
    {
        //$ext = substr($uploadedFile,strlen($uploadedFile)-4);
        $extension = pathinfo($uploadedFile["file_name"], PATHINFO_EXTENSION);
        //$basename = bin2hex(random_bytes(16)).hash("sha256",time());
        //$filename = sprintf('%s.%0.8s', $basename, $extension);
        $filename = self::fileName('.'.$extension);

        $fileDirectory = $directory.$filename;

        if(move_uploaded_file($uploadedFile["temp_name"],$fileDirectory)){

            return $filename;
        }
        return null;
    }

    public static function moveUploadedFileBase64($directory, $uploadedFile)
    {
        $commonExtentions = array("jpeg"=>".jpeg",
            "jpg"=>".jpg",
            "gif"=>".gif",
            "png"=>".png");

        //$basename = bin2hex(random_bytes(32)).hash("sha256",time());
        $data = explode( ',', $uploadedFile );

        $fileInformation = $data[0];
        $ext = '.png';
        foreach ($commonExtentions as $key=>$extention)
        {
            if(strpos($fileInformation,$key,0))
            {
                $ext = $extention;
                break;
            }
        }

        $data = base64_decode($data[1]);
        $filename = self::fileName($ext);
        $directory = $directory.$filename;

        if(file_put_contents($directory,$data) !== false)
        {
            return $filename;
        }
        return false;
    }

    public static function sendOTP($phone,$otp_code){

        $message = "Your otp code is ".$otp_code;
        $token = "47bd308b-b1b8-11e8-ba23-00155d0b4103";
        $post_body = array(
            "phone" => $phone,
            "message" => $message
        );

        $ch = curl_init( );
        curl_setopt ( $ch, CURLOPT_URL, "http://service.creason.co.za/sms/public/sms");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
        // Allowing cUrl funtions 20 second to execute
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
        // Waiting 20 seconds while trying to connect
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
        curl_exec( $ch );
        curl_close( $ch );
    }

    public static function getOtpCode()
    {
        return mt_rand(100000,999999);
    }

    public static function passwordMatches($first_password, $second_password)
    {
        return ($first_password === $second_password) ? true : false;
    }

    public static function explodeString($seperator , $toBeExploded)
    {
        $explodedString = explode($seperator , $toBeExploded);

        return $explodedString;
    }

    public static function getDomain() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        return $protocol . $domainName;
    }

    public static function emailRegisterBody($params){

        $email = $params['email'];
        $password = $params['password'];

        $body = <<<EOD
        <!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
        
        <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Majabulakuphakwa - Employee login credentials</title>
        </head>
        
        <body style="margin:0px; background: #f8f8f8; ">
        <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
          <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <div style="padding: 40px; background: #fff;">
              <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                  <tr>
                    <td style="border-bottom:1px solid #f6f6f6;"><h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear Employee,</h1>
                      <p style="margin-top:0px; color:#bbbbbb;"><b>Follow the instructions below to login to majabulakuphakwa system.</b></p></td>
                  </tr>
                  
                  <tr>
                    <td  style="border-top:1px solid #f6f6f6; padding-top:20px; color:#777">
                        <p style="margin-top:0px; color:#bbbbbb;"><b>enter</b> <a href="nnrrr.co.za">Click on the link to access the system </a></p>
                        <p style="margin-top:0px; color:#bbbbbb;"><b>your email is</b> $email</p>
                        <p style="margin-top:0px; color:#bbbbbb;"><b>your password is $password</b></p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
              <p> Powered by Majabulakuphakwa <br>
                
            </div>
          </div>
        </div>
        </body>
        
        </html>

EOD;

            return $body;
    }

    public static function emailBody($params){

        $link = base_url()."account/verify?accountVerify=".$params["token"];
        $body = <<<EOD
        <!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
        
        <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Klubbars - Reset Password</title>
        </head>
        
        <body style="margin:0px; background: #f8f8f8; ">
        <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
          <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">

            <div style="padding: 40px; background: #fff;">
              <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                  <tr>
                    <td style="border-bottom:1px solid #f6f6f6;"><h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear Employee,</h1>
                      <p style="margin-top:0px; color:#bbbbbb;">Please read the below instructions carefully.</p></td>
                  </tr>
                  <tr>
                    <td style="padding:10px 0 30px 0;"><p>A request to reset your Admin password has been made. If you did not make this request, simply ignore this email. If you did make this request, please reset your password:</p>

                      <b>- Thanks ( Majabs Admin team)</b> </td>
                    </tr>
                 
                </tbody>
              </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
              <p> Powered by Majabulakuphakwa <br>
                
            </div>
          </div>
        </div>
        </body>
        
        </html>

EOD;

        return $body;
    }

}