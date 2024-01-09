<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'コカ・コーラ']);
        Category::create(['name' => '伊藤園']);
        Category::create(['name' => 'アサヒ']);
        Category::create(['name' => 'サントリー']);
        Category::create(['name' => 'キリン']);
        Category::create(['name' => 'ダイドー']);
    }
}
