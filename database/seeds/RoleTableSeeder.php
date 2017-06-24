<?php
use Illuminate\Database\Seeder;
use App\Role;

/**
 * Class RoleTableSeeder
 */
class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $defaultRoles = \Config::get('constants.DEFAULT_ROLES');
        Role::create([
            'name'          => $defaultRoles['level_one'],
            'description'   => 'Full access to add, edit, and delete student data entries.'
        ]);

        Role::create([
            'name'          => $defaultRoles['level_two'],
            'description'   => 'Ability to add, edit student data entries added by himself and can view all entries.'
        ]);

        Role::create([
            'name'          => $defaultRoles['level_three'],
            'description'   => 'Can only view student data entries.'
        ]);
    }
}
