<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('fresh_graduate')->default(false);
            $table->date('birthdate')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('background_picture')->nullable(); // Tambahkan kolom background_picture
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'adminppw@gmail.com',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
