<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::insert([
            "id" => uuid_create(),
            "nome" => "root",
            "email" => "root@email.com",
            "password" => bcrypt("12345678")
        ]);
    }
}
