<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IRMD - Interactive Room Map Display</title>


        <!-- Scripts -->
        <script src="{{ asset('build/assets/app.a90aeddc.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.cdnfonts.com/css/ff-unit-pro" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('build/assets/app.c88242eb.css') }}" rel="stylesheet">


        <!--favicon-->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">



        <!-- Zoom for iFrame -->
        <style>
            #wrapSlideShow { width: 600px; height: 390px; padding: 0; overflow: hidden; }
            #slideShow { width: 800px; height: 520px; border: 1px solid black; }
            #slideShow { zoom: 0.75; -moz-transform: scale(0.75); -moz-transform-origin: 0 0; }
        </style>
    </head>
    <body>

    <div id="app">





    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}"><img src="/images/bfhLogoOhneText.png" alt="bfhLogoOhneText" style="height:70px;"></a>
            <a href="{{ url('/') }}"><img src="/images/text_interactiveRoomMapDisplay.png" alt="text_interactiveRoomMapDisplay" style="height:70px;"></a>
            <!--<img src="/images/bfhLogoOhneText.png" alt="bfhLogoOhneText" href="{{ url('/') }}" height="70px">
            <img src="/images/text_interactiveRoomMapDisplay.png" alt="text_interactiveRoomMapDisplay" href="{{ url('/') }}" height="70px">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'IRMD - Interactive Room Map Display') }}
            </a>-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->email }}
                                </a>


                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <a href="javascript:setDefaultDuration()" id="settings_btn"><img src="/images/settings_btn.png" alt="Settings" style="width:76px;height:75px;"></a>
                </ul>
            </div>
        </div>
    </nav>

    </div>























    <div class="container">
        <br><br>
         <h1>Slideshow aktuellster Daten (automatischer Reload):</h1>
         <script type="text/javascript">
             let timer;
             let frames = Array('/slideshow/roomManagement', '/slideShow/mensaRolex', '/slideShow/indoorLocalization');
             let frameIndex = 0;
             let default_duration = 5;
             function refreshSlideshow(){
                 if(timer)
                     clearInterval(timer)
                 timer = setTimeout(refreshSlideshow,default_duration*1000)
                 var iframe = document.getElementById('slideShow');
                 iframe.src=frames[frameIndex++];
                 if (frameIndex === frames.length)
                     frameIndex = 0;
             }

             refreshSlideshow();
         </script>
         <div id="wrapSlideShow">
             <iframe id="slideShow" src="/slideshow/roomManagement" style="scale(0.1)" width="600" height="400">
                <p>Your browser does not support iframes.</p>
             </iframe>
         </div>
         <br>







<br><br><br>
            <h1>PublisherData zur Kontrolle (statisch bei Aufruf):</h1>
                <br>

            <h2>Room Management</h2>
                @if (\App\Http\Controllers\PublisherDataController::getView("room-management") != null)
                    {!! \App\Http\Controllers\PublisherDataController::getView("room-management") !!}
                @else
                    <h3>No Data...</h3>
                @endif

                <br>

            <h2>Mensa Rolex</h2>
                @if (\App\Http\Controllers\PublisherDataController::getView("mensa-rolex") != null)
                    {!! \App\Http\Controllers\PublisherDataController::getView("mensa-rolex") !!}
                @else
                    <h3>No Data...</h3>
                @endif

                <br>

            <h2>Indoor Localization</h2>
                @if (\App\Http\Controllers\PublisherDataController::getView("indoor-localization") != null)
                    {!! \App\Http\Controllers\PublisherDataController::getView("indoor-localization") !!}
                @else
                    <h3>No Data...</h3>
                @endif

    </div>



    <!-- settings_btn -->
    <script type="text/javascript">
        function setDefaultDuration(){
            alert("Hier wird man die Dauer einstellen können \n Momentan bei Page-Reload -> 5 Sekunden");
            default_duration = prompt("Slideshow-Dauer in Sekunden",default_duration);
        }
    </script>
</body>
</html>
