@extends('master_layout')

@section('title')
	{{ $activeDataTitle }} :: @parent
@stop

@section('main')

    @inject('user', 'App\User')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $activeDataTitle }}
            @if ($user->hasPermission('student.create'))
                <div class="pull-right">
                    <a href="javascript:void(0)" data-width="750px" data-route="{{ URL::route('student.create') }}"
                    class="btn btn-xs btn-primary formModal" data-name="{{ Lang::get("student.add_student") }}">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        {{ Lang::get("student.add_student") }}
                    </a>
                </div>
             @endif
        </div>

        <div class="panel-body">
            <table class="table hover table-bordered table-striped" id="students-active-data">
                <thead>
                    <tr>
                        <th class="col-md-2">{{ Lang::get("student.col_name") }}</th>
                        <th>{{ Lang::get("student.col_dob") }}</th>
                        <th>{{ Lang::get("student.col_contact_number") }}</th>
                        <th>{{ Lang::get("student.col_gender") }}</th>
                        <th>{{ Lang::get("student.col_favorite_subjects") }}</th>
                        <th>{{ Lang::get("student.col_other_activities") }}</th>
                        <th>{{ Lang::get("student.col_program") }}</th>
                        <th>{{ Lang::get("student.col_by") }}</th>
                        <th  class="col-md-2w">{{ Lang::get("student.col_at") }}</th>
                        <th class="col-md-1">{{ Lang::get("student.col_actions") }}</th>
                    </tr>
                </thead>
               <tbody></tbody>
            </table>
        </div>
    </div>

    @if ($user->hasPermission('student.approve-data'))
        <div class="panel panel-warning">
            <div class="panel-heading">
                {{ $inActiveDataTitle }}
            </div>

            <div class="panel-body">
                <table class="table hover table-bordered table-striped" id="students-inactive-data">
                    <thead>
                        <tr>
                            <th class="col-md-2">{{ Lang::get("student.col_name") }}</th>
                            <th>{{ Lang::get("student.col_dob") }}</th>
                            <th>{{ Lang::get("student.col_contact_number") }}</th>
                            <th>{{ Lang::get("student.col_gender") }}</th>
                            <th>{{ Lang::get("student.col_favorite_subjects") }}</th>
                            <th>{{ Lang::get("student.col_other_activities") }}</th>
                            <th>{{ Lang::get("student.col_program") }}</th>
                            <th>{{ Lang::get("student.col_by") }}</th>
                            <th  class="col-md-2w">{{ Lang::get("student.col_at") }}</th>
                            <th class="col-md-1">{{ Lang::get("student.col_actions") }}</th>
                        </tr>
                    </thead>
                   <tbody></tbody>
                </table>
            </div>
        </div>
    @endif
@stop

@section('scripts')
    @include('js-helper.student')
    @include('js-helper.student_datatable')
@stop
