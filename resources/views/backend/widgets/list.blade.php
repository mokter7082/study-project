@extends('layouts.app-backend')
@section('title', 'Widgets Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Widgets Management</h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            @can('book-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('widgets.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Create New</span>
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
                    <th width="50">Sl No.</th> 
                    <th>Title</th>       
                    <th>Referance</th>                    
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 

                @foreach($widgets as $key => $widget) 
                    <tr> 
                        <td tabindex="0">{{ ++$key }}</td> 
                        <td tabindex="2">{!! $widget->title??'' !!}</td>
                        <td tabindex="2">{!! $widget->referance??'' !!}</td>
                                          
                        <td><label class="m--font-bold m--font-primary">{{ $widget->status??''}}</label></td>
                        <td nowrap="" align="center">
                            @if((auth()->user()->can('widget-delete') || auth()->user()->can('widget-edit')))
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    @can('widget-edit')
                                        <a class="dropdown-item" href="{{ route('widgets.edit',$widget->id) }}"><i class="la la-edit"></i> Edit </a>
                                    @endcan
                                    
                                    @can('widget-delete')
                                        <a class="dropdown-item delItem" href="#{{route('widgets.destroy', $widget->id)}}" data-delform="delete-form{{ $widget->id }}"><i class="la la-trash"></i>Delete</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['widgets.destroy', $widget->id],'style'=>'display:inline', 'id'=>'delete-form'.$widget->id]) !!}
                                    {!! Form::close() !!}
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
