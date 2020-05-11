<?php

use Illuminate\Database\Seeder;
use App\Models\User\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->states('admin')->create();
        factory(User::class, 10)->create();
    }
}
