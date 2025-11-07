<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Trần Công Minh',
            'email' => 'developer@lumina.vn',
            'password'=> Hash::make('password'),
            'code' => generate_employee_code()
        ]);

        $this->call([
            ModuleSeeder::class,
        ]);
    }
}
