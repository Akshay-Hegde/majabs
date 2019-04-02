<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/02
 * Time: 14:42
 */

class VehicleTransformer
{
    private static function transform($model){
        $transformed = array(
            "vehicle_id" => $model->vehicle_id,
            "vehicle_name" => $model->vehicle_name,
            "reg_number" => $model->vehicle_registration_number,
            "disc_expiry_date" => $model->disc_expiry_date,
            "service_date" => $model->next_service_date,
            "active" => $model->is_active
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