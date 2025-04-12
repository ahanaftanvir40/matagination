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
        // Check if plans table already exists
        if (!Schema::hasTable('plans')) {
            Schema::create('plans', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();         // Starter, Silver, Platinum
                $table->string('icon');                   // 💼, 🚀, 👑
                $table->decimal('price', 8, 2);           // 20.00, 100.00
                $table->string('hashrate');               // 10 MH/s, etc.
                $table->string('tokens_per_day');         // ~1 Token/day
                $table->string('estimated_value');        // ~$14/month
                $table->timestamps();
            });
        } else {
            // If the table exists but needs updates, add them here
            Schema::table('plans', function (Blueprint $table) {
                // Example: add a new column if it doesn't exist
                if (!Schema::hasColumn('plans', 'icon')) {
                    $table->string('icon')->nullable();
                }
                if (!Schema::hasColumn('plans', 'hashrate')) {
                    $table->string('hashrate')->nullable();
                }
                if (!Schema::hasColumn('plans', 'tokens_per_day')) {
                    $table->string('tokens_per_day')->nullable(); 
                }
                if (!Schema::hasColumn('plans', 'estimated_value')) {
                    $table->string('estimated_value')->nullable();
                }
                
                // Make name unique if it's not already
                if (!Schema::hasColumn('plans', 'name')) {
                    $table->string('name')->unique();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop the table if we just modified it
        if (Schema::hasTable('plans') && !Schema::hasColumn('plans', 'name')) {
            Schema::dropIfExists('plans');
        }
    }
};