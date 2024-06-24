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
        DB::unprepared('DROP TRIGGER IF EXISTS after_ticket_insert');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_ticket_insert
            AFTER INSERT ON tickets
            FOR EACH ROW
            BEGIN
                INSERT INTO tasks (ticket_id, event_stage, status, created_at, updated_at)
                VALUES (NEW.id, "New Driver", "Todo", NOW(), NOW());
            END
        ');
    }
};
