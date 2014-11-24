<?php

class ClearTablesSeeder extends Seeder {

    public function run()
    {
		// $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

		// foreach ($tableNames as $name) {
		//     if ($name == 'migrations') {
		//         continue;
		//     }
		//     DB::table($name)->truncate();
		// }

		$tables = [ 'carts', 'negotiations', 'negotiations_statuses', 'orders',
		 'roles', 'statuses', 'users', 'users_roles' ];

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
    }

}