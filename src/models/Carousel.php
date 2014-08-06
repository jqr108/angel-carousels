<?php namespace Angel\Carousels;

use Eloquent, App;

class Carousel extends Eloquent {

	///////////////////////////////////////////////
	//               Relationships               //
	///////////////////////////////////////////////
	public function slides()
	{
		return $this->hasMany(App::make('CarouselSlide'));
	}
}