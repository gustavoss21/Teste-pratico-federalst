<?php

namespace App\Services;
use Validator;

class ValidationVehicle{
    const rules = [
        'plate' => 'required|unique:vehicle',
        'model' => 'required',
        'brand' => 'required',
        'year' => 'required|date_format:Y',
        'user_id' => 'exists:users,id',
    ];

    const messages = [
        'required' => 'The :attribute field is required.',
    ];
     
    static public function validate(array $inputs){
        $validator = Validator::make(
            $inputs,
            self::rules,
            self::messages
        );

        return $validator;
    }

}