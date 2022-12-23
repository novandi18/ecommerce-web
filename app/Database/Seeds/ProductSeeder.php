<?php

namespace App\Database\Seeds;

use App\Models\ProductModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $product = new ProductModel();
        $faker = \Faker\Factory::create();

        if (($open = fopen(FCPATH . "modules\data\mike-products-dummy.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $product->save([
                    "product_name"  => $data[0],
                    "description"   => $faker->text(),
                    "price"         => $faker->numberBetween(999000, 2000000),
                    "photo"         => $data[2] . ".png",
                    "category_id"   => $data[1],
                    "created_at"    => Time::createFromTimestamp($faker->unixTime()),
                    "updated_at"    => Time::now()
                ]);
            }

            fclose($open);
        }
    }
}
