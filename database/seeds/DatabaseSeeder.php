<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::insert([
            [
                'name'            => 'Mr. Admin',
                'email'           => 'admin@admin.com',
                'password'        => bcrypt('123456'),
                'role_id'         => 1,
                'status'          => 1,
                'remember_token'  => str_random(10),
                'created_at'      => date("Y-m-d H:i:s")
            ],
            [
                'name'            => 'Mr. Editor',
                'email'           => 'editor@editor.com',
                'password'        => bcrypt('123456'),
                'role_id'         => 2,
                'status'          => 1,
                'remember_token'  => str_random(10),
                'created_at'      => date("Y-m-d H:i:s")
            ],
            [
                'name'            => 'Mr. User',
                'email'           => 'user@user.com',
                'password'        => bcrypt('123456'),
                'role_id'         => 3,
                'status'          => 1,
                'remember_token'  => str_random(10),
                'created_at'      => date("Y-m-d H:i:s")
            ]
        ]);

        Role::insert([
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Editor','slug' => 'editor'],
            ['name' => 'User',  'slug' => 'user']
        ]);
    }
}
