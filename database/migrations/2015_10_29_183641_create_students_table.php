<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 80);
            $table->date('dob');
            $table->string('contact_number', 15);
            $table->enum('gender', \Config::get('constants.GENDER'));
            $table->string('favorite_subjects', 255);
            $table->text('other_activities');
            $table->integer('program_id')->unsigned();
            $table->boolean('is_active')->default(0)->comment('It will active on approved or created by level 1 users');
            $table->integer('created_by')->unsigned()->comment('This is user id');
            $table->integer('last_updated_by')->unsigned()->comment('This is user id');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
