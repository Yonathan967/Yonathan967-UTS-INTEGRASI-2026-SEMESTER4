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
        // Remove user_name from penanamen table
        if (Schema::hasTable('penanamen') && Schema::hasColumn('penanamen', 'user_name')) {
            Schema::table('penanamen', function (Blueprint $table) {
                $table->dropColumn('user_name');
            });
        }

        // Remove user_name from perawatans table
        if (Schema::hasTable('perawatans') && Schema::hasColumn('perawatans', 'user_name')) {
            Schema::table('perawatans', function (Blueprint $table) {
                $table->dropColumn('user_name');
            });
        }

        // Remove user_name from pemanenans table
        if (Schema::hasTable('pemanenans') && Schema::hasColumn('pemanenans', 'user_name')) {
            Schema::table('pemanenans', function (Blueprint $table) {
                $table->dropColumn('user_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back user_name to penanamen table
        if (Schema::hasTable('penanamen') && !Schema::hasColumn('penanamen', 'user_name')) {
            Schema::table('penanamen', function (Blueprint $table) {
                $table->string('user_name')->nullable()->after('tanggal_tanam');
            });
        }

        // Add back user_name to perawatans table
        if (Schema::hasTable('perawatans') && !Schema::hasColumn('perawatans', 'user_name')) {
            Schema::table('perawatans', function (Blueprint $table) {
                $table->string('user_name')->nullable()->after('tanggal_perawatan');
            });
        }

        // Add back user_name to pemanenans table
        if (Schema::hasTable('pemanenans') && !Schema::hasColumn('pemanenans', 'user_name')) {
            Schema::table('pemanenans', function (Blueprint $table) {
                $table->string('user_name')->nullable()->after('tanggal_panen');
            });
        }
    }
};
