<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignedRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assigned_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('assigned_roles')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);

        DB::table('assigned_roles')->insert([
            'user_id' => 3,
            'role_id' => 3
        ]);
    }
}
