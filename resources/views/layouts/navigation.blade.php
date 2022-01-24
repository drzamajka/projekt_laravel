<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">
      <x-application-logo width=32 height=32/>
      {{ __('translations.dashboard.title') }}
    </a>
    <button class="navbar-toggler" type="button" 
        data-bs-toggle="collapse" data-bs-target="#navbar" 
        aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">   
      @auth 
        <li class="nav-item">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('translations.dashboard.dashboard') }}
          </x-nav-link>
        </li>   
      @endauth         
      <li class="nav-item">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
          {{ __('translations.dashboard.home') }}
        </x-nav-link>
      </li>       
      @can('gatunki-index') 
      <li class="nav-item">
        <x-nav-link :href="route('gatunki.index')" :active="request()->routeIs('gatunki.index')">
            {{ __('translations.gatunki.title') }}
        </x-nav-link>
      </li>           
      @endcan
      @can('gwiazdy-index') 
      <li class="nav-item">
        <x-nav-link :href="route('gwiazdy.index')"  :active="request()->routeIs('gwiazdy.index')">
            {{ __('translations.gwiazdy.title') }}
        </x-nav-link>
      </li>           
      @endcan         
      @can('log-viewer') 
      <li class="nav-item">
        <x-nav-link :href="route('log-viewer::dashboard')">
            {{ __('translations.dashboard.log-viewer') }}
        </x-nav-link>
      </li>
      @endcan 
    </ul>
    @if (Route::has('login'))
    @auth
    <div class="navbar-nav dropdown">
      <a href="#" class="nav-link dropdown-toggle" id="profile" 
          data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{url('/images/avatars/blank.png')}}" alt="USER_NAME" width="32" height="32" class="rounded-circle">
        {{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="profile">
        <li><a class="dropdown-item" href="{{ route('uzytkownik.index', Auth::user()) }}" >{{ __('translations.dashboard.profile') }}</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}">{{ __('translations.dashboard.log-out') }}</a></li>
      </ul>
      </div>
      @else
      <div class="navbar-nav dropdown">
        <li class="nav-item">
          <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
              {{ __('auth.buttons.login') }}
          </x-nav-link>
        </li> 
          @if (Route::has('register'))
          <li class="nav-item">
            <x-nav-link :href="route('register')"  :active="request()->routeIs('register')">
                {{ __('auth.buttons.register') }}
            </x-nav-link>
          </li> 
          @endif
      </div>    
      @endauth
      @endif        
    </div>
  </div>
</nav>