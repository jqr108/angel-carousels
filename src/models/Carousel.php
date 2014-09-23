<?php namespace Angel\Carousels;

use Eloquent, App, View, Input;

class Carousel extends \Angel\Core\AngelModel {

	public $reorderable = false;

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

	public static function transition()
	{
		return array(
			'false'     => 'Normal',
			'fade'      => 'Fade',
			'backSlide' => 'Back Slide',
			'goDown'    => 'Go Down',
			'scaleUp'   => 'Scale Up',
		);
	}

	public static function columns()
	{
		return array(
			'name',
			'transition_style',
			'auto_play'
		);
	}

	public function validate_rules($id = null)
	{
		return array(
			'name' => 'required'
		);
	}

	///////////////////////////////////////////////
	//                  Events                   //
	///////////////////////////////////////////////
	public static function boot()
	{
		parent::boot();

		static::saved(function($carousel) {
			$CarouselSlide = App::make('CarouselSlide');

			$slideHTML   = Input::get('slideHTML');
			$slideNames  = Input::get('slideNames');
			$slideImages = Input::get('slideImages');

			if ($slideHTML) {
				foreach ($slideHTML as $slide_id => $html) {
					$slide = $CarouselSlide::where('id', $slide_id)->where('carousel_id', $carousel->id)->first();
					if (!$slide) {
						$slide = new $CarouselSlide;
						$slide->carousel_id = $carousel->id;
					}

					$slide->name = $slideNames[$slide_id];
					$slide->image = $slideImages[$slide_id];
					$slide->html = $html;
					$slide->save();
				}
			}
		});
	}
}
