<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- カード表示 -->
    @if (Request::is('/'))<meta content='summary_large_image' name='twitter:card'/>
    @else<meta content='summary_large_image' name='twitter:card'/>
    @endif
    <meta content='{{ url('/') }}' name='twitter:domain'/>
    <meta content='{{ url($_SERVER["REQUEST_URI"]) }}' name='twitter:url'/>
    <meta content='@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}' name='twitter:title'/>
    <meta content='{{ env('APP_DESC') }}' name='twitter:description'/>
    @if (Request::is('/'))<meta content='{{ url(env('APP_IMG')) }}' name='twitter:image:src'/>
    @else<meta content='{{ url(null_escape($character->photo, env('APP_IMG'))) }}' name='twitter:image:src'/>
    @endif

    <meta content='{{ url($_SERVER["REQUEST_URI"]) }}' property='og:url'/>
    <meta content='@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}' property='og:title'/>
    <meta content='{{ env('APP_DESC') }}' property='og:description'/>
    @if (Request::is('/'))<meta content='{{ url(env('APP_IMG')) }}' property='og:image'/>
    @else<meta content='{{ url(null_escape($character->photo, env('APP_IMG'))) }}' property='og:image'/>
    @endif


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nsna.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <a class="nav-link" href="http://whyimoeat.blogspot.jp/2017/01/mou-mienai-rpg.html" target="_blank">
                                もう（中略）見えないRPGとは？
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            {{--<li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>--}}
                            {{--<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>--}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="text-center text-muted p-4">
            当サイトは、みんな大好き<s>おのれまさしげ</s> <a href="https://character-sheets.appspot.com/" target="_blank">キャラクターシート倉庫</a>様を大いにパクりつつ作成しました。
        </footer>
    </div>
</body>
</html>
