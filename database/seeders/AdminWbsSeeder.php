<?php

namespace Database\Seeders;

use App\Models\AdminWbs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminWbsSeeder extends Seeder
{
    public function run(): void
    {
        AdminWbs::updateOrCreate(
            ['email' => 'adminwbs@dapenbrk.co.id'],
            [
                'name'     => 'Admin WBS',
                'password' => Hash::make('AdminWBS@2026!'),
            ]
        );
    }
}
