<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $category = new CategoryModel();
        $faker = \Faker\Factory::create();

        $category->save([
            "category_name" => "Lifestyle",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);

        $category->save([
            "category_name" => "Running",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);

        $category->save([
            "category_name" => "Basketball",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);

        $category->save([
            "category_name" => "Football",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);

        $category->save([
            "category_name" => "Gym & Training",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);
    }
}
