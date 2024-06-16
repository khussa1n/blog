<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();

        $categories = [
            ['name' => 'Разработка', 'description' => 'Категория для разработчиков', 'slug' => 'develop'],
            ['name' => 'Администрирование', 'description' => 'Категория для администраторов', 'slug' => 'Administration'],
            ['name' => 'Дизайн', 'description' => 'Категория для дизайнеров', 'slug' => 'design'],
            ['name' => 'Менеджмент', 'description' => 'Категория для менеджеров', 'slug' => 'management'],
            ['name' => 'Маркетинг', 'description' => 'Категория для маркетологов', 'slug' => 'marketing'],
            ['name' => 'Научпоп', 'description' => 'Научно-популярные статьи', 'slug' => 'popsci'],
        ];

        foreach ($categories as $category) {
            Category::factory()->create($category);
        }
    }
}
