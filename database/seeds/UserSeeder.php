<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data=array(
        //     array(
        //         'name'=>'Admin',
        //         'email'=>'admin@gmail.com',
        //         'password'=>Hash::make('1111'),
        //         'role'=>'admin',
        //         'status'=>'active'
        //     ),
        //     array(
        //         'name'=>'User',
        //         'email'=>'user@gmail.com',
        //         'password'=>Hash::make('1111'),
        //         'role'=>'user',
        //         'status'=>'active'
        //     ),
        // );

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => 'abc',
            'role' => '1',
            'phone_number' => '123456789',
            'password' => Hash::make('12345678'),
        ]);
    }
}
