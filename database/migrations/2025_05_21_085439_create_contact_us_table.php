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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('read', ['seen', 'unseen'])->default('unseen');
            $table->unsignedBigInteger('seen_by')->nullable();
            $table->date('seen_at')->nullable();
            $table->timestamps();
            $table->string('uuid');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('seen_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
