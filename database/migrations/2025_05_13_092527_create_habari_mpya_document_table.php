<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('habari_mpya_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habari_id');
            $table->enum('document_type', ['image', 'video','document'])->default('image');
            $table->string('document_path');
            $table->timestamps();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->string('uuid');

            $table->foreign('habari_id')->references('id')->on('habari_mpya');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habari_mpya_document');
    }
};
