<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if users table already exists
        if (Schema::hasTable('users')) {
            // Add columns to existing users table
            Schema::table('users', function (Blueprint $table) {
                // Add plan_id as foreign key if it doesn't exist
                if (!Schema::hasColumn('users', 'plan_id')) {
                    $table->foreignId('plan_id')->nullable()->constrained('plans')->onDelete('set null');
                }
            });
        } else {
            // Only create the table if it doesn't exist (unlikely in this case)
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->foreignId('plan_id')->nullable()->constrained('plans')->onDelete('set null');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Drop the foreign key constraint
                $table->dropForeign(['plan_id']);
                // Drop the column
                $table->dropColumn('plan_id');
            });
        } else {
            Schema::dropIfExists('users');
        }
    }
}