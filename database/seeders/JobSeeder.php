<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $employers = User::where('role', 'employer')->get();
        $categories = Category::all();

        if ($employers->isEmpty() || $categories->isEmpty()) {
            return;
        }

        $jobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'description' => 'We are looking for an experienced Full Stack Developer with 5+ years of experience in Laravel and Vue.js.',
                'location' => 'Remote / San Francisco',
                'salary_range' => '$120k - $160k',
                'job_type' => 'Full-time',
                'category_name' => 'Software Development',
            ],
            [
                'title' => 'Product Designer (UI/UX)',
                'description' => 'Join our creative team to design world-class digital products. Figma proficiency is a must.',
                'location' => 'New York, NY',
                'salary_range' => '$90k - $130k',
                'job_type' => 'Full-time',
                'category_name' => 'Design',
            ],
            [
                'title' => 'Digital Marketing Manager',
                'description' => 'Lead our marketing efforts and drive growth through multiple digital channels.',
                'location' => 'London, UK',
                'salary_range' => '£50k - £75k',
                'job_type' => 'Contract',
                'category_name' => 'Marketing',
            ],
            [
                'title' => 'Mobile App Developer (Flutter)',
                'description' => 'Help us build the next generation of our mobile application using Flutter.',
                'location' => 'Berlin, Germany',
                'salary_range' => '€60k - €90k',
                'job_type' => 'Full-time',
                'category_name' => 'Software Development',
            ],
            [
                'title' => 'Financial Analyst',
                'description' => 'Looking for a sharp mind to help us analyze market trends and financial performance.',
                'location' => 'Singapore',
                'salary_range' => '$80k - $110k',
                'job_type' => 'Full-time',
                'category_name' => 'Finance',
            ],
        ];

        foreach ($jobs as $jobData) {
            $category = $categories->where('name', $jobData['category_name'])->first();
            $employer = $employers->random();

            unset($jobData['category_name']);

            Job::create(array_merge($jobData, [
                'employer_id' => $employer->id,
                'category_id' => $category->id,
                'slug' => Str::slug($jobData['title']) . '-' . Str::random(5),
                'status' => 'approved',
                'is_active' => true,
            ]));
        }
    }
}
