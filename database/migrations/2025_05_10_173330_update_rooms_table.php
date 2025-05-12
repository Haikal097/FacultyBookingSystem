<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['package', 'location']);

            // Add new columns
            $table->string('building')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Re-add dropped columns
            $table->string('package')->nullable();
            $table->string('location')->nullable();

            // Drop newly added columns
            $table->dropColumn(['building', 'status', 'description']);
        });
    }
}
