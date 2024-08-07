<?php

use Illuminate\Database\Seeder;

class VeiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       factory(App\Veiculo::class, 20)->create();
        
    }
}


function gerar($num=true,$length=1){
    $characters = '';
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $len_letters = strlen($letters);
    $method_rendom = function($let,$n){
        // return rand(0, 9);
        return $n ?  rand(0, 9):  str_shuffle($let)[0];

    };

    for($i=0;$i<$length;$i++){
        $characters .= $method_rendom($letters,$num);
    }
    return $characters;
}; // gera letras ou numeros randomicos
