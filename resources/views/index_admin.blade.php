@extends('layouts.admin')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')

@foreach ($vehicles as $vehicle)
    <div>
        <p>{{ $vehicle }}</p>

    </div>
@endforeach
    <list-car-component></list-car-component'>
@stop