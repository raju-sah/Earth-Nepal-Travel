<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BaseMenuSeeder::class);
        $this->call(StaticPageSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(DestinationCategorySeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(SeasonSeeder::class);
        $this->call(CommonFaqSeeder::class);
        $this->call(IconSeeder::class);
        $this->call(SiteSettingsSeeder::class);
        $this->call(SeoSettingsSeeder::class);
        $this->call(SmtpSettingsSeeder::class);
        $this->call(InquiryTableSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageReviewSeeder::class);
        $this->call(EmailTemplateSeeder::class);
    }
}
