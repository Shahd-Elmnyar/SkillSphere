<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'email'=>'contact@skillshub.com',
            'phone'=>'01277466371',
            'facebook'=>'http://www.facebook.com',
            'twitter'=>'https://www.twitter.com',
            'linkedin'=>'https://www.linkedin.com',
            'instagram'=>'https://www.instagram.com',
            'youtube'=>'https://www.youtube.com',
        ]);
    }
}
