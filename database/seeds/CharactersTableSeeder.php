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

        DB::table('characters')->insert([
            'id_rand' => str_random(20),
            'password_hash' => 'a',
            'player_name' => 'A達祐実',
            'actor_name' => 'A沢 すず',
            'organization' => 'A沢家',
            'age' => '12',
            'gender' => '女',
            'good' => 10,
            'evil' => 24,
            'social' => 21,
            'most_important' => 'リュウ',
            'omote1_id' => 0,
            'omote2_id' => 1,
            'ura1_id' => 2,
            'ura2_id' => 3,
            'ura3_id' => 4,
            'ura4_id' => 5,
            'kill1' => 'A沢 悟志',
            'kill2' => '大坪 英二',
            'kill3' => '警官B',
            'kill4' => '浅野 朋枝',
            'kill5' => '園田 真弓',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ローカルならダミーデータを作成
        if (env('APP_ENV') == 'local')
        {
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
}
