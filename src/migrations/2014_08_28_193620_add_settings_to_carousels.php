<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingsToCarousels extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('carousels', function(Blueprint $table)
		{
			$table->integer('auto_play');
			$table->string('transition_style');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('carousels', function(Blueprint $table)
		{
			$table->dropColumn('auto_play');
			$table->dropColumn('transition_style');
		});
	}

}
