<?php
namespace App\Services;

use App\User;
use App\Mail\NotificaClienteMail;
use Illuminate\Support\Facades\Mail;

class SendMailUser{
    const MessageOption = [
        'create'=>'Parabens, Agora você tem um veiculo cadastrado com nosco, faça bom proveito',
        'update'=>'você tem um veiculo que foi atualizando no sistema',
        'update'=>'você tem um veiculo que foi apagado'
    ];
    
    static public function send(int $user_id, $message){
        $user = User::find($user_id);
        $obj = ['name' => $user->name, 'message' => $message];

        Mail::to($user)->send(
            new NotificaClienteMail($obj)
        );

    }
}
