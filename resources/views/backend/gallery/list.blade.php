@extends('layouts.app-backend')
@section('title', 'Pages Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Nachrichten Management</h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            @can('book-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Erstelle Neu</span>
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
                    <th>Excerpt</th>   
                    <th>Status</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody> 

                @foreach($galleries as $key => $post) 
                    <tr> 
                        <td tabindex="0">{{ ++$key }}</td> 
                        
                        <td>
                            @if(!empty($post->picture))
                                <img src="{{isset($post) && $post->picture !=''? $post->picture: URL::to('img/default.jpg')}}" class="m--marginless" alt="photo"> 
                            @endif
                        </td>  
                        <td tabindex="2">{!! $post->title??'' !!}</td>
                        <td tabindex="2">{!! $post->excerpt??'' !!}</td>                
                        <td><label class="m--font-bold m--font-primary">{{ $post->status??''}}</label></td>
                        <td nowrap="" align="center">
                            @if((auth()->user()->can('post-delete') || auth()->user()->can('page-edit')))
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    @can('post-edit')
                                        <a class="dropdown-item" href="{{ route('galleries.edit',$post->id) }}"><i class="la la-edit"></i> Edit </a>
                                    @endcan
                                    
                                    @can('post-delete')
                                        <a class="dropdown-item delItem" href="#{{route('galleries.destroy', $post->id)}}" data-delform="delete-form{{ $post->id }}"><i class="la la-trash"></i>Delete</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['galleries.destroy', $post->id],'style'=>'display:inline', 'id'=>'delete-form'.$post->id]) !!}
                                    {!! Form::close() !!}
                                    @endcan

                                </div>
                            </span>
                            @endif                     
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
