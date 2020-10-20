<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'برنامج حسابات شركة اموال') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('dist/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" 
                        src=" {{ asset('dist/images/logo.png') }}">
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="dist/images/illustration.svg">
                    <div class="-intro-x text-dark font-medium text-4xl leading-tight mt-10">
                        خطوات بسيطه
                        <br>
                        لتسجيل الدخول الي حسابك
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 text-white">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-right">
                        تسجيل الدخول
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your
                        account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">


                        <form method="POST" action="{{ route('login') }} " style="color:#4a5568;">
                            @csrf
                            <div class="form-group has-feedback">
                                <input id="email" type="email"
                                    class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="البريد الالكتروني">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <input id="password" type="password"
                                    class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                                    name="password" required autocomplete="current-password" placeholder="كلمه المرور">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit"
                                    class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">دخول</button>

                            </div>
                        </form>





                    </div>

                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <!-- END: JS Assets-->
</body>

</html>