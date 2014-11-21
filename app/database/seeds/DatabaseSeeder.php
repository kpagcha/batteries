<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('users_roles')->truncate();
		$this->call('RoleTableSeeder');
		$this->call('UserTableSeeder');
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}
