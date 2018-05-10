<?php

use Illuminate\Database\Seeder;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 20; $i++)
        {
            DB::table('characters')->insert([
                'id_rand' => str_random(20),
                'uid' => $faker->unique()->randomNumber(),
                'player_name' => $faker->unique()->userName(),
                'actor_name' => $faker->unique()->userName(),
                'omote1_id' => $faker->numberBetween(1, 100),
                'omote2_id' => $faker->numberBetween(1, 100),
                'ura1_id' => $faker->numberBetween(1, 100),
                'ura2_id' => $faker->numberBetween(1, 100),
                'ura3_id' => $faker->numberBetween(1, 100),
                'ura4_id' => $faker->numberBetween(1, 100),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
