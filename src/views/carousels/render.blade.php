<head>
	<link rel="stylesheet" href="/workbench/angel/carousels/public/js/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="/workbench/angel/carousels/public/js/owl-carousel/owl.theme.css">
</head>

<body>
<script src="assets/owl-carousel/owl.carousel.js"></script>
{{ HTML::script('/packages/angel/core/js/jquery/jquery.min.js') }}
{{ HTML::script('/workbench/angel/carousels/public/js/owl-carousel/owl-carousel.js') }}
<script>
	var id = '{{ $id }}';
	$(document).ready(function() {
		$('#{{ $id }}').owlCarousel();
	});
</script>
</body>

<div id="{{ $id }}" class="owl-carousel">
	@foreach ($slides as $slide)
		{{ $slide->html }}
	@endforeach
</div>



