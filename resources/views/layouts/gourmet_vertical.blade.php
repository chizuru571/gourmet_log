<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
    <div class="vertical">
        <div class="row">
            <div class="col-3 py-4">
                <nav class="nav flex-column navbar-dark navbar-laravel navbar-vertical">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                    <a class="nav-link navbar-brand" href="{{ url('gourmet') }}">
                               <strong> {{ config('app.name', 'Laravel') }} </strong>
                    </a>
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><strong>MENU</strong></a>
                  <a class="nav-link" href="{{ route('gourmet.index') }}">お店リスト</a>
                  <a class="nav-link" href="{{ route('gourmet.add') }}">お店登録/編集</a>
                  <a class="nav-link" href="{{ route('gourmet.category.index') }}">カテゴリー管理</a>
                  <a class="nav-link" href="{{ url('/register') }}">新規登録</a>
                  <a class="nav-link"
                                @guest
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                                @else
                                    <li class="nav-item dropdown">
                                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                         </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('messages.logout') }}
                                            </a>
        
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endguest
                 </a>
                </nav>
           </div>
        <div class="col-8">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        </div>
            </div>
    </body>
</html>