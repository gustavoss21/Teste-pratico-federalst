<?php

namespace App\Services;
use Validator;

class ValidationVehicle{
    const rules = [
        'plate' => 'required|unique:vehicle',
        'model' => 'required',
        'brand' => 'required',
        'year' => 'date_format:Y',
        'user_id' => 'exists:users,id',
    ];

    const messages = [
        'model.required' => 'Informar um modelo.',
        'brand.required' => 'O .',
        'plate.unique' => 'A placa do veiculo já esta cadastrada.',
    ];
     
    static public function validate(array $inputs){
        $validator = Validator::make(
            $inputs,
            self::rules,
            self::messages
        );
        // dd([$validator->fails(),$validator->invalid(),$validator->failed(),$validator->errors()]);
        // dd(get_class_methods($validator));
        return $validator;
    }

}