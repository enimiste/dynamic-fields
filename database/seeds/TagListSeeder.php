<?php

use Illuminate\Database\Seeder;

class TagListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TagList::class)->times(10)->create();
    }
}
