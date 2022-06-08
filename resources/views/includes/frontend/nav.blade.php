@if(!empty($navs))
<ul class="main-nav__navigation-box">
	@foreach($navs as $nav) 
		<li class="nav_label_1 {{active_nav($nav->menu_url??'', $active)}} {{count($nav->childs)?'dropdown':''}}">
			<a href="{{$nav->menu_url??''}}" target="{{$nav->target??'_self'}}">{{ $nav->name??'' }} {!!count($nav->childs)? '<i class="fa fa-angle-down"></i>':''!!}</a> 
			@if(count($nav->childs))
                @include('includes.frontend.nav_child', ['childs' => $nav->childs, 'label'=>1, 'active'=>$active])
            @endif
		</li>
	@endforeach 
</ul>
@endif