<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        $admin->assignRole('admin');

        $teamLeads = User::factory(5)->create();
        $teamLeads->each(function ($teamLead) {
            $teamLead->assignRole('team_lead');
        });

        $buyers = User::factory(20)->create([
            'mentor_id' => function () use ($teamLeads) {
                return $teamLeads->random()->id;
            },
        ]);
        $buyers->each(function ($buyer) {
            $buyer->assignRole('buyer');
        });
    }
}
