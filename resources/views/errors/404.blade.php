@extends('master_layout')
@section("main")
  <div class="col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-2 margintop20">
  <div class="jumbotron text-center">
    <h1>404</h1>
    <p>{{ Lang::get('auth.404_error') }}</p>
  </div>
  </div>
@stop