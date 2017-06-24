@extends('master_layout')
@section("main")
  <div class="col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-2 margintop20">
  <div class="jumbotron text-center">
    <p>{{ Lang::get('auth.401_error') }}</p>
  </div>
  </div>
@stop