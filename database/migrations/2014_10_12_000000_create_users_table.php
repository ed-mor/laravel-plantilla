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
            $table->id();
            #   clave foranea, relacionada con la tabla de cuentas
            $table-> foreignId('account_id')->references('id')->on('accounts');
            //  $table->foreign('account_id')->references('id')->on('accounts');
            #   -------------------------------------------------------------
            #   Status de Usuario para el ingreso al sistema
            //  $table->enum('status', [true, false])->default('');
            $table->boolean('status');
            #   -------------------------------------------------------------
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
            #   Permite el borrado suave
            $table->softDeletes();
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
