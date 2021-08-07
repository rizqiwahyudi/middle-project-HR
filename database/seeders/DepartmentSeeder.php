<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'HRD',
            'description' => 'Managing human resources and employees',
        ]);

        Department::create([
            'name' => 'Sales & Marketing',
            'description' => 'Responsible for sales and marketing of products produced by the company',
        ]);

        Department::factory(20)->create();
    }
}
