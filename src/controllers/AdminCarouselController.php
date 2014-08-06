<?php namespace Angel\Carousels;

use Angel\Core\AdminCrudController;

class AdminCarouselController extends AdminCrudController {

	protected $Model	= 'Carousel';
	protected $uri		= 'carousels';
	protected $plural	= 'carousels';
	protected $singular	= 'carousel';
	protected $package	= 'carousels';


	public function validate_rules($id = null)
	{
		return array(
			'name' => 'required'
		);
	}

}