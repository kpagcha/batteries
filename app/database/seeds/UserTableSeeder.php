<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        $user = new User;
        $user->email = 'admin@batteries.pl';
        $user->password = Hash::make('admin');
        $user->first_name = "ADMIN";
        $user->last_name = "ADMIN";
        $user->save();
        $user->setRole('administrator');
    }

}