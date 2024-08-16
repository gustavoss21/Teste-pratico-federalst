<?php

namespace App\Services;
use Validator;

class ValidationVehicle{
    private const rules = [
        'plate' => 'required|unique:vehicle',
        'model' => 'required',
        'brand' => 'required',
        'year' => 'date_format:Y',
        'user_id' => 'exists:users,id',
    ];

    private const messages = [
        'model.required' => 'Informar um modelo.',
        'brand.required' => 'O .',
        'plate.unique' => 'A placa do veiculo já esta cadastrada.',
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

    static public function rulesCustom($rule_remove){
        // $rules_update = array_intersect_key(self::rules,$inputs);
        // $inputs_intercection = array_intersect_key($inputs,self::rules);
    
        return array_diff_key(self::rules,$rule_remove);;
    }

}