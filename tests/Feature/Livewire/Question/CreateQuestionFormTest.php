<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('question.create-question-form');

    $component->assertSee('');
});
