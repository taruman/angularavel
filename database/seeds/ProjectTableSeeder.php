<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \angularavel\Entities\Project::truncate();
        factory(\angularavel\Entities\Project::class, 10)->create();
    }
}
