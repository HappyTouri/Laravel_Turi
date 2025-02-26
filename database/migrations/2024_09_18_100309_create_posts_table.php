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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_category_id');
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ru')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('photo')->nullable();
            $table->string('banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
