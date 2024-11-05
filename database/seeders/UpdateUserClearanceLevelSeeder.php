<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateUserClearanceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::find(1)?->update(['clearance_level' => 5]);
        User::find(2)?->update(['clearance_level' => 3]);
        User::find(6)?->update(['clearance_level' => 2]);
        User::find(7)?->update(['clearance_level' => 2]);
    }
}
