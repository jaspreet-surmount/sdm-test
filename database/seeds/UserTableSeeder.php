<?php
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'name'              => $faker->name,
            'email'             => $faker->email,
            'password'          => bcrypt('secret!@#'),
            'remember_token'    => str_random(10),
            'role_id'          => Role::where('name', '=', \Config::get('constants.DEFAULT_ROLES.level_one'))
                ->pluck('id')
        ]);

        $levelTwoRole = Role::where('name', '=', \Config::get('constants.DEFAULT_ROLES.level_two'))->pluck('id');

        for ($loop = 1; $loop < 5; $loop++) {
            User::create([
                'name'              => $faker->name,
                'email'             => $faker->email,
                'password'          => bcrypt('secret!@#'),
                'remember_token'    => str_random(10),
                'role_id'           => $levelTwoRole,
            ]);
        }
    }
}
