@extends ('layouts.master')

@section ('content')
    {{ Auth::user()->name }}
    {{ Auth::user()->name }}

@endsection