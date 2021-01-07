<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'id'   => Role::ADMIN_ID,
                'name' => 'Администратор',
            ],
            [
                'id'   => Role::USER_ID,
                'name' => 'Пользователь'
            ],
        ]);

        User::updateOrCreate(['email' => 'admin@mail.ru'],[
            'name' => "Admin",
            'password' => bcrypt('password'),
            'role_id' => Role::ADMIN_ID,
        ]);

        User::updateOrCreate(['email' => 'user@mail.ru'],[
            'name' => "Test user",
            'password' => bcrypt('password'),
            'role_id' => Role::USER_ID,
        ]);

    }
}
