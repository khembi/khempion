<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('question.question-response');

    $component->assertSee('');
});
