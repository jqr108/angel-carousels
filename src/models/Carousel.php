<?php namespace Angel\Carousels;

use Eloquent, App, View;

class Carousel extends Eloquent {

	///////////////////////////////////////////////
	//               Relationships               //
	///////////////////////////////////////////////
	public function slides()
	{
		return $this->hasMany(App::make('CarouselSlide'));
	}

	public function display()
	{
		$data = array();
		$data['slides'] = $this->slides;
		$data['id']   = 'carousel-' . $this->slug;
		return View::make('carousels::carousels.render', $data);
	}
}