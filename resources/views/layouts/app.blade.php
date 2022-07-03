<!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vokabel Trainer - System edition</title>

    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <link rel="stylesheet" href="/css/notiflix.min.css">

    @livewireStyles
    <script src="/js/notiflix.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/decoupled-document/ckeditor.js"></script> --}}
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                @if ($back)
                    <li>
                        <a href="{{ $back }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/arrow-back</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                            ZURÜCK
                        </a>
                    </li>
                @endif
                <li><strong>Mailer</strong></li>
                @auth
                    <li><a href="{{ route('home') }}" {!! $is_active(request()->routeIs('home')) !!}>Home</a></li>
                    <li><a href="{{ route('book.index') }}" {!! $is_active(request()->routeIs('book.*')) !!}>Bücher</a></li>
                    {{-- <li><a href="{{ route('user.index') }}" {!! $is_active(request()->routeIs('user.*')) !!}>Benutzer</a></li> --}}
                @else
                    <li><a href="{{ route('welcome') }}" {!! $is_active(request()->routeIs('welcome')) !!}>Home</a></li>
                @endauth
            </ul>
            <ul>
                @auth
                    <li><a href="{{ route('logout') }}" {!! $is_active(request()->routeIs('logout')) !!}>Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}" {!! $is_active(request()->routeIs('login')) !!}>Login</a></li>
                    <li><a href="{{ route('register') }}" {!! $is_active(request()->routeIs('register')) !!}>Registrieren</a></li>
                @endauth
            </ul>
        </nav>
        {{-- <nav aria-label="breadcrumb">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>
        </nav> --}}
    </div>
    <div class="container">
        @if ($message = session('error'))
            <article class="bg-red">{!! $message !!}</article>
        @endif
        @if ($message = session('success'))
            <article class="bg-green">{!! $message !!}</article>
        @endif
        @if ($message = session('info'))
            <article class="bg-blue">{!! $message !!}</article>
        @endif

        {{ $slot }}
    </div>

    @livewireScripts
    <script>
        Notiflix.Notify.init({
            width: '240px',
            position: 'right-top',
        });

        Livewire.on('msg.success', message => {
            Notiflix.Notify.success(message);
        })
        Livewire.on('msg.faliture', message => {
            Notiflix.Notify.faliture(message);
        })
        Livewire.on('msg.warning', message => {
            Notiflix.Notify.warning(message);
        })
        Livewire.on('msg.info', message => {
            Notiflix.Notify.info(message);
        })

        Livewire.on('loading', function(){
            Notiflix.Loading.circle('Loading...', {
                clickToClose: true,
            });
        });
    </script>
    @stack('js')
</body>
</html>
