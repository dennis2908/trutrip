<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mroles')->insert([
            [
                'role_name' => 'super admin',
                'role_assign' => 'mbarang,mcustomer,mrole,torder,muser',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
			[
                'role_name' => 'admin',
                'role_assign' => 'mbarang,torder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
			
        ]);
		DB::table('musers')->insert([
            [
                'name' => 'dana',
				'username' => 'dana88',
				'email' => 'dana88@grtech.com.my',
				'phone' => '0811919191',
				'address' => 'jakarta selatan',
                'password' => Hash::make('dana88'),
				'm_role' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
			[
               'name' => 'dina',
				'username' => 'dina88',
				'email' => 'dina88@grtech.com.my',
				'phone' => '0811919191',
				'address' => 'jakarta utara',
                'password' => Hash::make('dina88'),
				'm_role' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
		
		DB::table('mbarangs')->insert([
            [
                'name' => 'Mouse XX',
				'code' => 'B001',
				'qty' => 2000,
				'price' => 200000,
				'desc' => 'Good Item',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
			[
                'name' => 'Headset XX',
				'code' => 'B002',
				'qty' => 2000,
				'price' => 100000,
				'desc' => 'Good Item',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
		
		
		DB::table('mcustomers')->insert([
            [
                'name' => 'PT Bintang 5',
				'code' => 'C001',
				'phone' => "0819129292",
				'address' => "Jl Bintang Lima 9 Jakarta",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
			[
                'name' => 'PT Maju Mundur',
				'code' => 'C002',
				'phone' => '08191292928',
				'address' => "Jl Tomat 8 Jakarta",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
