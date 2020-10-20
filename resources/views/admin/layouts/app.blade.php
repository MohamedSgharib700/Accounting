<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!-- BEGIN: Head -->


<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link href="{{ asset('dist/images/favicon.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Dashboard - Midone - Tailwind HTML Admin Template</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('dist/css/app.css')}}" />
    <link rel="stylesheet" href="{{ url('/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- END: CSS Assets-->
</head>
<style>
.page-item.active .page-link {
    z-index: 1;
    color: #c7d2ff;
    background-color: #3151bc;
    border-color: #1c3faa;
    border-radius: 5px;
    margin: 0 5px;
}
.page-item.disabled .page-link {
    z-index: 1;
    color: #c7d2ff;
    background-color: #3151bc !important;
    border-color: #1c3faa;
    border-radius: 5px;
    margin: 0 5px;    
}
.text-xs {
     font-size: 17px !important; 
}

.table td {
    font-size: 18px;
}

</style>
<!-- END: Head -->

<body class="app">
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/white.png') }}">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                <a href="{{route('dashboard')}}"
                    class="{{'dashboard/index'== request()->path() ? 'side-menu--active' : ''}} menu ">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> الرئيسيه </div>
                </a>
            </li>
            <li>
                <a href="{{route('total-report')}}"
                    class="{{'dashboard/total-report'== request()->path() ? 'side-menu--active' : ''}} menu">
                    <div class="menu__icon"> <i data-feather="file-text"></i> </div>
                    <div class="menu__title"> التقارير </div>
                </a>
            </li>
            <li>
                <a href="javascript:;"
                    class="{{'dashboard/amwalBalances'== request()->path() || request()->route()->getName() === 'balances.index'  || request()->route()->getName() === 'balances.discount' ? 'side-menu--active' : ''}} menu">
                    <div class="menu__icon"> <i data-feather="box"></i> </div>
                    <div class="menu__title"> تحويل الارصده <i data-feather="chevron-down"
                            class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{route('amwalBalances.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title">تحويل الرصيد لشركه اموال </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('balances.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> تحويل الرصيد للمناديب </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('balances.discount')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> خصم الرصيد للمناديب
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="credit-card"></i></div>
                    <div class="menu__title"> ارصدة المناديب و العمليات <i data-feather="chevron-down"
                            class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{route('agents.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> رصيد للمناديب </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('transactions.show')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> جميع العمليات </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('transfers.bank')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title">تحويل المندوبين للبنوك </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="trello"></i> </div>
                    <div class="menu__title"> ايرادات و مصروفات الشركه <i data-feather="chevron-down"
                            class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{route('company-revenues-categories')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title">انواع الايرادات</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('company-revenues')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> الايرادات </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('expensesBalanceCategories.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> فئة مصروفات شركة اموال </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('expensesBalances.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> مصروفات شركة اموال</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('treasury')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> الخزينه</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-------------------------->
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                    <div class="menu__title"> اقساط الماكينات <i data-feather="chevron-down"
                            class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{route('contracts.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> انواع اقساط المكينات</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('installments.index')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> الاقساط </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('PosStores')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> عهد اقساط المكينة</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!--------------------------------------------------------------------------->
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
                    <div class="menu__title"> جميع المكينات <i data-feather="chevron-down"
                            class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{route('agents-pos')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> المخازن الفرعيه</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('agent.all.pos.available')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> جميع المكينات الغير مفعله </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('agent.all.pos.customer')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> جميع المكينات المفعله</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('agent.all.pos.returns')}}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> جميع الماكينات المرتجعه</div>
                        </a>
                    </li>




                </ul>
            </li>
            <li>
                <a href="{{route('userCodes')}}" class="menu">
                    <div class="menu__icon"> <i data-feather="edit"></i> </div>
                    <div class="menu__title"> تكويد المناديب </div>
                </a>
            </li>

            <li>
                <a href="{{route('customers.index')}}" class="menu">
                    <div class="menu__icon"> <i data-feather="users"></i> </div>
                    <div class="menu__title"> عملاء الشركه </div>
                </a>
            </li>


        </ul>
        
    </div>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone Tailwind HTML Admin Template" class="" src=" {{ asset('dist/images/white.png') }}">
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{route('dashboard')}}"
                        class="{{'dashboard/index'== request()->path() ? 'side-menu--active' : ''}} side-menu ">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> الرئيسيه </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('total-report')}}"
                        class="{{'dashboard/total-report'== request()->path() ? 'side-menu--active' : ''}} side-menu">
                        <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                        <div class="side-menu__title"> التقارير </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;"
                        class="{{'dashboard/amwalBalances'== request()->path() ? 'side-menu--active' : ''}} side-menu">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> تحويل الارصده <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('amwalBalances.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">تحويل الرصيد لشركه اموال </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('balances.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> تحويل الرصيد للمناديب </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('balances.discount')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> خصم الرصيد للمناديب
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="credit-card"></i></div>
                        <div class="side-menu__title"> ارصدة المناديب و العمليات <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('agents.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> رصيد للمناديب </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('transactions.show')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> جميع العمليات </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('transactions.failed.show')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> جميع العمليات الفاشله </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('transfers.bank')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">تحويل المندوبين للبنوك </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('agent.all.pos.to.refund')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">سحب رصيد الماكينات </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
                        <div class="side-menu__title"> ايرادات و مصروفات الشركه <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('company-revenues-categories')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">انواع الايرادات</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('company-revenues')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> الايرادات </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('expensesBalanceCategories.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> فئة مصروفات شركة اموال </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('expensesBalances.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> مصروفات شركة اموال</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('treasury')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> الخزينه</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-------------------------->
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> اقساط الماكينات <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('contracts.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> انواع اقساط المكينات</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('installments.index')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> الاقساط </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('PosStores')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> عهد اقساط المكينة</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--------------------------------------------------------------------------->
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title"> جميع المكينات <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('agents-pos')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> المخازن الفرعيه</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('agent.all.pos.available')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> جميع المكينات الغير مفعله </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('agent.all.pos.customer')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> جميع المكينات المفعله</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('agent.all.pos.returns')}}" class="side-menu">
                                <div class="menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="menu__title"> جميع الماكينات المرتجعه</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('agent.all.pos.two.agents')}}" class="side-menu">
                                <div class="menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="menu__title"> جميع الماكينات المفعله ولها مندوب سابق</div>
                            </a>
                        </li>
                    </ul>
                </li>



                <li>
                    <a href="{{route('userCodes')}}"
                        class="{{'dashboard/userCodes'== request()->path() ? 'side-menu--active' : ''}} side-menu">
                        <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
                        <div class="side-menu__title"> تكويد المناديب </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('customers.index')}}"
                        class="{{'dashboard/customers'== request()->path() ? 'side-menu--active' : ''}} side-menu">
                        <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="side-menu__title"> عملاء الشركه </div>
                    </a>
                </li>

                <li>
                    <a href="{{route('daily-commissions')}}"
                        class="{{'dashboard/daily-commissions'== request()->path() ? 'side-menu--active' : ''}} side-menu">
                        <div class="side-menu__icon"> <i data-feather="plus"></i> </div>
                        <div class="side-menu__title">  العمولات اليوميه  </div>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                    <a href="" class="m-2">Amwal</a>
                    <a href="{{ route('logout') }}" class="dropdown-item text-theme-6 m-2" style="display:flex;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i i data-feather="log-out" class="mx-auto text-theme-6 "></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        تسجيل خروج
                    </a>
                </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Search -->

                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            <div class="grid grid-cols-12 gap-6">
                @yield('content')
            </div>
        </div>
        <!-- END: Content -->
    </div>
    <!-- BEGIN: JS Assets-->
    <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="{{ url('/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('dist/js/app.js')}}"></script>
    @yield('script')
    <!-- END: JS Assets-->
</body>

</html>