<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatteriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('batteries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('category');
			$table->string('technology')->nullable();
			$table->float('voltaje')->nullable();
			$table->integer('capacity')->nullable();
			$table->float('height')->nullable();
			$table->float('diameter')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('batteries');
	}

}
