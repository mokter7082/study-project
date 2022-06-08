@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text"> Customer Management </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            @can('user-crate')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('users.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Info</th> 
                    <th>Phone</th> 
                    <th>Address</th>
                    <th>Postcode</th>
                    <th>City</th> 
                    <th>Status</th>
                    <th>Actions</th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>#{{ $user->id ??'' }}</td>
                    <td tabindex="0" class="sorting_1">
                        <div class="m-card-user m-card-user--sm">
                            <div class="m-card-user__pic">
                                @php($img = isset($user->image)?env('IMG_URL').'/'.$user->image:URL::to('backend/images/preview.png'))
                                <img src="{{$img}}" class="m--img-rounded m--marginless" alt="photo">
                            </div>
                            <div class="m-card-user__details">
                                <span class="m-card-user__name">{{ $user->name ?? 'N/A' }}</span>
                                <a class="m-card-user__email m-link">{{ $user->email ?? 'N/A' }}</a>
                            </div>
                        </div>
                    </td> 
                    <td>{{ $user->phone ??'' }}</td>   
                    <td>{{ $user->address ??'' }}</td>
                    <td>{{ $user->postcode ??'' }}</td>
                    <td>{{ $user->city ??'' }}</td>
                    <td>
                        @if($user->status =='Active')
                        <label class="m--font-bold m--font-primary">Active</label>
                        @else
                        <label class="m--font-bold m--font-primary">Inactive</label>
                        @endif
                    </td>
                    <td nowrap="" align="center">
                        @if( (auth()->user()->can('user-delete') || auth()->user()->can('user-edit')))
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @can('admin-edit')
                                <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}"><i class="la la-edit"></i> Edit </a>
                                @endcan
                                
                                @can('admin-delete')
                                <a class="dropdown-item" href="#{{ route('users.destroy', $user->id) }}"
                                    onclick="event.preventDefault(); document.getElementById('delete-form{{ $user->id }}').submit();
                                "><i class="la la-trash"></i>Delete</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline', 'id'=>'delete-form'.$user->id]) !!}
                                {!! Form::close() !!}
                                @endcan
                            </div>
                        </span>
                        @endif
                        <a href="{{ route('users.show',$user->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                        <i class="la la-external-link"></i></a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->links() !!}
    </div>
</div>
@endsection
@push('scripts')
<script>
$("#datatable").DataTable({
responsive: !0,
paging: !0,
});
</script>
@endpush