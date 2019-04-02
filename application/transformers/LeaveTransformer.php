<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/02
 * Time: 14:42
 */

class LeaveTransformer
{
    public static function transformLeaveStatus($model){

        $approved = $model->approved;

        if((int)$approved === 1){
            $status = "approved";
        }elseif((int)$approved === 0){
            $status = "pending";
        }else{
            $status = "rejected";
        }

        return $status;
    }


    private static function transformEmplLeaveReport($model){
        $transformed = array(
            "employee_id" => $model->employee_id,
            "name" => $model->name,
            "surname" => $model->surname,
            "gender" => $model->gender,
            "id_number" => $model->id_number,
            "salary" => $model->salary,
            "email" => $model->email,
            "phone" => $model->phone,
            "role" => $model->role,
            "contract_expiry_date" => $model->contract_expiry_date,
            "license_expiry_date" => $model->license_expiry_date,
            "contract_type" => $model->contract_type,
            "contract_id" => $model->contract_id,
            "is_blocked" => $model->is_blocked,
            "is_active" => $model->is_active,
            "is_on_leave" => $model->is_on_leave,
            "password" => $model->password
        );

        return $transformed;
    }

    public static function toModelEmplLeaveReport($model){
        $transformed = array();

        if(is_array($model)){
            foreach ($model as $report){
                $transformed[] = self::transformEmplLeaveReport($report);
            }

            return $transformed;
        }
        return self::transformEmplLeaveReport($model);
    }
}