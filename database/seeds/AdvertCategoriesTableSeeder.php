<?php

use App\Models\Adverts\Category;
use Illuminate\Database\Seeder;

class AdvertCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 10)->create()->each(
            function (Category $category) {
                $counts = [0, random_int(0, 7)];
                $category->children()->saveMany(
                    factory(Category::class, $counts[array_rand($counts)])->create()->each(
                        function (Category $category) {
                            $count = [0, random_int(0, 7)];
                            $category->children()->saveMany(factory(Category::class, $count[array_rand($count)])->create());
                        }
                    )
                );
            }
        );
    }
}
