<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                [
                    'name'      => 'Author is unknown',
                    'email'     => 'author_unknows@g,g',
                    'password'  => bcrypt(Str::random(16)),
                ],
                [
                    'name'      => 'Author',
                    'email'     => 'Author@.g.g',
                    'password'  => bcrypt('123123'),
                ],
            ];
        DB::table('users')->insert($data);
    }
}
