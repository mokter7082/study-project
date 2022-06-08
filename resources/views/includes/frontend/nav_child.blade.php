@if(!empty($childs))
<ul>
	@php($label = $label+1)
	@foreach($childs as $nav) 
		@if( $nav->status == 'Active')
			<li class="nav_label_{{$label}} {{active_nav($nav->menu_url??'', $active)}} {{count($nav->childs)?'dropdown':''}}">
				<a href="{{$nav->menu_url??''}}" target="{{$nav->target??'_self'}}">{{ $nav->name??'' }}</a> 
				@if(count($nav->childs))
	                @include('includes.frontend.nav_child', ['childs'=>$nav->childs, 'label'=>$label, 'active'=>$active])
	            @endif
			</li>
		@endif
	@endforeach 
</ul>
@endif

 