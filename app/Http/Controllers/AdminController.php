<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;
use App\Veiculo;
use App\Services\ValidationVehicle;
use App\Services\SendMailUser;
use Illuminate\Support\Facades\Cache;
use App\Mail\NotificaClienteMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendReminderEmail;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVehicles(){
        $vehicle = Veiculo::paginate(8);

        return $vehicle;
    }

    public function index()
    {
        return view('indexAdmin');
    }

    public function show_create(){
        return view('createVehicle');
    }

    public function create(Veiculo $vehicle ,Request $request){
        $inputs = $request->all(
            ['plate','model','brand','year','user_id']
        );
    
        $validator = ValidationVehicle::validate($inputs);

        if ($validator->fails()) {

            return redirect('/admin/home/veiculo/adicionar')
                        ->withErrors($validator)
                        ->withInput();
        }

        $vehicle->fill($inputs);
        $vehicle->save();
        //DEVE SER DESCOMENTADO EM PRODUÇAO
        Cache::put(
            'user'.$inputs['user_id'].'vehicle',
            [
                "$vehicle->id"=>User::find(
                    $inputs['user_id'])->veiculo
            ],
            60
        );

        SendMailUser::send(
            $request->get('user_id'),
            SendMailUser::MessageOption['create']
        );

        return \Redirect::route('admin.vehicle.show',$vehicle->id);
    }

    public function show_update($vehicle_id,Request $request)
    {
        $vehicle = Veiculo::find($vehicle_id);
        if(! $vehicle){
            return redirect()->route('admin.vehicle.index',['message'=>'O veiculo que deseja atualizar não existe']);
        }

        $v = Veiculo::where('id',$vehicle_id)->first();

        return view('update',["vehicle" => $v]);
    }

    public function update($vehicle_id,Request $request)
    {

        $vehicle = Veiculo::findOrFail($vehicle_id);

        $inputs = $request->all(
            ['plate','model','brand','year','user_id']
        );

        $validator = ValidationVehicle::validate($inputs,['plate'=>'']);

        if ($validator->fails()) {
            return redirect()
                        ->route('admin.vehicle.update',$vehicle_id)
                        ->withErrors($validator);
                        // ->withInput();
        }

        $vehicle->updateOrCreate($inputs);

        $user = User::find($inputs['user_id']);

        Cache::put(
            'user'.$inputs['user_id'].'vehicle',
            $user->veiculo,
            60
        );

        SendReminderEmail::dispatch($user)->delay(now()->addSeconds(15));

        // SendMailUser::send(
        //     $request->get('user_id'),
        //     SendMailUser::MessageOption['update']
        // );

        return redirect()->route('admin.vehicle.show',$vehicle_id);

    }

    public function show($vehicle_id,Request $request)
    {

        $vehicle = Veiculo::findOrFail($vehicle_id)->first();
        return view('showVehicle',['vehicle' => $vehicle]);
    }

    public function delete($vehicle_id, Request $request)
    {

        $vehicle = Veiculo::findOrFail($vehicle_id);

        // $vehicle->delete();

        // SendMailUser::send(
        //     $request->get('user_id'),
        //     SendMailUser::MessageOption['delete']
        // );

        return redirect()->route('admin.vehicle.index',['message'=>'O veiculo foi removido com sucesso']);;
    }
}
