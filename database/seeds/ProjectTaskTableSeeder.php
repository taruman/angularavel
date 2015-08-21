<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \angularavel\Entities\ProjectTask::truncate();
        factory(\angularavel\Entities\ProjectTask::class, 10)->create();
    }
}
