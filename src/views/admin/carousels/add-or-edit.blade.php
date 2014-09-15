@extends('core::admin.template')

@section('title', ucfirst($action).' Carousel')

@section('css')
@stop

@section('js')
	{{ HTML::script('packages/angel/core/js/ckeditor/ckeditor.js') }}
	<script>
		$('.add-slide').click(function() {
			var newNumber = parseInt($('.slide').last().data('id')) + 1;
			if (isNaN(newNumber)) {
				newNumber = 1;
			}
			var html =
				'<div class="slide" data-id="'+newNumber+'">'
					+ '<p><input type="text" class="form-control" name="slideNames['+newNumber+']" placeholder="Name"><p>'
					+ '<p><textarea class="ckeditor" name="slideHTML['+newNumber+']" id="ckMe'+newNumber+'"></textarea><p>'
					+ '<div>'
					+ '<p><input type="text" class="form-control" placeholder="Image" name="slideImages['+newNumber+']"></p>'
					+ '<div class="text-right pad"><button type="button" class="btn btn-default imageBrowse" id="imageUpload'+newNumber+'">Browse...</button></div>'
					+ '</div>'
					+ '<p class="text-left">'
					+ '<a type="button" class="btn btn-danger btn-sm delete-slide" id="delete'+newNumber+'">Delete Slide</a>'
					+ '</p>'
					+ '</div>';
			$('.slides').append(html);
			$('#delete' + newNumber).click(function() {
				$(this).parent().parent().remove();
			});
			$('#imageUpload' + newNumber).click(function() {
				var $input = $(this).parent().prev().children('input');
				window.KCFinder = {};
				window.KCFinder.callBack = function(url) {
					url = url.substring(1);
					$input.val(url);
					window.KCFinder = null;
				};
				window.open('/packages/angel/core/js/kcfinder/browse.php?type=images', 'image_browser', 'width=1000,height=600');
			});
			CKEDITOR.replace('ckMe'+newNumber);
		});
	</script>
@stop

@section('content')
	<h1>{{ ucfirst($action) }} Carousel</h1>
	@if ($action == 'edit')
		@if (!$carousel->deleted_at)
			{{ Form::open(array('role'=>'form',
								'url'=>'admin/carousels/delete/'.$carousel->id,
								'style'=>'margin-bottom:15px;')) }}
				<input type="submit" class="btn btn-sm btn-danger" value="Delete" />
			{{ Form::close() }}
		@else
			{{ Form::open(array('role'=>'form',
								'url'=>'admin/carousels/hard-delete/'.$carousel->id,
								'class'=>'deleteForm',
								'data-confirm'=>'Delete this carousel forever?  This action cannot be undone!')) }}
				<input type="submit" class="btn btn-sm btn-danger" value="Delete Forever" />
			{{ Form::close() }}
			<a href="{{ url('admin/carousels/restore/'.$carousel->id) }}" class="btn btn-sm btn-success">Restore</a>
		@endif
	@endif

	@if ($action == 'edit')
		{{ Form::model($carousel) }}
	@elseif ($action == 'add')
		{{ Form::open(array('role'=>'form', 'method'=>'post')) }}
	@endif

	<div class="row">
		<div class="col-md-9">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td style="width: 150px">
							{{ Form::label('name', 'Name') }}
						</td>
						<td>
							<div style="width:300px">
								{{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
							</div>
						</td>
					</tr>
					<tr>
						<td>
							{{ Form::label('auto_play', 'Transition Speed') }}
							<p>In milliseconds.<br> Set to 0 for no autotransition.</p>
						</td>
						<td>
							<div style="width:300px">
								{{ Form::text('auto_play', null, array('class'=>'form-control', 'placeholder'=>'Transition Speed')) }}
							</div>
						</td>
					</tr>
					<tr>
						<td>
							{{ Form::label('transition_style', 'Transition Style') }}
							<p>Special transitions may not work in older browsers.</p>
						</td>
						<td>
							<div style="width:300px">
								<?php $Carousel = App::make('Carousel'); ?>
								{{ Form::select('transition_style', $Carousel::transition(), null, array('class'=>'form-control', 'placeholder'=>'Transition Style')) }}
							</div>
						</td>
					</tr>
	@if ($action == 'edit')
					<tr>
						<td>
							<b>Slides</b>
						</td>
						<td>
							<div class="slides">
								@foreach ($carousel->slides as $slide)
								<div class="slide" data-id="{{ $slide->id }}">
									<p>
										{{ Form::text('slideNames['.$slide->id.']',  $slide->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
									</p>
									<p>
										{{ Form::textarea('slideHTML['.$slide->id.']', $slide->html, array('class'=>'ckeditor')) }}
									</p>
									<div>
										<p>
											{{ Form::text('slideImages['.$slide->id.']', $slide->image, array('class'=>'form-control', 'placeholder'=>'Image')) }}
										</p>
										<div class="text-right pad">
											<button type="button" class="btn btn-default imageBrowse">Browse...</button>
										</div>
									</div>
									<p class="text-left">
										<a type="button" class="btn btn-danger btn-sm delete-slide" href="{{ url('admin/carousels/delete-slide/' . $slide->id )  }}">Delete Slide</a>
									</p>
								</div>
								@endforeach
							</div>
							<br />
							<div>
								<a class="btn btn-default btn-md add-slide">
									<span class="glyphicon glyphicon-plus"></span>
									Add Slide
								</a>
							</div>
						</td>
					</tr>
	@endif
				</tbody>
			</table>
		</div>{{-- Left Column --}}
	</div>{{-- Row --}}
	<div class="text-right pad">
		<input type="submit" class="btn btn-primary" value="Save" />
	</div>
	{{ Form::close() }}
@stop