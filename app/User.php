<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    /**
     * @param string $route
     *
     * @return bool
     */
    public function hasPermission($route)
    {
        $userRole = $this->getUserRole();

        $roleBasedRestrictedRoutes = $this->roleBasedRestrictedRoutes();

        return (null != $roleBasedRestrictedRoutes[$userRole] && !empty($roleBasedRestrictedRoutes[$userRole])
            && in_array($route, $roleBasedRestrictedRoutes[$userRole])
        ) ? false : true;
    }

    /**
     * @return array
     */
    private function roleBasedRestrictedRoutes()
    {
        $roles = array_values(\Config::get('constants.DEFAULT_ROLES'));

        return array_combine($roles, [
            null,
            ['user.index', 'user.change-role', 'student.destroy', 'student.approve-data'],
            ['user.index', 'user.change-role', 'student.create', 'student.store',
                'student.edit', 'student.update', 'student.destroy', 'student.approve-data'
            ],
        ]);
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function scopeExcludeLevelOneUser($query)
    {
        $levelOneRole = Role::where('name', '=', \Config::get('constants.DEFAULT_ROLES.level_one'))->pluck('id');

        return $query->where('role_id', '!=', $levelOneRole);
    }

        /**
         * @return mixed
         */
        public function getUserRole()
        {
            return \Auth::user()->role->name;
        }
}
