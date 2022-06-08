@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
   <div class="m-portlet__head">
      <div class="m-portlet__head-caption">
         <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text"> Admin Management </h3>
         </div>
      </div>
      <div class="m-portlet__head-tools">
         @can('admin-create') 
         <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
               <a href="{{ route('admin.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
      <!--begin: Datatable -->
      <table class="table table-striped- table-bordered table-hover table-checkable" id="usertable">
         <thead>
            <tr>
               <th>User ID</th> 
               <th>Email</th>
               <th>Mobile</th>
               <th>User Role</th>               
               <th>Status</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($data as $key => $admin)
            <tr>
               <td tabindex="0" class="sorting_1">
                  <div class="m-card-user m-card-user--sm">
                     <div class="m-card-user__pic">
                        @php($img = isset($admin->image)?$admin->image:'default-user.jpg')
                        <img src="{{ asset('img/'.$img)}}" class="m--img-rounded m--marginless" alt="photo">
                     </div>
                     <div class="m-card-user__details">
                        <span class="m-card-user__name">{{ $admin->name ?? 'N/A' }}</span>
                        <a class="m-card-user__email m-link">{{ $admin->email ?? 'N/A' }}</a>
                     </div>
                  </div>
               </td> 
               <td>{{ $admin->email ??'N/A' }}</td>
               <td>{{ $admin->mobile ??'N/A' }}</td>               
               <td>
                  @if(!empty($admin->getRoleNames()))
                     @foreach($admin->getRoleNames() as $v)
                         <label class="m-badge m-badge--primary m-badge--wide">{{ $v }}</label>
                     @endforeach
                  @endif 
               </td>
               <td>
                  @if($admin->status ==1)
                     <label class="m--font-bold m--font-primary">Active</label>
                  @else
                     <label class="m--font-bold m--font-primary">Inactive</label>
                  @endif
               </td>
               <td nowrap="" align="center">
                  @if($admin->id !=1 && (auth()->user()->can('admin-delete') || auth()->user()->can('admin-edit')))

                     <span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">  
                           @can('admin-edit')                     
                           <a class="dropdown-item" href="{{ route('admin.edit',$admin->id) }}"><i class="la la-edit"></i> Edit </a>
                           @endcan
                           
                           @can('admin-delete')
                           <a class="dropdown-item" href="#{{ route('admin.destroy', $admin->id) }}"
                              onclick="event.preventDefault(); document.getElementById('user-delete-form{{ $admin->id }}').submit();
                              "><i class="la la-trash"></i>Delete</a>

                                {!! Form::open(['method' => 'DELETE','route' => ['admin.destroy', $admin->id],'style'=>'display:inline', 'id'=>'user-delete-form'.$admin->id]) !!}
                                {!! Form::close() !!}
                           @endcan
                        </div>
                     </span>
                  @endif

                  <a href="{{ route('admin.show',$admin->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                         <i class="la la-external-link"></i>
                       </a>
                       
               </td>
            </tr>
            @endforeach                            
         </tbody>
      </table>
      {!! $data->render() !!} 
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