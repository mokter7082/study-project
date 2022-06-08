@extends('layouts.app-backend')
@section('title', 'Verwaltung von Kurstypen')
@section('content') 

<div class="row"> 
    <div class="col-md-12 pl5 pr5">
        <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Verwaltung von Kurstypen</h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    @can('course-type-create')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('course-types.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Erstelle neu</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body right-bar">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                    <thead>
                        <tr>
                            <th width="50">Sl. Nein.</th> 
                            <th width="70">Bild</th> 
                            <th>Titel</th>                    
                            <th>Schnecke</th>
                            <th width="5%">Status</th>
                            <th width="5%">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($ctypes as $key => $ctype)
                            <tr>  
                                <td tabindex="0">{{ ++$key }}</td> 
                                <td>
                                    <img src="{{isset($ctype) && $ctype->picture !=''? $ctype->picture: URL::to('images/default.jpg')}}" class="m--marginless" alt="photo">  
                                </td> 
                                <td tabindex="2" width="50%">{!! $ctype->title??'' !!}</td>
                                                        
                                <td tabindex="2">{!! $ctype->slug??'' !!}</td>                         
                                <td><label class="m--font-bold m--font-primary">{{ $ctype->status??''}}</label></td>
                                <td nowrap="" align="center">
                                    @if((auth()->user()->can('course-type-delete') || auth()->user()->can('course-type-edit')))
                                    <span class="dropdown">
                                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('course-type-edit')
                                            <a class="dropdown-item" href="{{ route('course-types.edit',$ctype->id) }}"><i class="la la-edit"></i> Bearbeiten </a>
                                            @endcan
                                            
                                            @can('course-type-delete')
                                            <a class="dropdown-item delItem" data-delform="delete-form{{ $ctype->id }}" href="#{{ route('course-types.destroy', $ctype->id) }}"><i class="la la-trash"></i>Löschen</a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['course-types.destroy', $ctype->id],'style'=>'display:inline', 'id'=>'delete-form'.$ctype->id]) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </span>
                                    @endif 
                                </td>
                            </tr>
                            @if(count($ctype->childs))
                                @include('backend.ctypes.child', ['childs' => $ctype->childs, 'serpart'=>1])
                            @endif
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div> 
    </div>
</div>

@endsection

@push('scripts')
<script> 
    $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        ordering: false, 
        pageLength: 30
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