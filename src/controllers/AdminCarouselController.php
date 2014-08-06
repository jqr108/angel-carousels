<?php namespace Angel\Carousels;

use Angel\Core\AdminCrudController;

use Redirect, App, Input;

class AdminCarouselController extends AdminCrudController {

	protected $Model	= 'Carousel';
	protected $uri		= 'carousels';
	protected $plural	= 'carousels';
	protected $singular	= 'carousel';
	protected $package	= 'carousels';
	protected $slug     = 'name';

	public static function columns()
	{
		return array(
			'name'
		);
	}

	public function validate_rules($id = null)
	{
		return array(
			'name' => 'required'
		);
	}

	public function after_save($carousel, &$changes = array())
	{
		$slides = Input::get('slides');

		$CarouselSlide = App::make('CarouselSlide');

		if ($slides) {
			foreach ($slides as $slide_id => $html) {
				$slide = $CarouselSlide::where('id', $slide_id)->where('carousel_id', $carousel->id)->first();
				if (!$slide) {
					$slide = new $CarouselSlide;
					$slide->carousel_id = $carousel->id;
				}
				$slide->html = $html;
				$slide->save();
			}
		}
	}

	public function delete_slide($carousel, $slide) {
		$CarouselSlide = App::make('CarouselSlide');

		$slide = $CarouselSlide::where('id', $slide)->where('carousel_id', $carousel)->first();
		if ($slide) $slide->delete();

		return Redirect::to('admin/carousels/edit/'.$carousel)->with('success', '
			<p>Slide successfully deleted.</p>
		');
	}

}