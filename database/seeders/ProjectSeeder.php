<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Pharmacy Manager',
                'description' => 'An application to manage inventory, invoices, and patients in a pharmacy. Features authentication, user roles, and reporting.',
                'tools' => 'Laravel, Livewire, TailwindCSS, MySQL',
                
                'project_name' => 'pharmacy-manager',
            ],
            [
                'title' => 'To-Do List',
                'description' => 'A to-do list that allows adding, marking as completed, deleting, importing, and exporting tasks.',
                'tools' => 'Laravel, Livewire, TailwindCSS',

                'project_name' => 'todos',
            ],
            [
                'title' => 'Earthquake Tracker',
                'description' => 'A project that displays recent earthquakes using an external API and helps visualize the data.',
                'tools' => 'Laravel, Livewire, Google Charts, HTTP Client',

                'project_name' => 'earthquake-tracker',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
