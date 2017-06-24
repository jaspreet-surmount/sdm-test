@extends('master_layout')

@section('title')
	{{ $title }} :: @parent
@stop

@section('main')
    @inject('role', 'App\Role')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $title }}
        </div>
        <div class="panel-body">
            <table class="table hover table-bordered table-striped" id="roles">
                <thead>
                    <tr>
                        <th>{{ Lang::get("user.col_name") }}</th>
                        <th>{{ Lang::get("user.col_email") }}</th>
                        <th class="col-md-2">{{ Lang::get("user.col_role") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <?php
                        $allowedRoles = \Config::get('constants.DEFAULT_ROLES');
                        if ($allowedRoles['level_two'] == $user->role->name) {
                            $canChangeRoleTo = \Lang::get('user.downgrade_to_level_three');
                            $toggleClass = 'btn-warning';
                            $newRoleId = $role->where('name', '=', $allowedRoles['level_three'])->pluck('id');
                        } else {
                            $canChangeRoleTo = \Lang::get('user.upgrade_to_level_two');
                            $toggleClass = 'btn-success';
                            $newRoleId = $role->where('name', '=', $allowedRoles['level_two'])->pluck('id');
                        }
                        ?>
                        <tr class="change-role" title="{{ $user->role->name . ' : ' . $user->role->description }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="change-role-to" data-role="{{ $canChangeRoleTo }}"></span>
                                <span class="current-role" data-role="{{ $user->role->name }}"></span>
                                <span class="role-change-class" data-class="{{ $toggleClass }}"></span>
                                <span class="change-role-action">
                                    <a href="javascript:void(0)" onclick="confirmBox(this)"
                                     class="btn btn-xs btn-default"
                                     data-route="{{ URL::route('user.change-role', [
                                        'id' => $user->id,
                                        'newRoleId' => $newRoleId,
                                     ]) }}">
                                        {{ $user->role->name }}
                                    </a>
                                </span>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('scripts')
    @include('js-helper.user')
@stop
