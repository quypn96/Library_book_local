<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="index.html" class="m-brand__logo-wrapper">
                            <img alt="" src="{{asset('metronic/assets/demo/default/media/img/logo/logo_default_dark.png')}}" />
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch"
                             m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon"><i class="flaticon-search-1"></i></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner ">
                                        <div class="m-dropdown__header">
                                            <form class="m-list-search__form">
                                                <div class="m-list-search__form-wrapper">
                                                    <span class="m-list-search__form-input-wrapper">
                                                        <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
                                                    </span>
                                                    <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                                        <i class="la la-remove"></i>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                                                <div class="m-dropdown__content">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" m-dropdown-toggle="click"
                             m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-alarm">
                                            <span class="count-notification" data-count="{{ count(Auth::user()->unreadNotifications) }}">{{ count(Auth::user()->unreadNotifications) }}</span>
                                        </i>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                                                    <li class="nav-item m-tabs__item">
                                                        <a class="nav-link m-tabs__link active channel" data-channel="{{ Auth::user()->id }}" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
                                                            Notifications
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                                                        <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
                                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                                <div class="m-list-timeline__items notifications">
                                                                    @foreach ($notifications as $key => $value)
                                                                        <a href="{{ route('borrow.show', ['borrow' => $value['data']['borrow_id']]) . '/?notifi_id=' . $value['id'] }}" title="">
                                                                            <div class="m-list-timeline__item item-notification @if ($value['read_at'] != null) clear-background @endif">
                                                                                    <div class="pull-left">
                                                                                        <img src="{{ asset('storage/' . $value['data']['avatar']) }}" alt="" width="45" class="rounded-circle">
                                                                                    </div>
                                                                                    <div class="text">
                                                                                        <span class="m-list-timeline__text align-middle">
                                                                                            <b>{{ $value['data']['user_name'] }}</b> : request borrow book
                                                                                        </span>
                                                                                    </div>
                                                                                <span class="m-list-timeline__time">{{ Helper::diffForHumans($value['created_at']) }}</span>
                                                                            </div>
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
                             m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                    <span class="m-nav__link-icon"><i class="flaticon-share"></i></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
                                            <span class="m-dropdown__header-title">Quick Actions</span>
                                            <span class="m-dropdown__header-subtitle">Shortcuts</span>
                                        </div>
                                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                                            <div class="m-dropdown__content">
                                                <div class="data" data="false" data-height="380" data-mobile-height="200">
                                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                                        <div class="m-nav-grid__row">
                                                            <a href="#" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-file"></i>
                                                                <span class="m-nav-grid__text">Generate Report</span>
                                                            </a>
                                                            <a href="#" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-time"></i>
                                                                <span class="m-nav-grid__text">Add New Event</span>
                                                            </a>
                                                        </div>
                                                        <div class="m-nav-grid__row">
                                                            <a href="#" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-folder"></i>
                                                                <span class="m-nav-grid__text">Create New Task</span>
                                                            </a>
                                                            <a href="#" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-clipboard"></i>
                                                                <span class="m-nav-grid__text">Completed Tasks</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__languages m-dropdown m-dropdown--small m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width" m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-text">
                                        <img class="m-topbar__language-selected-img" src="{{asset('metronic/assets/app/media/img/flags/020-flag.svg')}}">
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url({{asset('metronic/assets/app/media/img/misc/quick_actions_bg.jpg')}}); background-size: cover;">
                                            <span class="m-dropdown__header-subtitle">Select your language</span>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__item m-nav__item--active">
                                                        <a href="#" class="m-nav__link m-nav__link--active">
                                                            <span class="m-nav__link-icon"><img class="m-topbar__language-img" src="{{asset('metronic/assets/app/media/img/flags/020-flag.svg')}}"></span>
                                                            <span class="m-nav__link-title m-topbar__language-text m-nav__link-text">USA</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link">
                                                            <span class="m-nav__link-icon"><img class="m-topbar__language-img" src="{{asset('metronic/assets/app/media/img/flags/015-china.svg')}}"></span>
                                                            <span class="m-nav__link-title m-topbar__language-text m-nav__link-text">China</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                             m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic">
                                        <img src="{{asset('metronic/assets/app/media/img/users/user4.jpg')}}" class="m--img-rounded m--marginless" alt="" />
                                    </span>
                                    <span class="m-topbar__username m--hide">Nick</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />

                                                    <!--
            <span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>
            -->
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">Mark Andre</span>
                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">mark.andre@gmail.com</a>
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
                                                        <a href="header/profile.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
                                                                <span class="m-nav__link-wrap">
                                                                    <span class="m-nav__link-text">My Profile</span>
                                                                    <span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="header/profile.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">Activity</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="header/profile.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">Messages</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="header/profile.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">FAQ</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="header/profile.html" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">Support</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>
