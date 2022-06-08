@extends('layouts.app-backend')
@section('title', 'Category Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Our Categories</h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            @can('category-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Create new</span>
                        </span>
                    </a>
                </li>
            </ul>
            @endcan
        </div>
    </div>

    <div class="m-portlet__body">  
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr>  
                    <th>Category name</th>                    
                    <th>Slug</th>  
                    <th>Image</th>  
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($cats as $key => $category)
                    <tr>  
                        <td tabindex="2" width="50%">{!! $category->title??'' !!}</td>
                                                
                        <td tabindex="2">{!! $category->slug??'' !!}</td>                         
                        <td>
                            @if(!empty($category->picture))
                            <img src="{{isset($category) && $category->picture !=''? $category->picture: URL::to('img/default.jpg')}}" class="m--marginless" width="50px" alt="photo"> 
                             @endif 
                        </td>                         
                        <td><label class="m--font-bold m--font-primary">{{ $category->status??''}}</label></td>
                        <td nowrap="" align="center">
                            @if((auth()->user()->can('category-delete') || auth()->user()->can('category-edit')))
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @can('category-edit')
                                    <a class="dropdown-item" href="{{ route('categories.edit',$category->id) }}"><i class="la la-edit"></i> Edit </a>
                                    @endcan
                                    
                                    @can('category-delete')
                                    <a class="dropdown-item" href="#{{ route('categories.destroy', $category->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form{{ $category->id }}').submit();
                                    "><i class="la la-trash"></i>Delete</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline', 'id'=>'delete-form'.$category->id]) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </div>
                            </span>
                            @endif
                            {{-- <a href="{{ route('categories.show',$category->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left"><i class="la la-external-link"></i></a>  -->  --}} 
                        </td>
                    </tr>
                    @if(count($category->childs))
                        @include('backend.categories.child', ['childs' => $category->childs, 'serpart'=>1])
                    @endif
                @endforeach
            </tbody>
        </table> 
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        "searching": false,
        "ordering": false, 
        "pageLength": 100
    });
</script>
@endpush
