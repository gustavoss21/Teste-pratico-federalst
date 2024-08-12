@extends('layouts.admin')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')
 <form action="{{Route('admin.veiculo.create')}}" method="post">
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
    @csrf
    <div>
        <label for="plate">Plca:</label>
        <input type="text" name="plate" id="plate">
    </div>
    <div>
        <label for="model">Modelo</label>
        <input type="text" name="model" id="model">
    </div>
    <div>
        <label for="brand">Marca:</label>
        <input type="text" name="brand" id="brand">
    </div>
    <div>
        <label for="year">Ano</label>
        <input type="text" name="year" id="year">
    </div>
    <div>
        <label for="user_id">Proprietario</label>
        <input type="text" name="user_id" id="user_id">
    </div>
    <div>
        <button type="submit">Cadastrar</button>
    </div>
 </form>
@stop