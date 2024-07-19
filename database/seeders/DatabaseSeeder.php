<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Assessment;
use App\Models\Attachment;
use App\Models\LogEntry;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Filament Admin user
        User::updateOrInsert([
            'email' => 'admin@mail.com',
        ], [
            'name' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);

        // Create questions
        Question::factory(1)->hasLogEntries(1, function (array $attributes, Question $question) {
            return ['user_id' => $question->user_id];
        })->create()
        ->each(function (Question $question) {
            // Create responses for each question by the user
            Response::factory(1)->hasLogEntries(function (array $attributes, Response $response) {
                return ['user_id' => $response->user_id];
            })->create([
                'question_id' => $question->id,
            ])->each(function (Response $response) {
                // Create actions for each response
                Action::factory(1)->hasLogEntries(function (array $attributes, Action $action) {
                    return ['user_id' => $action->user_id];
                })->create([
                    'user_id' => $response->question->user_id,
                    'response_id' => $response->id,
                ])->each(function (Action $action) {
                    // Create assessments for each action
                    Assessment::factory(1)->hasLogEntries(function (array $attributes, Assessment $assessment) {
                        return ['user_id' => $assessment->user_id];
                    })->for(
                        $action, 'assessable'
                    )->create([
                        'user_id' => $action->response->question->user_id,
                    ])->each(function (Assessment $assessment) {
                        // Create attachments for each assessment
                        Attachment::factory()->for(
                            $assessment, 'attachable'
                        )->create(['user_id' => $assessment->user_id]);
                    });

                    // Create attachments for each action
                    Attachment::factory()->for(
                        $action, 'attachable'
                    )->create(['user_id' => $action->user_id]);
                });

                // Create attachments for each action
                Attachment::factory()->for(
                    $response, 'attachable'
                )->create(['user_id' => $response->user_id]);
            });

            // Create attachments for each question
            Attachment::factory()->for(
                $question, 'attachable'
            )->create(['user_id' => $question->user_id]);
        });
    }
}
