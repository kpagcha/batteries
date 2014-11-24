<?php

class RoleTableSeeder extends Seeder {

    public function run()
    {
        Role::create(array('name' => 'administrator'));
        Role::create(array('name' => 'account_manager'));
        Role::create(array('name' => 'customer'));
    }

}