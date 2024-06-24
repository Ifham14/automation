<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('state')->nullable();
            $table->date('ticket_date')->nullable();
            $table->tinyInteger('ticket_type')->nullable();
            $table->integer('ticket_points')->nullable();
            $table->string('existing_points')->nullable();
            $table->integer('existing_points_count')->nullable();
            $table->string('ticket_received_city')->nullable();
            $table->string('ticket_received_country')->nullable();
            $table->string('ticket_received_state')->nullable();
            $table->string('accident')->nullable();
            $table->text('accident_description')->nullable();
            $table->string('cdl_license')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('ticket_ids')->nullable();
            $table->date('response_deadline')->nullable();
            $table->text('additional_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
