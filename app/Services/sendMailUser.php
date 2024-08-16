<?php
namespace App\Services;

use App\User;
use App\Mail\NotificaClienteMail;
use Illuminate\Support\Facades\Mail;

class SendMailUser{
    const MessageOption = [
        'create'=>'Parabens, Agora você tem um veiculo cadastrado com nosco, faça bom proveito',
        'update'=>'você tem um veiculo que foi atualizando no sistema',
        'delete'=>'você tem um veiculo que foi apagado'
    ];
    
    static public function send(User $user, $message){
        $obj = ['name' => $user->name, 'message' => $message];

        Mail::to($user->email)->send(
            new NotificaClienteMail($obj)
        );
    }
}
