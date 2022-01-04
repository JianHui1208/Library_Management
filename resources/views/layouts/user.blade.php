<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 left-0 px-6 py-4 sm:block">
                        <a href="{{ route('users.bookList') }}" class="text-sm text-gray-500 underline">{{ trans('cruds.bookList.title_singular') }}</a>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-500 underline">{{ trans('cruds.bookCategory.title_singular') }}</a>
                    @auth
                        <a href="{{ route('users.my-book-loan') }}" class="ml-4 text-sm text-gray-500 underline">{{ trans('cruds.bookLoan.title_singular') }}</a>
                    @else
                        
                    @endauth
                </div>
            @endif

            <div class="hidden fixed top-0 px-6 py-4 sm:block">
                @if(count(config('panel.available_languages', [])) > 1)
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="ml-4 text-sm text-gray-500 underline">{{ $langName }}</a>
                    @endforeach
                @endif
            </div>


            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-500 underline">{{ trans('global.home') }}</a>
                        <a href="#" class="ml-4 text-sm text-gray-500 underline" onclick="event.preventDefault(); confirmAlert(); document.getElementById('logoutform').submit();">{{ trans('global.logout') }}</a>
                    @else
                        <a href="{{ route('users.login.show') }}" class="text-sm text-gray-500 underline">{{ trans('global.login') }}</a>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-500 underline">{{ trans('global.register') }}</a>
                    @endauth
                </div>
            @endif

            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

            @yield('content')
        </div>
    </body>
    <script>
        function confirmAlert() {
            confirm("{{ trans('global.areYouSure') }}");
        }
    </script>
</html>
