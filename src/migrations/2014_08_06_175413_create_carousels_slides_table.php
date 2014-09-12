 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselsSlidesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carousels_slides', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('carousel_id')->unsigned();
			$table->integer('order')->unsigned();
			$table->text('html');
			$table->string('image');
			$table->timestamps();

			$table->foreign('carousel_id')->references('id')->on('carousels')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carousels_slides');
	}

}
