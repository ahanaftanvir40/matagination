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
        Schema::table('users', function (Blueprint $table) {
            // Only add plan_id if it doesn't exist
            if (!Schema::hasColumn('users', 'plan_id')) {
                $table->unsignedBigInteger('plan_id')->nullable()->after('password');
                
                // Foreign key relationship
                $table->foreign('plan_id')
                      ->references('id')->on('plans')
                      ->onDelete('set null')
                      ->onUpdate('cascade');
            }
            
            // Only add plan_started_at if it doesn't exist
            if (!Schema::hasColumn('users', 'plan_started_at')) {
                $table->timestamp('plan_started_at')->nullable()->after('plan_id');
            }
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn(['plan_id', 'plan_started_at']);
        });
    }
    
};
