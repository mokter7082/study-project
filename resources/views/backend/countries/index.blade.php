@extends('layouts.app-backend')
@section('title', 'Country Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Country Management</h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            @can('country-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('countries.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
        <div class="table-responsive"> 
            <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                <thead>
                    <tr> 
                        <th class="text-center nowrap">Sl No.</th>
                        <th class="text-center nowrap">Country Name</th>
                        <th class="text-center nowrap">Code</th> 
                        <th class="text-center nowrap">Status</th>
                        <th class="text-center nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                @foreach ($countries as $key => $row)
                <tr> 
                   <td tabindex="0" class="sorting_1"> {{ ++$key }} </td> 
                   <td>{{ $row->title??null }}</td>
                   <td>{{ $row->code??null }}</td>
                   <td>
                      @if($row->status =='Active')
                         <label class="m--font-bold m--font-primary">Active</label>
                      @else
                         <label class="m--font-bold m--font-primary">Inactive</label>
                      @endif
                   </td>
                   <td nowrap="" align="center">
                      @if( (auth()->user()->can('country-delete') || auth()->user()->can('country-edit')))

                         <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">  
                               @can('country-edit')                     
                               <a class="dropdown-item" href="{{ route('countries.edit',$row->id) }}"><i class="la la-edit"></i> Edit </a>
                               @endcan
                               
                               @can('country-delete')
                               <a class="dropdown-item" href="#{{ route('countries.destroy', $row->id) }}"
                                  onclick="event.preventDefault(); document.getElementById('user-delete-form{{ $row->id }}').submit();
                                  "><i class="la la-trash"></i>Delete</a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['countries.destroy', $row->id],'style'=>'display:inline', 'id'=>'user-delete-form'.$row->id]) !!}
                                    {!! Form::close() !!}
                               @endcan
                            </div>
                         </span>
                      @endif
                      <a href="{{ route('countries.show',$row->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                        <i class="la la-external-link"></i>
                      </a>                       
                   </td>
                </tr>
                @endforeach                            
                </tbody>  
            </table>
        </div> 
    </div>
</div>
@endsection
@push('scripts')
<script>
$("#datatable").DataTable({
    responsive: !0,
    paging: !0,
    "searching": false,
});
</script>
@endpush