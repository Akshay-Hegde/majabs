<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/02
 * Time: 14:41
 */

class ServiceTransformer
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
}