<?php

namespace Database\Seeders;

use App\Models\OauthSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OauthSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OauthSetting::firstOrCreate([
            'id' => 0,
            'provider' => 'google',
        ]);

        // OauthSetting::firstOrCreate([
        //     'id' => 0,
        //     'provider' => 'facebook',
        // ]);

        // OauthSetting::firstOrCreate([
        //     'id' => 0,
        //     'provider' => 'apple',
        // ]);
    }
}
