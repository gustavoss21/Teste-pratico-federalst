@extends('layouts.admin')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')
<div style="width: 80vw;margin: auto;">
    <div>
        <h1 style="text-align:center">adicionar um novo veiculo</h1>
    </div>
 <form action="{{Route('admin.vehicle.create')}}" method="post">
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
    @csrf
    <div>
        <label for="plate" class="form-label">Plca:</label>
        <input type="text" name="plate" id="plate" class="form-control">
    </div>
    <div>
        <label for="model" class="form-label">Modelo</label>
        <input type="text" name="model" id="model" class="form-control">
    </div>
    <div>
        <label for="brand" class="form-label">Marca:</label>
        <input type="text" name="brand" id="brand" class="form-control">
    </div>
    <div>
        <label for="year" class="form-label">Ano</label>
        <input type="text" name="year" id="year" class="form-control">
    </div>
    <div>
        <label for="user_id" class="form-label">Proprietario</label>
        <input type="text" name="user_id" id="user_id" class="form-control">
    </div>
    <div style="margin-top:40px">
        <button style="display: inline-block;width: 100%;" type="submit" class="btn btn-primary">Adicionar</button>
    </div>
 </form>
 <div>
@stop