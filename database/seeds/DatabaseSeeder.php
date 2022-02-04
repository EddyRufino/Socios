<?php

use App\User;
use App\Tarjeta;
use App\Vehiculo;
use App\Fotocheck;
use App\Asociacione;
use App\Correlativo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        // factory(User::class, 1)->create(['email' => 'eddyjaair@gmail.com']);
        factory(Asociacione::class, 10)->create();
        factory(Vehiculo::class, 3)->create();
        //factory(Correlativo::class, 1)->create();
        //factory(Fotocheck::class, 30)->create();
        //factory(Tarjeta::class, 30)->create();

        DB::table('users')->insert([
            'name' => 'Elna Beier',
            'email' => 'admin_transportes@gmail.com',
            'email_verified_at' => '2021-06-02 19:27:43',
            'password' => '$2y$10$KJe6N5xSW5YB1/OYZMko6e2KxdDKypikkYxVNfT2z0CZcqP7a7mcC',
            'admin_since' => 1,
            'remember_token' => 'T6QgOmTqvt8CJ0RiPwSNhCVc1qcj0dhdCjaG5HU6ba9C6xHi4Rv2cjlyoMO5'
        ]);

        DB::table('users')->insert([
            'name' => 'Elna Beier',
            'email' => 'digitador_uno@gmail.com',
            'email_verified_at' => '2021-06-02 19:27:43',
            'password' => '$2y$10$KJe6N5xSW5YB1/OYZMko6e2KxdDKypikkYxVNfT2z0CZcqP7a7mcC',
            'admin_since' => 1,
            'remember_token' => '0hGug8nrSx'
        ]);

        DB::table('users')->insert([
            'name' => 'Elna Beier',
            'email' => 'digitador_dos@gmail.com',
            'email_verified_at' => '2021-06-02 19:27:43',
            'password' => '$2y$10$KJe6N5xSW5YB1/OYZMko6e2KxdDKypikkYxVNfT2z0CZcqP7a7mcC',
            'admin_since' => 1,
            'remember_token' => '4yzHFHRz8p'
        ]);

        DB::table('users')->insert([
            'name' => 'Elna Beier',
            'email' => 'digitador_tres@gmail.com',
            'email_verified_at' => '2021-06-02 19:27:43',
            'password' => '$2y$10$KJe6N5xSW5YB1/OYZMko6e2KxdDKypikkYxVNfT2z0CZcqP7a7mcC',
            'admin_since' => 1,
            'remember_token' => 'MMnMftgtQ6'
        ]);

        DB::table('users')->insert([
            'name' => 'Sistemas',
            'email' => 'admin_sistemas@gmail.com',
            'email_verified_at' => '2021-06-02 19:27:43',
            'password' => '$2y$10$KJe6N5xSW5YB1/OYZMko6e2KxdDKypikkYxVNfT2z0CZcqP7a7mcC',
            'admin_since' => 1,
            'remember_token' => 'VBws6vqEny'
        ]);
        
        $this->call([
            RoleSeeder::class,
            AssignedRoleSeeder::class,
        ]);
    }
}
