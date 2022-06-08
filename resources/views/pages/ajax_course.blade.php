<h2 class="event-date-title">{{ date('F d', strtotime($course_date)) }}</h2>
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