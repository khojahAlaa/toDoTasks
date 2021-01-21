<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('api_token', 60 )->unique(); //generated by observer in the creating method 
            //and then regestred on the appserverProvider

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('photo')->nullable();
            // $table->string('photo')->default('man.png');

            $table->bigInteger('role_id')->unsigned()->default(1);
            $table->bigInteger('dep_id')->unsigned()->default(1);

            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // $table->foreign('dep_id')->references('id')->on('departments' )->onDelete('cascade');
           

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}