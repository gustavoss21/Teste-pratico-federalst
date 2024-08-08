@extends('layouts.app')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')

@foreach ($vehicles as $vehicle)
    <p>This is user {{ $vehicle }}</p>
@endforeach
    <list-car-component></list-car-component'>
@stop