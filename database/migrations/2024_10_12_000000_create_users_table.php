<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fecha_ingreso');
            $table->string('estado');
            $table->boolean('active')->default(true);

            // Clave foránea para relacionar usuarios con miembros
            $table->bigInteger('miembro_id')->unsigned()->nullable();
            $table->foreign('miembro_id')->references('id')->on('miembros')->onDelete('cascade');
            
            // Clave foránea para relacionar usuarios con roles
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
