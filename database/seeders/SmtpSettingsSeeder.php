<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SmtpSetting;

class SmtpSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $smtpSettingsData = [
            'mail_mailer' => 'smtp',
            'mail_host' => 'sandbox.smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => '52d91eb67531ae',
            'mail_password' => '5d1ee6cedf3073',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'joxox30946@namewok.com',
            'mail_from_name' => 'Travel App',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        SmtpSetting::updateOrInsert(['id' => 1], $smtpSettingsData);
    }
}
