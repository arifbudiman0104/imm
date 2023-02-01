<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->boolean('hide_email')->default(true);
            $table->string('gender')->nullable();
            $table->string('pob')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('sid')->nullable();
            $table->string('university')->nullable();
            $table->string('faculty')->nullable();
            $table->string('program_study')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('bio')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_superadmin')->default(false);
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
};
