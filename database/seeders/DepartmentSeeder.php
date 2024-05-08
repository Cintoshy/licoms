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
        // Sample department data
$departments = [
    [
        'department_name' => 'CAS',
        'description' => 'College of Arts and Sciences',
        'logo' => 'logos/2abFyHYmk3CYKbeTcNEpm5yIAe2YBGh4sdoKf3Px.jpg',
    ],
    [
        'department_name' => 'CCS',
        'description' => 'College of Computer Science',
        'logo' => 'logos/y8ORojd4fSBsz1ntJR2cBI93FTABEjQhzkiTDcv5.jpg',
    ],
    [
        'department_name' => 'CEA',
        'description' => 'College of Engineering and Architecture',
        'logo' => 'logos/QlGS5Z62ptIEF6YI87JfasfuZRYQa0b8NcfLTebZ.jpg',
    ],
    [
        'department_name' => 'CHS',
        'description' => 'College of Health Sciences',
        'logo' => 'logos/AmC2vBvWSXID3YPaekkAmyOVKWP1U5apJsJqoKnw.jpg',
    ],
    [
        'department_name' => 'CTDE',
        'description' => 'College of Technological and Developmental Education',
        'logo' => 'logos/KAAdor8nmWqMNh7H7Wrd5FenO5LxxQly0FDYPx6H.jpg',
    ],
    [
        'department_name' => 'CTHBM',
        'description' => 'College of Tourism, Hospitality and Business Management',
        'logo' => 'logos/PvV9mJEKQgtrs7ds7JeWYWVwf1K4rLtKo4tQykxY.jpg',
    ],
];


        // Insert the departments into the database
        foreach ($departments as $departmentData) {
            Department::create($departmentData);
        }
    }
}
