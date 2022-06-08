<ul>
	@foreach($childs as $child)
		@if( $child->status == 'Active')
			<li
	            class="{{ OmeLabHelper::get_activeslug($child->slug) }}"
            ><a href="{{ URL::to( 'category/'.$child->slug ) }}">{{ $child->title }}</a>			
				@if(count($child->childs))
					@include('backend.categories.manageChild', ['childs' => $child->childs])
			  @endif
			</li>
		@endif
	@endforeach
</ul>
