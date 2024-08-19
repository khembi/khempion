<?php
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $question = '';
    public function askQuestion(): void
    {
        $user = Auth::user();
        $this->validate([
            'question' => 'required|string|max:255',
        ]);
        Question::create([
            'question' => $this->question,
            'user_id' => $user->id,
        ]);
        
        $this->reset('question');            
        $this->dispatch('question-asked');
      
    }
}; ?>

<div>

    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Any questions?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("We're happy to assist.") }}
        </p>
    </header>

    <form wire:submit="askQuestion" class="mt-6 space-y-6">
        <div>
            <x-input-label for="question" :value="__('Question')" />
            <x-text-input wire:model="question" id="question" name="question" type="text" class="mt-1 block w-full" required autofocus autocomplete="question" />
            <x-input-error class="mt-2" :messages="$errors->get('question')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Ask') }}</x-primary-button>

            <x-action-message class="me-3" on="question-asked">
                {{ __('Asked.') }}
            </x-action-message>
        </div>
    </form>
</div>
