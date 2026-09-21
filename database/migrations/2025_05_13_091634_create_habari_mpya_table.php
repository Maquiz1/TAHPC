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
        Schema::create('habari_mpya', function (Blueprint $table) {
            $table->id();
            $table->enum('category',['habari','taarifa','matukio','video','about','vision','members','team',
                'traditional-citizen','traditional-noncitizen','alternatively-citizen','alternatively-noncitizen',
                'massage-citizen','medicine-seller','assistant-alternative','assistant-traditional',
                'traditional-medicine-shrine','traditional-medicine-clinic','alternatively-medicine-clinic',
                'traditional-health-centre','alternative-health-centre','traditional-medicine-hospital',
                'alternative-medicine-hospital','traditional-medicine-store',
                'traditional-medicine-registration','alternative-medicine-registration',
                'enlisting-traditional-medicine','importing-medicine','exporting-medicine'])->default('habari');
            $table->string('title');
            $table->string('short_description');
            $table->text('body');
            $table->timestamps();
            $table->dateTime('published_at');
            $table->enum('status',['active','inactive'])->default('active');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('title_p')->nullable();
            $table->string('full_name')->nullable();
            $table->string('uuid');

            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habari_mpya');
    }
};
