<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set setup_complete to 1 to bypass installer
        DB::table('configurations')
            ->where('config', 'setup_complete')
            ->update(['value' => '1']);
        
        // If record doesn't exist, create it
        if (DB::table('configurations')->where('config', 'setup_complete')->count() == 0) {
            DB::table('configurations')->insert([
                'config' => 'setup_complete',
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('configurations')
            ->where('config', 'setup_complete')
            ->update(['value' => '0']);
    }
};

