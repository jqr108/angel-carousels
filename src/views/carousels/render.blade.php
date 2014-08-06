<div id="{{ $id }}" class="owl-carousel">
	@foreach ($slides as $slide)
		{{ $slide->html }}
	@endforeach
</div>