<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyers = User::role('buyer')->get();
        Product::factory(40)->create([
            'user_id' => function () use ($buyers) {
                return $buyers->random()->id;
            },
        ]);
    }
}
