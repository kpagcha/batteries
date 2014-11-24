<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        $user = new User;
        $user->email = 'admin@batteries.pl';
        $user->password = Hash::make('admin');
        $user->first_name = "Jackson";
        $user->last_name = "Teller";
        $user->save();
        $user->setRole('administrator');

        $user = new User;
        $user->email = 'customer@batteries.pl';
        $user->password = Hash::make('customer');
        $user->first_name = "Tig";
        $user->last_name = "Trager";
        $user->save();
        $user->setRole('customer');

        $user = new User;
        $user->email = 'am@batteries.pl';
        $user->password = Hash::make('manager');
        $user->first_name = "Chibs";
        $user->last_name = "Telford";
        $user->save();
        $user->setRole('account_manager');
    }

}