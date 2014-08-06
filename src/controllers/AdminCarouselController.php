<?php namespace Angel\Carousels;

use Angel\Core\AdminCrudController;

use Redirect;

class AdminCarouselController extends AdminCrudController {

	protected $Model	= 'Carousel';
	protected $uri		= 'carousels';
	protected $plural	= 'carousels';
	protected $singular	= 'carousel';
	protected $package	= 'carousels';

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

	public function add_slide($id)
	{
		$slide = new CarouselSlide;
		$slide->carousel_id = $id;
		$slide->save();

		return Redirect::to('admin/carousels/edit/'.$id)->with('success', '
			<p>Slide successfully added.</p>
		');
	}

}