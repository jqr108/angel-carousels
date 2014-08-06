<?php

class Carousel extends Eloquent {

	protected $softDelete = true;

	// Columns to update/insert on edit/add
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
		return $this->hasMany('CarouselSlide');
	}
}