@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="main-content-area homebg">
    <section class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="gallery-container"> 
                    @if(isset($course_types) && !empty($course_types))  
                        <div class="gallery-filters">
                            <button class="button is-checked" data-filter="*">Alle Kurse</button>
                            @foreach($course_types as $ctype)
                                <button class="button" data-filter=".{{$ctype->slug??''}}">{{$ctype->title??''}}</button>
                            @endforeach 
                        </div> 
                        <div class="gridwrap">
                            @if(isset($courses) && !empty($courses))
                                @foreach($courses as $course)
                                <div class="element-item {{ objString($course->ctypes, 'slug') }}">
                                    <a href="{{route('single_course', $course->slug??'')}}" class="gl-item">
                                        <img src="{{ !empty($course->picture)?$course->picture: asset('images/default.js')}}" alt="">
                                        <div class="gl-title">
                                            <h3>{{$course->title??''}}</h3>
                                            <button class="gl-button">Mehr</button>
                                        </div>
                                    </a>
                                </div>
                                @endforeach 
                            @endif
                        </div> 
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="calender-area">
                    <h2 class="calender-title">KURSKALENDER</h2>
                    <div id="dncalendar-container"></div> 

                    
                    <div class="calender-widget" id="eventList">
                        <h2 class="event-date-title">{{ date('F d') }}</h2>
                        @if(isset($today_couse) && !empty($today_couse)) 
                        <ul class="event-list">
                            @foreach ($today_couse as $key => $course)
                                <li class="event-item">
                                    <a class="eventAction" href="{{route('single_course', $course->slug)}}">
                                        <div class="event-img-area" style="background-image: url({{ !empty($course->picture)?$course->picture: asset('images/default.js')}});"> 
                                        </div>
                                        <div class="event-content">
                                            <div class="event-time-duration">
                                                <span>{{date('H', strtotime($course->start_time))}}<span class="ev-blink">:</span>{{date('i', strtotime($course->start_time))}} -   {{date('H', strtotime($course->end_time))}} <span class="ev-blink">:</span> {{date('i', strtotime($course->end_time))}}</span>
                                                <span class="event-duration">{{$course->clss_duration??''}}</span>
                                            </div>
                                            <h3 class="event-title">{{$course->title??''}}</h3>
                                        </div>
                                    </a>
                                </li>  
                            @endforeach 
                        </ul>
                        @endif
                    </div> 
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container">
           <h2><span><i class="fa fa-envelope-open"></i></span> Newsletter</h2>
           <p>Bleib auf dem Laufenden und stets über Termine und Neuigkeiten informiert. <br>
           Jetzt kostenlos zum Newsletter eintragen!</p>
        </div>
    </section> 
</div> 
@endsection


@push('scripts')
<script>
   /*--------------------------------
     # CALENDER
    ------------------------------------*/
    $(document).ready(function() {
        var my_calendar = $("#dncalendar-container").dnCalendar({
            minDate: "{{date('Y')}}-01-01",
            maxDate: "{{date('Y')}}-12-31",
            defaultDate: "{{date('Y-m')}}-01",
            monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ], 
            monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des' ],
            dayNames: [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            dayNamesShort: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa' ],
            dataTitles: { defaultDate: 'default', today : 'today' },
            notes: {!! $note??null !!}, 
            showNotes: false,
            startWeek: 'monday',
            dayUseShortName: true,
            dayClick: function(date, view) {
                //alert(date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear());
                var ymd = (date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate());

                showCourse(ymd);


            }
        });

        // init calendar
        my_calendar.build();

        // update calendar
        // my_calendar.update({
        //  minDate: "2016-01-05",
        //  defaultDate: "2016-05-04"
        // });

        //show courses
        var showCourse = function (date) {
            var url = "{{route('ajax_curse')}}";
            var data = {
                'course_date':date,
                '_token':'{{csrf_token()}}',
            };

            makeAjaxPost(data, url, null).then(function(resp){
                if (resp.status == 'success') { 
                    $('#eventList').html(resp.data)
                }else{
                    swalError("We can't find any course for this date");
                }
            })
        }
    });
</script>
@endpush