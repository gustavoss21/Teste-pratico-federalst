@extends('layouts.admin')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')
<div style="width: 80vw;margin: auto;">
    <div>
        <h1 style="text-align:center">atualizar veiculo</h1>
    </div>
<form action="{{Route('admin.vehicle.update',$vehicle->id)}}" method="POST">
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif

    @csrf

    @method('PUT')
    <div>id:<span>{{$vehicle->id}}</span></div>
        <div>
        <label class="form-label" for="plate">Plca:</label class="form-label">
        <input class="form-control"value="{{$vehicle->plate}}" type="text" name="plate" id="plate">
    </div>
    <div>
        <label class="form-label" for="model">Modelo</label class="form-label">
        <input class="form-control"value="{{$vehicle->model}}" type="text" name="model" id="model">
    </div>
    <div>
        <label class="form-label" for="brand">Marca:</label class="form-label">
        <input class="form-control"value="{{$vehicle->brand}}" type="text" name="brand" id="brand">
    </div>
    <div>
        <label class="form-label" for="year">Ano</label class="form-label">
        <input class="form-control"value="{{$vehicle->year}}" type="text" name="year" id="year">
    </div>
    <div>
        <label class="form-label" for="user_id">Proprietario</label class="form-label">
        <input class="form-control"value="{{$vehicle->user_id}}" type="text" name="user_id" id="user_id">
    </div>
        
    <div style="margin-top:40px">
        <button style="display: inline-block;width: 100%;" type="submit" class="btn btn-primary">atualizar</button>
    </div>
 </form>
@stop