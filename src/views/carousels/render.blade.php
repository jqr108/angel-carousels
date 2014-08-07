@section('css')
	@parent
	{{ HTML::style('packages/angel/carousels/js/owl-carousel/owl-carousel.css') }}
	{{ HTML::style('packages/angel/carousels/js/owl-carousel/owl-theme.css') }}
@append

@section('js')
	@parent
	{{ HTML::style('packages/angel/carousels/js/owl-carousel/owl-carousel.min.js') }}
<script>
	$(function() {
		$('#carousel-{{ $carousel->slug }}').owlCarousel();
	});
</script>
@append

<div id="carousel-{{ $carousel->slug }}" class="owl-carousel">
	@foreach ($carousel->slides as $slide)
		{{ $slide->html }}
	@endforeach
</div>

