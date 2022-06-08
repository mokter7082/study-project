<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-area homebg">
    <section class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="gallery-container"> 
                    <?php if(isset($course_types) && !empty($course_types)): ?>  
                        <div class="gallery-filters">
                            <button class="button is-checked" data-filter="*">Alle Kurse</button>
                            <?php $__currentLoopData = $course_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button class="button" data-filter=".<?php echo e($ctype->slug??''); ?>"><?php echo e($ctype->title??''); ?></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div> 
                        <div class="gridwrap">
                            <?php if(isset($courses) && !empty($courses)): ?>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="element-item <?php echo e(objString($course->ctypes, 'slug')); ?>">
                                    <a href="<?php echo e(route('single_course', $course->slug??'')); ?>" class="gl-item">
                                        <img src="<?php echo e(!empty($course->picture)?$course->picture: asset('images/default.js')); ?>" alt="">
                                        <div class="gl-title">
                                            <h3><?php echo e($course->title??''); ?></h3>
                                            <button class="gl-button">Mehr</button>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <?php endif; ?>
                        </div> 
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="calender-area">
                    <h2 class="calender-title">KURSKALENDER</h2>
                    <div id="dncalendar-container"></div> 

                    
                    <div class="calender-widget" id="eventList">
                        <h2 class="event-date-title"><?php echo e(date('F d')); ?></h2>
                        <?php if(isset($today_couse) && !empty($today_couse)): ?> 
                        <ul class="event-list">
                            <?php $__currentLoopData = $today_couse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="event-item">
                                    <a class="eventAction" href="<?php echo e(route('single_course', $course->slug)); ?>">
                                        <div class="event-img-area" style="background-image: url(<?php echo e(!empty($course->picture)?$course->picture: asset('images/default.js')); ?>);"> 
                                        </div>
                                        <div class="event-content">
                                            <div class="event-time-duration">
                                                <span><?php echo e(date('H', strtotime($course->start_time))); ?><span class="ev-blink">:</span><?php echo e(date('i', strtotime($course->start_time))); ?> -   <?php echo e(date('H', strtotime($course->end_time))); ?> <span class="ev-blink">:</span> <?php echo e(date('i', strtotime($course->end_time))); ?></span>
                                                <span class="event-duration"><?php echo e($course->clss_duration??''); ?></span>
                                            </div>
                                            <h3 class="event-title"><?php echo e($course->title??''); ?></h3>
                                        </div>
                                    </a>
                                </li>  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </ul>
                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
   /*--------------------------------
     # CALENDER
    ------------------------------------*/
    $(document).ready(function() {
        var my_calendar = $("#dncalendar-container").dnCalendar({
            minDate: "<?php echo e(date('Y')); ?>-01-01",
            maxDate: "<?php echo e(date('Y')); ?>-12-31",
            defaultDate: "<?php echo e(date('Y-m')); ?>-01",
            monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ], 
            monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des' ],
            dayNames: [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            dayNamesShort: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa' ],
            dataTitles: { defaultDate: 'default', today : 'today' },
            notes: <?php echo $note??null; ?>, 
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
            var url = "<?php echo e(route('ajax_curse')); ?>";
            var data = {
                'course_date':date,
                '_token':'<?php echo e(csrf_token()); ?>',
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/pages/index.blade.php ENDPATH**/ ?>