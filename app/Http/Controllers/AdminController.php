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

    public function update($vehicle,Request $request)
    {

        // Veiculo::find($vehicle)->update($request->all());
        $teste = Veiculo::find($vehicle);
        dd($teste);
        SendMailUser::send(
            $request->get('user_id'),
            SendMailUser::MessageOption['update']
        );

        return redirect()->route('admin.veiculo.show',$vehicle);
        // $vehicle->update($request->all())->save();
        // Veiculo::whereId($id)->update($request->all());

    }

    public function show($vehicle,Request $request)
    {

        // dd(get_class_methods(Veiculo::find($vehicle)->first()));
        dd(Veiculo::find($vehicle)->first()->toArray());
    }

    public function delete(Request $request)
    {
        Veiculo::where('id',$request->id)->delete();

        SendMailUser::send(
            $request->get('user_id'),
            SendMailUser::MessageOption['delete']
        );

        return response('veiculo removido');
    }
}
