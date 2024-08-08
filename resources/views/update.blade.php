@extends('layouts.app')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')

<form action="{{Route('admin.veiculo.update')}}" method="POST">
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif

    @csrf

    @method('PUT')
    <div>id:<span>{{$vehicle->id}}</span></div>
        <div>
        <label for="plate">Plca:</label>
        <input value="{{$vehicle->plate}}" type="text" name="plate" id="plate">
    </div>
    <div>
        <label for="model">Modelo</label>
        <input value="{{$vehicle->model}}" type="text" name="model" id="model">
    </div>
    <div>
        <label for="brand">Marca:</label>
        <input value="{{$vehicle->brand}}" type="text" name="brand" id="brand">
    </div>
    <div>
        <label for="year">Ano</label>
        <input value="{{$vehicle->year}}" type="text" name="year" id="year">
    </div>
    <div>
        <label for="user_id">Proprietario</label>
        <input value="{{$vehicle->user_id}}" type="text" name="user_id" id="user_id">
    </div>
        
    <div>
        <button type="submit">Cadastrar</button>
    </div>
 </form>
@stop