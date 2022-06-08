<header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">
  <div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">
      <!-- BEGIN: Brand -->
      <div class="m-stack__item m-brand  m-brand--skin-dark ">
        <div class="m-stack m-stack--ver m-stack--general">
          <div class="m-stack__item m-stack__item--middle m-brand__logo">
            <a href="<?php echo e(route('dashboard')); ?>" class="m-brand__logo-wrapper">
            <img alt="Logo" src="https://bdrentz.com/images/backend_images/BdRentz-logo.png" />
            </a>
          </div>
          <div class="m-stack__item m-stack__item--middle m-brand__tools">
            <!-- BEGIN: Left Aside Minimize Toggle -->
            <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
            <span></span>
            </a>
            <!-- END -->
            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
            <span></span>
            </a>
            <!-- END -->
             
            <!-- BEGIN: Topbar Toggler -->
            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
            <i class="flaticon-more"></i>
            </a>
            <!-- BEGIN: Topbar Toggler -->
          </div>
        </div>
      </div>
      <!-- END: Brand -->
      <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">              
        <!-- BEGIN: Topbar -->
        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
          <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline"> 
              <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                  <span class="m-topbar__userpic">
                    <?php ($authImg = isset(Auth::user()->image)?Auth::user()->image:'default-user.jpg'); ?>
                    <img src="<?php echo e(asset('images/'.$authImg)); ?>" class="m--img-rounded m--marginless" alt="photo">
                  </span>
                  <span class="m-topbar__username m--hide">
                    <?php if(auth()->check()): ?> 
                      <?php echo e(Auth::user()->name); ?>

                    <?php endif; ?>
                  </span>
                </a>
                <div class="m-dropdown__wrapper">
                  <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                  <div class="m-dropdown__inner">
                    <div class="m-dropdown__header m--align-center">
                      <div class="m-card-user m-card-user--skin-dark">
                        <div class="m-card-user__pic">
                          <img src="<?php echo e(asset('images/'.$authImg)); ?>" class="m--img-rounded m--marginless" alt="" />
                        </div>
                        <div class="m-card-user__details">
                          <span class="m-card-user__name m--font-weight-500">
                            <?php if(auth()->check()): ?> 
                              <?php echo e(Auth::user()->name); ?>

                            <?php endif; ?>
                          </span>
                          <a class="m-card-user__email m--font-weight-300 m-link"><?php echo e(Auth::user()->email??''); ?></a>
                        </div>
                      </div>
                    </div>
                    <div class="m-dropdown__body">
                      <div class="m-dropdown__content">
                        <ul class="m-nav m-nav--skin-light">
                          <li class="m-nav__section m--hide">
                            <span class="m-nav__section-text">Section</span>
                          </li>
                          <li class="m-nav__item">
                            <a href="<?php echo e(route('admin.show', Auth::user()->id)); ?>" class="m-nav__link">
                              <i class="m-nav__link-icon flaticon-profile-1"></i>
                              <span class="m-nav__link-title">
                              <span class="m-nav__link-wrap">
                              <span class="m-nav__link-text">My Profile</span>
                              <span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
                              </span>
                              </span>
                            </a>
                          </li> 
                          <li class="m-nav__separator m-nav__separator--fit">
                          </li>
                          <li class="m-nav__item">
                            <a href="javascript:void(0);" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"  onclick="event.preventDefault();
                            document.getElementById('admin-logout-form').submit();
                            ">Logout</a>
                            <form id="admin-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"> <?php echo e(csrf_field()); ?></form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <!-- <li id="m_quick_sidebar_toggle" class="m-nav__item">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                <span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
        <!-- END: Topbar -->
      </div>
    </div>
  </div>
</header><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/includes/backend/header.blade.php ENDPATH**/ ?>