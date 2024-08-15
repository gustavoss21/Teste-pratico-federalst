@extends('layouts.admin')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')
<div>
    <car-component data="{{$vehicle}}"></car-component>

</div>
@stop