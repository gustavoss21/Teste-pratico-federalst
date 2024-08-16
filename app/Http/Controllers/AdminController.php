<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Veiculo;
use App\Services\ValidationVehicle;
use Illuminate\Support\Facades\Cache;
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

        SendReminderEmail::dispatch($user)->delay(now()->addSeconds(15));


        return \Redirect::route('admin.vehicle.show',$vehicle->id);
    }

    public function show_update($vehicle_id,Request $request)
    {
        $vehicle = Veiculo::findOrFail($vehicle_id);
        return view('update',["vehicle" => $vehicle]);
    }

    public function update($vehicle_id,Request $request)
    {

        $vehicle = Veiculo::findOrFail($vehicle_id);
        $inputs = $request->all(
            ['plate','model','brand','year','user_id']
        );

        $validator = ValidationVehicle::validate($inputs,['plate'=>['required','regex:/\d{3}[a-z A-Z]{4}/']]);

        if ($validator->fails()) {
            return redirect()
                        ->route('admin.vehicle.update',$vehicle_id)
                        ->withErrors($validator);
        }

        $vehicle->update($inputs);

        $user = User::find($inputs['user_id']);

        $vehicle_cache = Cache::pull('user'.$inputs['user_id'].'vehicle') ?? [];
        Cache::put(
            'user'.$inputs['user_id'].'vehicle',
            $user->veiculo,
            60
        );

        SendReminderEmail::dispatch($user)->delay(now()->addSeconds(15));


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

        $vehicle->delete();

        SendReminderEmail::dispatch($user)->delay(now()->addSeconds(15));


        return redirect()->route('admin.vehicle.index',['message'=>'O veiculo foi removido com sucesso']);;
    }
}
