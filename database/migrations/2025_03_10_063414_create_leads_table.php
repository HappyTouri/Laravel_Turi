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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperator_id')->nullable()->constrained('cooperators')->nullOnDelete();
            $table->integer('offer_id')->nullable();
            $table->integer('private_tour_id')->nullable();
            $table->string('lead_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('name')->nullable();
            $table->integer('number_of_person')->nullable();
            $table->text('lead_note')->nullable();
            $table->date('from')->nullable();
            $table->date('till')->nullable();
            $table->string('arrive_to')->nullable();
            $table->string('departure_from')->nullable();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->tinyInteger('airticket')->nullable();
            $table->tinyInteger('accommodation')->nullable();
            $table->tinyInteger('tour')->nullable();
            $table->tinyInteger('follow_up')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('lead_status')->nullOnDelete();
            $table->tinyInteger('confirm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
