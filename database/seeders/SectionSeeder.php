<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Control;
use Illuminate\Support\Str;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::factory(5)->create()->each(function ($section) {
            $section->name = 'Data Management';
            $section->save();
            $section->hasManyControls()->saveMany(Control::factory(5)->make());
        });
    }
}
