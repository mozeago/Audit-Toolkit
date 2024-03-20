<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Question;
use App\Models\Control;
use App\Models\Information;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // Seed Sections with random names and related Controls
        Section::factory(10)->create()->each(function ($section) {
            $section->hasManyControls()->saveMany(Control::factory(5)->make());
        });

        // Seed Questions with random text and related Information within existing Controls
        Control::factory(20)->create()->each(function ($control) {
            $questions = $control->hasManyQuestions()->saveMany(Question::factory(3)->make()); // Create Questions first
            foreach ($questions as $question) {
                $question->hasOneInformation()->save(Information::factory()->make()); // Create Information for each Question
            }
        });
    }
}
