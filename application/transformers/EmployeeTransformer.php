<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2018/12/04
 * Time: 14:06
 */

class EmployeeTransformer
{
    private static function transform($model){
        $transformed = array(
            "employee_id" => $model->employee_id,
            "name" => $model->name,
            "surname" => $model->surname,
            "gender" => $model->gender,
            "id_number" => $model->id_number,
            "salary" => $model->salary,
            "email" => $model->email,
            "password" => $model->password,
            "role" => $model->role,
            "is_blocked" => $model->is_blocked,
            "is_active" => $model->is_active,
            "is_on_leave" => $model->is_on_leave
        );

        return $transformed;
    }

    public static function toModel($model){
        $transformed = array();

        if(is_array($model)){
            foreach ($model as $special){
                $transformed[] = self::transform($special);
            }

            return $transformed;
        }
        return self::transform($model);
    }

    private static function transformDetailedEmployee($model){
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

    public static function toModelDetailedEmployee($model){
        $transformed = array();

        if(is_array($model)){
            foreach ($model as $special){
                $transformed[] = self::transformDetailedEmployee($special);
            }

            return $transformed;
        }
        return self::transformDetailedEmployee($model);
    }
}