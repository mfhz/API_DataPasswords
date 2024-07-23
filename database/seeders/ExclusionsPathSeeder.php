<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExclusionsPath;

class ExclusionsPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExclusionsPath::insert([
            ['path' => "C://"],
            ['path' => "C://"]
        ]);
    }
}
