@extends('layouts.app')
 
@section('title', 'Home')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@stop
 
@section('content')
{{$message ?? ''}}
<div>
    {{$_REQUEST['message']}}
</div>
@foreach ($vehicles as $vehicle)
    <div>
        <p>{{ $vehicle }}</p>

    </div>
@endforeach
    
@stop