<?php

use App\Models\OauthSetting;
use Laravel\Socialite\Facades\Socialite;

function get_socialite_provider(string $provider)
{
    $oauth_setting = OauthSetting::firstWhere('provider', $provider);

    $config = [
        'client_id' => $oauth_setting->client_id,
        'client_secret' => $oauth_setting->client_secret,
        'redirect' => $oauth_setting->redirect_uri,
    ];

    $provider_class_map = [
        'google' => \Laravel\Socialite\Two\GoogleProvider::class,
        // facebook,
        // apple,
    ];

    return Socialite::buildProvider(
        $provider_class_map[$provider],
        $config
    );
}
