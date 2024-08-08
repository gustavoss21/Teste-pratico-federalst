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
        $rules = [
            'plate' => 'required|unique:vehicle',
            'model' => 'required',
            'brand' => 'required',
            'year' => 'required|date_format:Y',
            'user_id' => 'exists:users,id',
        ];
        $messages = [
            'required' => 'The :attribute field is required.',
        ];
         
        $validator = Validator::make(
            $inputs,
            $rules,
            $messages
        );

        
        if ($validator->fails()) {
            // dd($validator);
            return redirect('/admin/home/veiculo/adicionar')
                        ->withErrors($validator)
                        ->withInput();
        }
        // Veiculo::create($inputs);

        // return redirect('/admin/home/veiculo');
        return \Redirect::route('admin.veiculo.show', $inputs);
    }

    public function show_update($vehicle_id,Request $request)
    {
        $v = Veiculo::where('id',$vehicle_id)->first();

        return view('update',["vehicle" => $v]);
    }

    public function update(Veiculo $vehicle,Request $request)
    {
        $vehicle->first()->model = 'vallloror';
        $v = $vehicle::find(1);
        $v->update($request->all());
        dd($request->all());

        // $vehicle->update($request->all())->save();
        // Veiculo::whereId($id)->update($request->all());

    }

    public function show(Veiculo $vehicle,Request $request)
    {
        dd($vehicle);
    }

    public function delete(Request $request)
    {
        Veiculo::where('id',$request->id)-delete();

        return response('veiculo removido');
    }
}
