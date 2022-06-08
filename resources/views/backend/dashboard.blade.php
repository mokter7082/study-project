@extends('layouts.app-backend')
@section('title', 'Instrumententafel')
@section('content')
<div class="container">
    <!--Begin::Section-->
	<div class="m-portlet col-md-8">
		<div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl mx-auto">
				{{-- <div class="col-xl-3"> 
					<div class="m-widget1">
						<div class="m-widget1__item"> 
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">Welcome admin</h3>
									<span class="m-widget1__desc">Diesen Monat Buchen</span>

									<div class="dblock pt30">
										<span class="m-widget1__number dblock m--font-brand">{{$monthly_booking??0}}</span>
										<a href="{{route('bookings.index')}}" class="m-widget1__desc">view all</a>
									</div> 
								</div> 
							</div>
						</div> 
					</div> 
				</div> --}}
				<div class="col-xl-9"> 
					<div class="m-widget14">
						<div class="row">
							<div class="col-lg-3 col-md-6 border rounded mx-2 text-center">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand">{{$total_booking??0}}</span>
									<span class="m-widget14__desc">
										Category
									</span>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 border rounded mx-2 text-center">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand">{{$total_students??0}}</span>
									<span class="m-widget14__desc">
										Product
									</span>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 rounded border mx-2 text-center">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand">{{$total_course??0}}</span>
									<span class="m-widget14__desc">
										Orders
									</span>
								</div>
							</div>
							{{-- <div class="col-lg-3 col-md-6">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand">${{$total_revenue??0}}</span>
									<span class="m-widget14__desc">
										Total Revenue
									</span>
								</div>
							</div> --}}
						</div> 
					</div> 
				</div> 
			</div>
		</div>
	</div>
 
</div>
@endsection

@push('scripts') 
<script src="{{asset('backend/app/js/dashboard.js')}}" type="text/javascript"></script>
@endpush