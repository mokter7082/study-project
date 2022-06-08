<h2 class="event-date-title"><?php echo e(date('F d', strtotime($course_date))); ?></h2>
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
</ul><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/pages/ajax_course.blade.php ENDPATH**/ ?>