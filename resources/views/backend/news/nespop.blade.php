{{-- <h2>{!!$news->title??''!!}</h2> --}}

<div class="row">
	@if(isset($news->picture) && $news->picture !='')
	<div class="col-md-4"><img src="{{$news->picture?? URL::to('images/default.jpg')}}"></div>
	@endif
	
	@if(isset($news->picture) && $news->picture !='')<div class="col-md-8"> @else <div class="col-md-12"> @endif
		{!!$news->description??''!!}
	</div>
</div> 