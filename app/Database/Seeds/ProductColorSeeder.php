<?php

namespace App\Database\Seeds;

use App\Models\ProductColorModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProductColorSeeder extends Seeder
{
    public function run()
    {
        $category = new ProductColorModel();
        $faker = \Faker\Factory::create();

        $category->save([
            "color" => "Black",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);

        $category->save([
            "color" => "Red",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);

        $category->save([
            "color" => "Blue",
            "created_at"    => Time::createFromTimestamp($faker->unixTime()),
            "updated_at"    => Time::now()
        ]);
    }
}
