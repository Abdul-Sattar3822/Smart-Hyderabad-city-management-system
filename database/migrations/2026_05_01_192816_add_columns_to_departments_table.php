<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            // Sirf woh columns add karo jo missing hain
            if (!Schema::hasColumn('departments', 'email')) {
                $table->string('email')->unique();
            }
            if (!Schema::hasColumn('departments', 'password')) {
                $table->string('password');
            }
            if (!Schema::hasColumn('departments', 'slug')) {
                $table->string('slug')->unique();
            }
            if (!Schema::hasColumn('departments', 'icon')) {
                $table->string('icon')->nullable();
            }
            if (!Schema::hasColumn('departments', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'slug', 'icon', 'is_active']);
        });
    }
};
