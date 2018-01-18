<?php

use Illuminate\Database\Seeder;
use App\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
          'category' => 'greetings',
          'content' => '',
        ]);

        Config::create([
          'category' => 'regards',
          'content' => '',
        ]);
    }
}
