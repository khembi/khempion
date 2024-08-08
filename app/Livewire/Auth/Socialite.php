<?php

namespace App\Livewire\Auth;

use App\Models\OauthSetting;
use Livewire\Component;

class Socialite extends Component
{
    public $enabled_oauth_providers;
    
    public function mount()
    {
        $this->enabled_oauth_providers = OauthSetting::where('enabled', true)->get();
    }
    
    public function render()
    {
        return view('livewire.auth.socialite');
    }
}
