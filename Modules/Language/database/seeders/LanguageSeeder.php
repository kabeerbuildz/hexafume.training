<?php

namespace Modules\Language\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Language\app\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::updateOrCreate(
            ['name' => 'English'],
            [
                'code' => 'en',
                'is_default' => true,
            ]
        );

        Language::updateOrCreate(
            ['name' => 'Hindi'],
            [
                'code' => 'hi',
            ]
        );

        Language::updateOrCreate(
            ['name' => 'Arabic'],
            [
                'code' => 'ar',
                'direction' => 'rtl',
            ]
        );
    }
}
