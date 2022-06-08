<?php ($sigment_parent = Request::segment(2)); ?>
<?php ($sigment_sub = Request::segment(3)); ?>
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item <?php echo e(Request::segment(1) =='secure-admin'?'m-menu__item--active':''); ?>" aria-haspopup="true">
                <a href="<?php echo e(route('dashboard')); ?>" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Dashboard</span>
                        </span>
                    </span>
                </a>
            </li>

            

            <?php if(auth()->user()->can('post-list') || auth()->user()->can('post-create') || auth()->user()->can('post-edit') || auth()->user()->can('post-delete')): ?>
            <li class="m-menu__item m-menu__item--submenu  <?php if($sigment_parent =='posts' || $sigment_parent =='categories'): ?> m-menu__item--open <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Category</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        
                        <li class="m-menu__item <?php if($sigment_parent =='categories'): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('categories.index')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Categories</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <?php endif; ?>

            
           
            
         
            <?php if(auth()->user()->can('course-list') || auth()->user()->can('course-edit')): ?>
            <li class="m-menu__item m-menu__item--submenu <?php if($sigment_parent =='courses' || $sigment_parent =='course-types' || $sigment_parent =='locations' || $sigment_parent =='instructors'): ?> m-menu__item--open  <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Location</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item <?php if($sigment_parent =='locations'): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('locations.create')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add Location</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            <?php endif; ?>
            

            
            
            <?php if(auth()->user()->can('booking-list') || auth()->user()->can('booking-edit')): ?>
            <li class="m-menu__item m-menu__item--submenu <?php if($sigment_parent =='bookings'): ?> m-menu__item--open  <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Equipments</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav"> 
                        <li class="m-menu__item <?php if($sigment_parent =='bookings'): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('equipments.create')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add Equipment</span>
                            </a>
                        </li>
                        <li class="m-menu__item <?php if($sigment_parent =='bookings' && $sigment_sub =='list'): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('equipments.index')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View Equipments</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            <?php endif; ?> 
          
            

            
           



            <?php if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete')): ?>
            <li class="m-menu__item m-menu__item--submenu  <?php if($sigment_parent =='news'): ?> m-menu__item--open <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Quotation List</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        
                        <li class="m-menu__item <?php if($sigment_parent =='news' && $sigment_sub ==''): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('quotations.index')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View List</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endif; ?> 

            <?php if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete')): ?>
            <li class="m-menu__item m-menu__item--submenu  <?php if($sigment_parent =='news'): ?> m-menu__item--open <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Vendor Item</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item <?php if($sigment_parent =='news' && $sigment_sub ==''): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Vendor Equipment List</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <?php endif; ?> 

            <?php if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete')): ?>
            <li class="m-menu__item m-menu__item--submenu  <?php if($sigment_parent =='news'): ?> m-menu__item--open <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Customer Query</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item <?php if($sigment_parent =='news' && $sigment_sub ==''): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Customer Request</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endif; ?> 

            <?php if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete')): ?>
            <li class="m-menu__item m-menu__item--submenu  <?php if($sigment_parent =='news'): ?> m-menu__item--open <?php endif; ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Blogs</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item <?php if($sigment_parent =='news' && $sigment_sub ==''): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('posts.create')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New</span>
                            </a>
                        </li>
                        <li class="m-menu__item <?php if($sigment_parent =='news' && $sigment_sub =='create'): ?> m-menu__item--active <?php endif; ?>" aria-haspopup="true">
                            <a href="<?php echo e(route('news.create')); ?>" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View Blogs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endif; ?> 



           
 
 
            


            

            
        </ul>
    </div>
<!-- END: Aside Menu -->
</div><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/includes/backend/sidebar.blade.php ENDPATH**/ ?>