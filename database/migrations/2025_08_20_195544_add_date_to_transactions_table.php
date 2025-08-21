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
        Schema::table('transactions', function (Blueprint $table) {
             if (!Schema::hasColumn('transactions', 'date')) {
            $table->date('date')->nullable()->after('amount');
        }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
                  // Rollback me column drop kar do
            if (Schema::hasColumn('transactions', 'date')) {
                $table->dropColumn('date');
            }
        });
    }
};
