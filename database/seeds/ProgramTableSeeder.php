<?php

use App\Program;
use Illuminate\Database\Seeder;

/**
 * Class ProgramTableSeeder
 */
class ProgramTableSeeder extends Seeder
{
    public function run()
    {
        $programs = \Lang::get('common.programs');

        Program::create(['name' => $programs['BCA'],]);
        Program::create(['name' => $programs['MCA'],]);
        Program::create(['name' => $programs['BBA'],]);
        Program::create(['name' => $programs['BCOM'],]);
        Program::create(['name' => $programs['MCOM'],]);
    }
}
