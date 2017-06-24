@extends('master_layout')

@section('title')
	{{ $title }} :: @parent
@stop

@section('main')
  <div class="jumbotron text-center">
    <h3> Welcome {{ Auth::user()->username }}</h3>
  </div>
@stop