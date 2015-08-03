<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \angularavel\Cliente::truncate();
        factory(\angularavel\Cliente::class, 10)->create();
    }
}
