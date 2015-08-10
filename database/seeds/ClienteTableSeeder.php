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
        \angularavel\Models\Cliente::truncate();
        factory(\angularavel\Models\Cliente::class, 10)->create();
    }
}
