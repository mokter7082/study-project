@php($sigment_parent = Request::segment(2))
@php($sigment_sub = Request::segment(3))
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item {{ Request::segment(1) =='secure-admin'?'m-menu__item--active':'' }}" aria-haspopup="true">
                <a href="{{route('dashboard')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Dashboard</span>
                        </span>
                    </span>
                </a>
            </li>

            {{-- @if(auth()->user()->can('page-list') || auth()->user()->can('page-create') || auth()->user()->can('page-edit') || auth()->user()->can('page-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='pages') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Seiten</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav"> 
                        <li class="m-menu__item @if($sigment_parent =='pages' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('pages.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Erstellen</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='pages' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('pages.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Seiten</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif --}}

            @if(auth()->user()->can('post-list') || auth()->user()->can('post-create') || auth()->user()->can('post-edit') || auth()->user()->can('post-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='posts' || $sigment_parent =='categories') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Category</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        {{-- <li class="m-menu__item @if($sigment_parent =='posts' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('posts.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">All contributions</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='posts' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('posts.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Create</span>
                            </a>
                        </li>  --}}
                        <li class="m-menu__item @if($sigment_parent =='categories') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('categories.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Categories</span>
                            </a>
                        </li>
                        {{-- <li class="m-menu__item @if($sigment_parent =='tags') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="#" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Tags</span>
                            </a>
                        </li>  --}}
                    </ul>
                </div>
            </li>
            @endif

            {{-- <li class="m-menu__item">
                <a href="{{url('bdrentz-admin/media-file?type=image')}}" target="_blank" class="m-menu__link">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">media</span> 
                </a> 
            </li>  --}}
           
            {{-- @if(auth()->user()->can('course-list') || auth()->user()->can('course-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='courses' || $sigment_parent =='course-types' || $sigment_parent =='locations' || $sigment_parent =='instructors') m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Kurs</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item @if($sigment_parent =='course' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('courses.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Kurse</span>
                            </a>
                        </li>

                        <li class="m-menu__item @if($sigment_parent =='course' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('courses.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue Kurse hinzufügen</span>
                            </a>
                        </li>

                        <li class="m-menu__item @if($sigment_parent =='course-types') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('course-types.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Kurstyp</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='instructors') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('instructors.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Ausbilder</span>
                            </a>
                        </li>

                        <li class="m-menu__item @if($sigment_parent =='locations') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('locations.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Standorte</span>
                            </a>
                        </li> 

                        <li class="m-menu__item @if($sigment_parent =='locations') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="#{{route('locations.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Geschenkgutschein</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            @endif --}}
         
            @if(auth()->user()->can('course-list') || auth()->user()->can('course-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='courses' || $sigment_parent =='course-types' || $sigment_parent =='locations' || $sigment_parent =='instructors') m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Location</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='locations') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('locations.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add Location</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            @endif
            {{-- @if(auth()->user()->can('course-list') || auth()->user()->can('course-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='courses' || $sigment_parent =='course-types' || $sigment_parent =='locations' || $sigment_parent =='instructors') m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Equipments</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='course' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('courses.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add Equipment</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='course' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('courses.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View Equipments</span>
                            </a>
                        </li>

                       

                        <li class="m-menu__item @if($sigment_parent =='course-types') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('course-types.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Kurstyp</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='instructors') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('instructors.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Ausbilder</span>
                            </a>
                        </li>

                        <li class="m-menu__item @if($sigment_parent =='locations') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('locations.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Standorte</span>
                            </a>
                        </li> 

                        <li class="m-menu__item @if($sigment_parent =='locations') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="#{{route('locations.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Geschenkgutschein</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            @endif --}}

            
            {{-- @if(auth()->user()->can('booking-list') || auth()->user()->can('booking-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='bookings') m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Buchungen</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav"> 
                        <li class="m-menu__item @if($sigment_parent =='bookings') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('bookings.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Buchungsanfrage</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='bookings' && $sigment_sub =='list') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('bookings.list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Buchungslisten</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            @endif  --}}
            @if(auth()->user()->can('booking-list') || auth()->user()->can('booking-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='bookings') m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Equipments</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav"> 
                        <li class="m-menu__item @if($sigment_parent =='bookings') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('equipments.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add Equipment</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='bookings' && $sigment_sub =='list') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{ route('equipments.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View Equipments</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </li>
            @endif 
          
            {{-- @if(auth()->user()->can('menu-list') || auth()->user()->can('menu-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='menus')m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Menüs</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav"> 
                        <li class="m-menu__item @if($sigment_parent =='menus') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('admin.menu-list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Erstelle neu</span>
                            </a>
                        </li>  
                    </ul>
                </div>
            </li>
            @endif  --}}

            {{-- @if(auth()->user()->can('contact-list') || auth()->user()->can('contact-edit'))
            <li class="m-menu__item m-menu__item--submenu @if($sigment_parent =='contacts')m-menu__item--open  @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Kontakt</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav"> 
                        <li class="m-menu__item @if($sigment_parent =='contacts') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="#" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Abfragen</span>
                            </a>
                        </li>  
                    </ul>
                </div>
            </li>
            @endif 
  --}}
           {{--  @if(auth()->user()->can('category-list') || auth()->user()->can('category-create') || auth()->user()->can('category-edit') || auth()->user()->can('category-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='categories') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Kategorie</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='categories' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('categories.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Kategorie</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='categories' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('categories.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue hinzufügen</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif --}}



            @if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='news') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Quotation List</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        {{-- <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('quotations.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add Quotation</span>
                            </a>
                        </li> --}}
                        <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('quotations.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View List</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif 

            @if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='news') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Vendor Item</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Vendor Equipment List</span>
                            </a>
                        </li>
                        {{-- <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('news.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue hinzufügen</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            @endif 

            @if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='news') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Customer Query</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Customer Request</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif 

            @if(auth()->user()->can('news-list') || auth()->user()->can('news-create') || auth()->user()->can('news-edit') || auth()->user()->can('news-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='news') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Blogs</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('posts.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='news' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('news.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">View Blogs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif 

{{-- 
            @if(auth()->user()->can('gallery-list') || auth()->user()->can('gallery-create') || auth()->user()->can('gallery-edit') || auth()->user()->can('gallery-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='galleries') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Galerie</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='galleries' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('galleries.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Galerie</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='galleries' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('galleries.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue Galerie</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif 

            @if(auth()->user()->can('widget-list') || auth()->user()->can('widget-create') || auth()->user()->can('widget-edit') || auth()->user()->can('widget-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='widgets') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Widget</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='widgets' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('widgets.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Widgets</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='widgets' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('widgets.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue hinzufügen</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif  --}}

           {{--  @if(auth()->user()->can('comment-list') || auth()->user()->can('comment-create') || auth()->user()->can('comment-edit') || auth()->user()->can('comment-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='comments') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-align-left"></i>
                    <span class="m-menu__link-text">Bemerkungen</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='comments' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('comments.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Kommentare</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='widgets' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('comments.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue hinzufügen</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif  --}}
 
 
            {{-- @if(auth()->user()->can('user-list') || auth()->user()->can('user-create') || auth()->user()->can('user-edit') || auth()->user()->can('user-delete'))
            <li class="m-menu__item m-menu__item--submenu  @if($sigment_parent =='user') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-flask"></i>
                    <span class="m-menu__link-text">Benutzerliste</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='user' && $sigment_sub =='') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('users.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Benutzerlisten</span>
                            </a>
                        </li>
                        <li class="m-menu__item @if($sigment_parent =='user' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('users.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Neue hinzufügen </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif 
 

            @if(auth()->user()->hasRole('Admin') && ( auth()->user()->can('admin-list') ||  auth()->user()->can('admin-create') || auth()->user()->can('admin-edit') || auth()->user()->can('admin-delete')))  
            <li class="m-menu__item  m-menu__item--submenu @if($sigment_parent =='admin' || $sigment_parent =='roles') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Administratorin</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        @can('admin-list')
                        <li class="m-menu__item @if($sigment_parent =='admin') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('admin.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Alle Admin-Liste </span>
                            </a>
                        </li>
                        @endcan
                        <!-- <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{route('admin.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New</span>
                            </a>
                        </li> -->
                        @can('role-list')
                        <li class="m-menu__item  @if($sigment_parent =='roles') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('roles.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text"> Rouls-Liste</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif --}}


            {{-- @if(auth()->user()->hasRole('Admin'))
            <li class="m-menu__item m-menu__item--submenu
                @if($sigment_parent =='settings' || $sigment_parent =='languages'|| $sigment_parent =='newsletters') m-menu__item--open @endif
            " aria-haspopup="true" m-menu-submenu-toggle="hover"> 
             
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                    <span class="m-menu__link-text">Rahmen</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if($sigment_parent =='settings' && $sigment_sub =='create') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('settings.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Systemeinstellung</span>
                            </a>
                        </li> 
                        <li class="m-menu__item @if($sigment_parent =='languages') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('languages.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Sprachen</span>
                            </a>
                        </li>  
                        <li class="m-menu__item @if($sigment_parent =='newsletters') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="#" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Newsletter</span>
                            </a>
                        </li>  
                    </ul>
                </div>
            </li>
            @endif   --}}

            
        </ul>
    </div>
<!-- END: Aside Menu -->
</div>