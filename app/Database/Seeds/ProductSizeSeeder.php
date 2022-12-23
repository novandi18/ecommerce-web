<?php

namespace App\Database\Seeds;

use App\Models\ProductSizeModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProductSizeSeeder extends Seeder
{
    public function run()
    {
        $productSize = new ProductSizeModel();
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 25; $i++) {
            for ($x = 1; $x <= 3; $x++) {
                $productSize->save([
                    "size35"        => $faker->numberBetween(1, 100),
                    "size36"        => $faker->numberBetween(1, 100),
                    "size37"        => $faker->numberBetween(1, 100),
                    "size38"        => $faker->numberBetween(1, 100),
                    "size39"        => $faker->numberBetween(1, 100),
                    "size40"        => $faker->numberBetween(1, 100),
                    "size41"        => $faker->numberBetween(1, 100),
                    "size42"        => $faker->numberBetween(1, 100),
                    "color_id"      => $x,
                    "product_id"    => $i,
                    "created_at"    => Time::createFromTimestamp($faker->unixTime()),
                    "updated_at"    => Time::now()
                ]);
            }
        }
    }
}
