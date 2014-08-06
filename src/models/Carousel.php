<?php namespace Angel\Carousels;

use Eloquent, App;

class Carousel extends Eloquent {

	public static function columns()
	{
		return array(
			'name'
		);
	}

	///////////////////////////////////////////////
	//               Relationships               //
	///////////////////////////////////////////////
	public function slides()
	{
		return $this->hasMany(App::make('CarouselSlide'));
	}
}