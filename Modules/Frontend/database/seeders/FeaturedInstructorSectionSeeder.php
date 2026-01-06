<?php

namespace Modules\Frontend\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Frontend\app\Models\FeaturedInstructor;

class FeaturedInstructorSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        FeaturedInstructor::updateOrCreate(
            ['id' => 1],
            ['id' => 1]
        );
    }
}
