<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/03/28
 * Time: 15:16
 */

class NotificationTransformer
{
    private static function transform($model){
        $transformed = array(
            "notification_id" => $model->notification_id,
            "type" => $model->type,
            "employee_id" => $model->lined_to_id,
            "directed_to_id" => $model->directed_to_id,
            "title" => $model->title,
            "message" => $model->message,
            "read" => $model->is_read,
            "active" => $model->is_active,
            "date" => $model->date_created,
            "name" => $model->name.' '.$model->surname,
            "email" => $model->email
        );

        return $transformed;
    }

    public static function toModel($model){
        $transformed = array();

        if(is_array($model)){
            foreach ($model as $message){
                $transformed[] = self::transform($message);
            }

            return $transformed;
        }
        return self::transform($model);
    }
}