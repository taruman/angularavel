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
        \angularavel\Entities\Cliente::truncate();
        factory(\angularavel\Entities\Cliente::class, 10)->create();
    }
}
