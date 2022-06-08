@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
   <div class="m-portlet__head">
      <div class="m-portlet__head-caption">
         <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">Role Management</h3>
         </div>
      </div>
      <div class="m-portlet__head-tools">
         <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
               @can('role-create') 
                  <a href="{{ route('roles.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                     <span> <i class="la la-plus"></i> <span>Create New</span> </span>
                  </a>
               @endcan
            </li>
         </ul>
      </div>
   </div>
   <div class="m-portlet__body">
         <table class="table table-striped- table-bordered table-hover table-checkable" id="usertable">
         <thead>
            <tr>
               <th width="5%">No</th> 
               <th width="20%">Name</th>   
               <th width="60%">Permissions</th>   
               <th width="15%">Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($roles as $key => $role)
               <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $role->name }}</td>
                  <td>@if($role->permissions) @foreach($role->permissions as $permission) <label class="m-badge m-badge--primary m-badge--wide">{{ $permission->name }}</label> @endforeach @endif</td>
                  <td> 
                     @can('role-edit')
                        <span class="dropdown">
                           <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                           <div class="dropdown-menu dropdown-menu-right">
                              @can('role-edit')                     
                                 <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}"><i class="la la-edit"></i> Edit </a> 
                              @endcan
                              
                              @can('admin-delete')
                                 <a class="dropdown-item" href="#{{ route('admin.destroy', $role->id) }}"
                                 onclick="event.preventDefault(); document.getElementById('user-delete-form{{ $role->id }}').submit();
                                 "><i class="la la-trash"></i> Delete </a>
                                 {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline', 'id'=>'roles-delete-form'.$role->id]) !!}
                                 {!! Form::close() !!}
                              @endcan
                           </div>
                        </span> 
                     @endcan
                      <a href="{{ route('roles.show',$role->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left"><i class="la la-external-link"></i></a> 
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
      $("#usertable").DataTable({
         responsive: !0,
         paging: !0,
      });
   </script>
@endpush
