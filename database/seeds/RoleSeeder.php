<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Soy un administrador'
        ]);

        DB::table('roles')->insert([
            'name' => 'secretaria',
            'display_name' => 'Secretaria',
            'description' => 'Soy una secretaria'
        ]);

        DB::table('roles')->insert([
            'name' => 'comerciante',
            'display_name' => 'Comerciante',
            'description' => 'Soy un comerciante'
        ]);

        DB::table('roles')->insert([
            'name' => 'cobrador',
            'display_name' => 'Cobrador Sisa',
            'description' => 'Soy un cobrador'
        ]);

        DB::table('roles')->insert([
            'name' => 'banio',
            'display_name' => 'Cobrador Baño',
            'description' => 'Soy un cobrador'
        ]);
    }
}
