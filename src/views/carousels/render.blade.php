@section('css')
	{{ HTML::style('packages/angel/carousels/js/owl-carousel/owl.carousel.css') }}
	{{ HTML::style('packages/angel/carousels/js/owl-carousel/owl.theme.css') }}
@append

@section('js')
	{{ HTML::script('packages/angel/carousels/js/owl-carousel/owl.carousel.min.js') }}
<script>
	$(function() {
		$('#carousel-{{ $carousel->slug }}').owlCarousel({
			items   :   1
		});
	});
</script>
@append

<div id="carousel-{{ $carousel->slug }}" class="owl-carousel">
	@foreach ($carousel->slides as $slide)
		{{ $slide->html }}
	@endforeach
</div>

