<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new UserModel();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $user->save([
                "user_name"     => $faker->name(),
                "email"         => $faker->email(),
                "password"      => password_hash("user123", PASSWORD_DEFAULT),
                "phone_number"  => $faker->phoneNumber(),
                "address"       => $faker->address(),
                "created_at"    => Time::createFromTimestamp($faker->unixTime()),
                "updated_at"    => Time::now()
            ]);
        }
    }
}
