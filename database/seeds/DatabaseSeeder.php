<?php

use App\Asociacione;
use App\Correlativo;
use App\Fotocheck;
use App\Tarjeta;
use App\User;
use App\Vehiculo;
use Illuminate\Database\Seeder;

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
        //factory(User::class, 1)->create();
        factory(Asociacione::class, 10)->create();
        factory(Vehiculo::class, 3)->create();
        factory(Correlativo::class, 1)->create();
        factory(Fotocheck::class, 30)->create();
        factory(Tarjeta::class, 30)->create();
    }
}
