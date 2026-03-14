<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Software Development', 'slug' => 'software-development'],
            ['name' => 'Marketing', 'slug' => 'marketing'],
            ['name' => 'Design', 'slug' => 'design'],
            ['name' => 'Sales', 'slug' => 'sales'],
            ['name' => 'Customer Service', 'slug' => 'customer-service'],
            ['name' => 'Human Resources', 'slug' => 'human-resources'],
            ['name' => 'Finance', 'slug' => 'finance'],
            ['name' => 'Education', 'slug' => 'education'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
