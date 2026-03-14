<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@portal.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Employers
        $employers = [
            [
                'name' => 'Tech Corp',
                'email' => 'tech@corp.com',
                'company_name' => 'Tech Corp Solutions',
                'company_website' => 'https://techcorp.com',
                'bio' => 'Leading technology solutions provider specializing in AI and Cloud computing.',
            ],
            [
                'name' => 'Creative Hub',
                'email' => 'hr@creativehub.io',
                'company_name' => 'Creative Hub Studio',
                'company_website' => 'https://creativehub.io',
                'bio' => 'Award-winning design agency pushing the boundaries of digital experiences.',
            ],
            [
                'name' => 'Global Finance',
                'email' => 'careers@globalfinance.net',
                'company_name' => 'Global Finance Inc.',
                'company_website' => 'https://globalfinance.net',
                'bio' => 'A multinational financial services corporation headquartered in New York City.',
            ],
        ];

        foreach ($employers as $employer) {
            User::create(array_merge($employer, [
                'role' => 'employer',
                'password' => Hash::make('password'),
            ]));
        }

        // Job Seekers
        $seekers = [
            ['name' => 'John Doe', 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['name' => 'Mike Ross', 'email' => 'mike@example.com'],
            ['name' => 'Rachel Zane', 'email' => 'rachel@example.com'],
            ['name' => 'Harvey Specter', 'email' => 'harvey@example.com'],
        ];

        foreach ($seekers as $seeker) {
            User::create(array_merge($seeker, [
                'role' => 'seeker',
                'password' => Hash::make('password'),
                'bio' => 'Experienced professional looking for new opportunities in ' . ($seeker['name'] == 'John Doe' ? 'Software' : 'Design') . '.',
            ]));
        }
    }
}
