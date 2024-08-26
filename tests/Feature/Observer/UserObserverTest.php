<?php
use App\Models\User;

test('does_logger_create_when_user_is_created', function () {
    $user = User::factory()->create();  
    $this->assertDatabaseHas('log_entries', [
        'loggable_id' => $user->id,
        'level' => 'NOTICE',
        'message' => 'User created',
        
    ]);
});