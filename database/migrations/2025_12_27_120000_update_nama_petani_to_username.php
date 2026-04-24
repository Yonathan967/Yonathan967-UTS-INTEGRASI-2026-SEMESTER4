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
        // Update penanamans table
        if (Schema::hasTable('penanamans') && Schema::hasColumn('penanamans', 'nama_petani')) {
            Schema::table('penanamans', function (Blueprint $table) {
                $table->string('username')->nullable()->after('nama_petani');
            });
            
            // Copy data from nama_petani to username
            DB::table('penanamans')->update(['username' => DB::raw('nama_petani')]);
            
            // Drop old column
            Schema::table('penanamans', function (Blueprint $table) {
                $table->dropColumn('nama_petani');
            });
        }

        // Update perawatans table
        if (Schema::hasTable('perawatans') && Schema::hasColumn('perawatans', 'nama_petani')) {
            Schema::table('perawatans', function (Blueprint $table) {
                $table->string('username')->nullable()->after('nama_petani');
            });
            
            // Copy data from nama_petani to username
            DB::table('perawatans')->update(['username' => DB::raw('nama_petani')]);
            
            // Drop old column
            Schema::table('perawatans', function (Blueprint $table) {
                $table->dropColumn('nama_petani');
            });
        }

        // Update pemanenans table
        if (Schema::hasTable('pemanenans') && Schema::hasColumn('pemanenans', 'nama_petani')) {
            Schema::table('pemanenans', function (Blueprint $table) {
                $table->string('username')->nullable()->after('nama_petani');
            });
            
            // Copy data from nama_petani to username
            DB::table('pemanenans')->update(['username' => DB::raw('nama_petani')]);
            
            // Drop old column
            Schema::table('pemanenans', function (Blueprint $table) {
                $table->dropColumn('nama_petani');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse penanamans table
        if (Schema::hasTable('penanamans') && Schema::hasColumn('penanamans', 'username')) {
            Schema::table('penanamans', function (Blueprint $table) {
                $table->string('nama_petani')->nullable()->after('username');
            });
            
            DB::table('penanamans')->update(['nama_petani' => DB::raw('username')]);
            
            Schema::table('penanamans', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }

        // Reverse perawatans table
        if (Schema::hasTable('perawatans') && Schema::hasColumn('perawatans', 'username')) {
            Schema::table('perawatans', function (Blueprint $table) {
                $table->string('nama_petani')->nullable()->after('username');
            });
            
            DB::table('perawatans')->update(['nama_petani' => DB::raw('username')]);
            
            Schema::table('perawatans', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }

        // Reverse pemanenans table
        if (Schema::hasTable('pemanenans') && Schema::hasColumn('pemanenans', 'username')) {
            Schema::table('pemanenans', function (Blueprint $table) {
                $table->string('nama_petani')->nullable()->after('username');
            });
            
            DB::table('pemanenans')->update(['nama_petani' => DB::raw('username')]);
            
            Schema::table('pemanenans', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }
    }
};
