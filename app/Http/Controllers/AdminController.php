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
use  App\Services\ValidationVehicle;

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

        return \Redirect::route('admin.veiculo.show', $inputs);
    }

    public function show_update($vehicle_id,Request $request)
    {
        $v = Veiculo::where('id',$vehicle_id)->first();

        return view('update',["vehicle" => $v]);
    }

    public function update($vehicle,Request $request)
    {
        // $v = $vehicle::find(1);
        // dd($vehicle);
        Veiculo::find($vehicle)->update($request->all());
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
        return response('veiculo removido');
    }
}
