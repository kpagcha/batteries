<?php

class StatusTableSeeder extends Seeder {

    public function run()
    {
        Status::create(array('name' => 'open'));
        Status::create(array('name' => 'in_process'));
        Status::create(array('name' => 'negotiated'));
        Status::create(array('name' => 'completed'));
        Status::create(array('name' => 'rejected'));
    }

}