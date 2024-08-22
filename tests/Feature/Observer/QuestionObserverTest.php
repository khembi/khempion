<?php

use App\Models\Question;

test('does_logger_create_when_question_is_created', function () {
    $question = Question::factory()->create();  

    $this->assertDatabaseHas('log_entries', [
        'loggable_id' => $question->id,
        'level' => 'NOTICE',
        'message' => 'Question asked'
    ]);
});

test('does_logger_create_when_question_is_edited', function () {
    $question = Question::factory()->create();
    $question->question = 'new question';
    $question->save();

    $this->assertDatabaseHas('log_entries', [
        'loggable_id' => $question->id,
        'level' => 'NOTICE',
        'message' => 'Question edited'
    ]);
});

test('does_logger_create_when_question_is_deleted', function () {
    $question = Question::factory()->create();
    $question->delete();
    $this->assertDatabaseHas('log_entries', [
        'loggable_id' => $question->id,
        'level' => 'NOTICE',
        'message' => 'Question deleted'
    ]);
});