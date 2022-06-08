@extends('layouts.app-backend')
@section('title', 'Course Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Our Products</h3>
            </div>
        </div> 
        {{-- <div class="m-portlet__head-tools">
            @can('book-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('courses.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Erstelle neu</span>
                        </span>
                    </a>
                </li>
            </ul>
            @endcan
        </div> --}}
    </div>

    <div class="m-portlet__body"> 
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr> 
                    <th width="40">Sl.</th>
                    <th width="70">image</th>  
                    <th>Title</th> 
                    <th>Caegory</th>
                    <th>Price for 30 days</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                
                @foreach($equipments as $key => $equipment) 
                   
                
                    <tr> 
                        <td tabindex="0">{{ ++$key }}</td>  
                        <td tabindex="1">
                            @if(!empty($equipment->picture))
                                <img src="{{isset($equipment) && $equipment->picture !=''? $equipment->picture: URL::to('image/default.jpg')}}" class="m--marginless" alt="photo"> 
                            @endif
                        </td>
                        <td tabindex="2">{!! $equipment->title??'' !!}</td>
                        <td tabindex="3">{!! $equipment->category_id??'' !!}</td>
                        <td tabindex="3">{!! $equipment->price_30??'' !!}</td>
                               
                        <td><label class="m--font-bold m--font-primary">{{ $equipment->status??''}}</label></td>
                        <td nowrap="" align="center">
                            @if((auth()->user()->can('course-delete') || auth()->user()->can('course-edit')))
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    @can('course-edit')
                                        {{-- <a class="dropdown-item" href="{{ route('equipments.edit',$equipment->id) }}"><i class="la la-edit"></i> Edit </a> --}}
                                        <a class="dropdown-item" href="{{ route('equipments.edit',$equipment->id) }}"><i class="la la-edit"></i> Edit </a>
                                    @endcan
                                    
                                    @can('course-delete')
                                    <a class="dropdown-item" href="#{{ route('equipments.destroy', $equipment->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form{{ $equipment->id }}').submit();
                                    "><i class="la la-trash"></i>Delete</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['equipments.destroy', $equipment->id],'style'=>'display:inline', 'id'=>'delete-form'.$equipment->id]) !!}
                                    {!! Form::close() !!}




{{-- 
                                        <a class="dropdown-item delItem" href="#{{route('courses.destroy', $course->id)}}" data-delform="delete-form{{ $course->id }}"><i class="la la-trash"></i>Delete</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['courses.destroy', $course->id],'style'=>'display:inline', 'id'=>'delete-form'.$course->id]) !!}
                                    {!! Form::close() !!} --}}
                                    @endcan

                                </div>
                            </span>
                            @endif
                            
                            {{-- <a href="{{ route('books.show',$book->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left"><i class="la la-external-link"></i></a> --}}                    
                        </td>
                    </tr> 
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
        "ordering": false, 
        "pageLength": 100
    }); 
    $('.delItem').click(function(e) {
        e.preventDefault; 
        var formId = $(this).data('delform'); 
        swalConfirm().then((result) => {
          if (result.value) { 
            $('#'+formId).submit();
          }
        })
    })
</script>
@endpush
