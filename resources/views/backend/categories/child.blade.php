@php($sp = $serpart)
@foreach($childs as $key => $child)
	<tr>   
        <td tabindex="2">@for($i=1; $i<=$sp; $i++) ―  @endfor {!! $child->title??'' !!}</td>            
        <td tabindex="2">{!! $child->slug??'' !!}</td>   
        <td>
            @if(!empty($child->picture))
            <img src="{{isset($child) && $child->picture !=''? $child->picture: URL::to('img/default.jpg')}}" width="50px" class="m--marginless" alt="photo"> 
             @endif 
        </td> 
        <td> 
            <label class="m--font-bold m--font-primary">{{$child->status??''}}</label> 
        </td>
        <td nowrap="" align="center">
            @if((auth()->user()->can('category-delete') || auth()->user()->can('category-edit')))
            <span class="dropdown">
                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    @can('category-edit')
                    <a class="dropdown-item" href="{{ route('categories.edit',$child->id) }}"><i class="la la-edit"></i> Edit </a>
                    @endcan
                    
                    @can('category-delete')
                    <a class="dropdown-item" href="#{{ route('categories.destroy', $child->id) }}"
                        onclick="event.preventDefault(); document.getElementById('delete-form{{ $child->id }}').submit();
                    "><i class="la la-trash"></i>Delete</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $child->id],'style'=>'display:inline', 'id'=>'delete-form'.$child->id]) !!}
                    {!! Form::close() !!}
                    @endcan
                </div>
            </span>
            @endif
            <!-- <a href="{{ route('categories.show',$child->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                                   <i class="la la-external-link"></i></a>  -->                       
        </td>
    </tr>
	@if(count($child->childs))
		@php($serpart = $sp +1)
		@include('backend.categories.child',['childs' => $child->childs, 'serpart'=>$serpart])
	@endif	
@endforeach
