@extends('layouts.app-backend')
@section('title', 'Pages Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Pages Management</h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            @can('book-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('pages.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
                    <th width="50">Sl. Nein.</th> 
                    <th width="70">Bild</th> 
                    <th>Titel</th>   
                    <th width="70px">Status</th>
                    <th width="60px">Aktionen</th>
                </tr>
            </thead>
            <tbody> 

                @foreach($pages as $key => $page) 
                    <tr> 
                        <td tabindex="0">{{ ++$key }}</td> 
                        <td>
                            @if(!empty($page->picture))
                                <img src="{{isset($page) && $page->picture !=''? $page->picture: URL::to('images/default.jpg')}}" class="m--marginless" alt="photo"> 
                            @endif
                        </td>    
                        <td tabindex="2">{!! $page->title??'' !!}</td> 
                        <td><label class="m--font-bold m--font-primary">{{ $page->status??''}}</label></td>
                        <td nowrap="" align="center">
                            @if((auth()->user()->can('page-delete') || auth()->user()->can('page-edit')))
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="{{ route('pages',$page->slug) }}" target="_blank"><i class="la la-external-link"></i> Aussicht </a>
                                    
                                    @can('page-edit')
                                        <a class="dropdown-item" href="{{ route('pages.edit',$page->id) }}"><i class="la la-edit"></i> Bearbeiten </a>
                                    @endcan
                                    
                                    @can('page-delete')
                                        <a class="dropdown-item delItem" href="#{{route('pages.destroy', $page->id)}}" data-delform="delete-form{{ $page->id }}"><i class="la la-trash"></i>Löschen</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['pages.destroy', $page->id],'style'=>'display:inline', 'id'=>'delete-form'.$page->id]) !!}
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
