<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {!! config('app.name', trans('titles.app')) !!}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto">
            </ul>
            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto">
                {{-- Authentication Links --}}
                @guest
                <li><a class="nav-link" href="{{ route('home') }}">{{ trans('titles.home') }}</a></li>
                {{-- <li><a class="nav-link" href="{{ route('about') }}">{{ trans('titles.about') }}</a></li> --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>
