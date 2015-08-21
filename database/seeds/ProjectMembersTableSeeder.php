<?php

use Illuminate\Database\Seeder;

class ProjectMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \angularavel\Entities\ProjectMembers::truncate();
        factory(\angularavel\Entities\ProjectMembers::class, 10)->create();
    }
}
