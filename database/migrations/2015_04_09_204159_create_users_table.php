<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            // Voyager
            // $table->string('avatar')->default('users/default.png');
            // $table->bigInteger('role_id')->nullable();
           
            $table->string('username')->unique()->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('rut')->nullable();
            $table->string('celular')->unique();
            $table->string('direccion')->nullable();
            $table->string('notas')->nullable();
            $table->string('cargo')->nullable();
            $table->string('descuento')->nullable();
            $table->string('estado')->default('disponible');
            $table->longtext('api_token')->nullable();
            // FK
            $table->unsignedBigInteger('id_comuna')->nullable();
            $table->foreign('id_comuna')->references('id')->on('comunas');
            // $table->unsignedBigInteger('id_empresa')->nullable();
            // $table->foreign('id_empresa')->references('id')->on('empresas');
            // For drivers
            $table->string('zona')->nullable();
            //INDEXES
            $table->index(['id', 'celular']);
            
            $table->string('password')->default(bcrypt('RyR.CadaDiaMejorando'));
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
