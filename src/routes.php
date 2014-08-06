<?php

Route::group(array('prefix'=>admin_uri('carousels'), 'before'=>'admin'), function() {

	$controller = 'AdminCarouselController';

	Route::get('/', array(
		'uses' => $controller . '@index'
	));
	Route::get('add', array(
		'uses' => $controller . '@add'
	));
	Route::post('add', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_add'
	));
	Route::get('edit/{id}', array(
		'uses' => $controller . '@edit'
	));
	Route::post('edit/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_edit'
	));
	Route::post('delete/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@hard_delete'
	));
	Route::get('delete-slide/{carousel}/{slide}', array(
		'uses' => $controller . '@delete_slide'
	));
});