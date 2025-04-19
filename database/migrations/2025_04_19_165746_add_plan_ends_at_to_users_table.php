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
        Schema::table('users', function (Blueprint $table) {
            // Only add plan_ends_at if it doesn't exist
            if (!Schema::hasColumn('users', 'plan_ends_at')) {
                $table->timestamp('plan_ends_at')->nullable()->after('plan_started_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'plan_ends_at')) {
                $table->dropColumn('plan_ends_at');
            }
        });
    }
};
