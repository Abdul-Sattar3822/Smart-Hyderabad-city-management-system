<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create([
            'name'      => 'Water Department',
            'slug'      => 'water',
            'email'     => 'water@hyderabad.gov.pk',
            'password'  => Hash::make('water@123'),
            'icon'      => '💧',
            'is_active' => true,
        ]);

        Department::create([
            'name'      => 'Roads Department',
            'slug'      => 'roads',
            'email'     => 'roads@hyderabad.gov.pk',
            'password'  => Hash::make('roads@123'),
            'icon'      => '🛣️',
            'is_active' => true,
        ]);

        Department::create([
            'name'      => 'Electricity Department',
            'slug'      => 'electricity',
            'email'     => 'electricity@hyderabad.gov.pk',
            'password'  => Hash::make('electricity@123'),
            'icon'      => '⚡',
            'is_active' => true,
        ]);

        Department::create([
            'name'      => 'Sanitation Department',
            'slug'      => 'sanitation',
            'email'     => 'sanitation@hyderabad.gov.pk',
            'password'  => Hash::make('sanitation@123'),
            'icon'      => '🧹',
            'is_active' => true,
        ]);
    }
}
