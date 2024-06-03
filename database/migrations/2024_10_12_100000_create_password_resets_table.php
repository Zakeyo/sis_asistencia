<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clave foránea
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
