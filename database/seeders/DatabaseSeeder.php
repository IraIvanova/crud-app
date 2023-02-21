<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Company::factory(50)->create();

        User::factory()->create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'test@test.com',
            'password' => '$2y$10$2aoF0MMAkLj3d9EJXUl5B.DAlsqXQeCicxYdBr77EPrQBOS9TZxka',
        ]);

        User::factory(20)->create();

        Project::factory(50)
            ->hasAttached(
                User::factory()->count(rand(1, 5)),
            )
            ->create();

    }
}
