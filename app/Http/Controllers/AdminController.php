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
    public function index()
    {
        $vehicle = Veiculo::all();

        return view('index_admin',['vehicles'=>$vehicle]);
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

        SendMailUser::send(
            $request->get('user_id'),
            SendMailUser::MessageOption['create']
        );

        return \Redirect::route('admin.veiculo.show',$vehicle->id);
    }

    public function show_update($vehicle_id,Request $request)
    {
        $vehicle = Veiculo::find($vehicle_id);
        if(! $vehicle){
            return redirect()->route('admin.veiculo.index',['message'=>'O veiculo que deseja atualizar não existe']);
        }

        $v = Veiculo::where('id',$vehicle_id)->first();

        return view('update',["vehicle" => $v]);
    }

    public function update($vehicle_id,Request $request)
    {

        $vehicle = Veiculo::find($vehicle_id);
        $inputs = $request->all(
            ['plate','model','brand','year','user_id']
        );

        if(! $vehicle){
            return redirect()->route('admin.veiculo.index',['message'=>'O veiculo que deseja atualizar não existe']);
        }

        $validator = ValidationVehicle::validate($inputs,['plate'=>'']);

        if ($validator->fails()) {

            return redirect()
                        ->route('admin.veiculo.update',$vehicle_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $vehicle->update($inputs);

        SendMailUser::send(
            $request->get('user_id'),
            SendMailUser::MessageOption['update']
        );

        return redirect()->route('admin.veiculo.show',$vehicle_id);
        // $vehicle->update($request->all())->save();
        // Veiculo::whereId($id)->update($request->all());

    }

    public function show($vehicle,Request $request)
    {

        // dd(get_class_methods(Veiculo::find($vehicle)->first()));
        dd(Veiculo::find($vehicle)->first()->toArray());
    }

    public function delete($vehicle_id, Request $request)
    {
        $vehicle = Veiculo::find($vehicle_id);

        if(!$vehicle)return redirect()->route('veiculo.index',['message'=>'O veiculo não foi removido porque não existia']);

        $vehicle->delete();

        SendMailUser::send(
            $request->get('user_id'),
            SendMailUser::MessageOption['delete']
        );

        return redirect()->route('veiculo.index');;
    }
}
