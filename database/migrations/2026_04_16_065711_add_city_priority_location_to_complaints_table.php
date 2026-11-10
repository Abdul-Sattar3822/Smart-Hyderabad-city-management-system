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
        Schema::table('complaints', function (Blueprint $table) {

            if (!Schema::hasColumn('complaints', 'city')) {
                $table->string('city')->nullable();
            }

            if (!Schema::hasColumn('complaints', 'priority')) {
                $table->string('priority')->default('medium');
            }

            if (!Schema::hasColumn('complaints', 'location')) {
                $table->string('location')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['city', 'location']);
        });
    }
};
