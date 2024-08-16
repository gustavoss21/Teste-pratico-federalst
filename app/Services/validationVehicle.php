<?php

namespace App\Services;
use Validator;

class ValidationVehicle{
    private static $rules = [
        'plate' => ['required','unique:vehicle,size:7','regex:/\d{3}[a-z A-Z]{4}/'],
        'model' => 'required',
        'brand' => 'required',
        'year' => 'date_format:Y',
        'user_id' => 'exists:users,id',
    ];

    private const messages = [
        'model.required' => 'Informar um modelo.',
        'brand.required' => 'O .',
        'plate.unique' => 'A placa do veiculo já esta cadastrada.',
        'plate.size' => 'A placa do veiculo deve ter 7 caracteres.',
        'plate.regex' => 'A placa do veiculo deve ter 3 números seguidos de 4 letras, exe: 123abcd',
    ];
     
    static public function validate(array $inputs,$rules_remove=[]){

        $rules = self::rulesCustom($rules_remove);
        $validator = Validator::make(
            $inputs,
            $rules,
            self::messages
        );
        // dd([$validator->fails(),$validator->invalid(),$validator->failed(),$validator->errors()]);
        // dd(get_class_methods($validator));
        return $validator;
    }

    static function rulesCustom($update_rule){
        foreach($update_rule as $rule){
            $rule_key = key($update_rule);
            self::$rules[$rule_key] = $rule;
        };

        return self::$rules;

    }

}