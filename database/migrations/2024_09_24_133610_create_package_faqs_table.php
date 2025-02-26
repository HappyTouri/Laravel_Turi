<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_faqs', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->string('question_en')->nullable();
            $table->text('answer_en')->nullable();
            $table->string('question_ru')->nullable();
            $table->text('answer_ru')->nullable();
            $table->string('question_ar')->nullable();
            $table->text('answer_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_faqs');
    }
};
