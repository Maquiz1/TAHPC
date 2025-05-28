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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->string('details',50);
            $table->string('user_platform',50);
            $table->string('user_browser',50);
            $table->string('user_ipaddress',50);
            $table->dateTime('issued_at');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
