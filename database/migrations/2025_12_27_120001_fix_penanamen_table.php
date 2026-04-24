<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update penanamen table (note: table name is 'penanamen', not 'penanamans')
        if (Schema::hasTable('penanamen') && Schema::hasColumn('penanamen', 'nama_petani')) {
            Schema::table('penanamen', function (Blueprint $table) {
                $table->string('username')->nullable()->after('nama_petani');
            });
            
            // Copy data from nama_petani to username
            DB::table('penanamen')->update(['username' => DB::raw('nama_petani')]);
            
            // Drop old column
            Schema::table('penanamen', function (Blueprint $table) {
                $table->dropColumn('nama_petani');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse penanamen table
        if (Schema::hasTable('penanamen') && Schema::hasColumn('penanamen', 'username')) {
            Schema::table('penanamen', function (Blueprint $table) {
                $table->string('nama_petani')->nullable()->after('username');
            });
            
            DB::table('penanamen')->update(['nama_petani' => DB::raw('username')]);
            
            Schema::table('penanamen', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }
    }
};
