<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \angularavel\Entities\ProjectNote::truncate();
        factory(\angularavel\Entities\ProjectNote::class, 10)->create();
    }
}
