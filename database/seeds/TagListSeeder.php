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
        if(App\TagList::count() === 0) {
            $users = App\User::all();
            foreach($users as $user){
                factory(App\TagList::class)->times(10)->create(['user_id'=>$user->id]);
            }
        }
    }
}
