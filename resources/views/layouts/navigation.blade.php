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
      <li class="nav-item">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
          {{ __('translations.dashboard.dashboard') }}
        </x-nav-link>
      </li>            
      <li class="nav-item">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
          {{ __('translations.dashboard.home') }}
        </x-nav-link>
      </li>   
      @can('log-viewer') 
      <li class="nav-item">
        <x-nav-link :href="route('log-viewer::dashboard')">
            {{ __('translations.menu.log-viewer') }}
        </x-nav-link>
      </li>             
      @endcan        
      <li class="nav-item">
        <x-nav-link class="disabled" aria-disabled="true">
          {{ __('translations.dashboard.disabled') }}
        </x-nav-link>
      </li>
    </ul>
    <div class="navbar-nav dropdown">
      <a href="#" class="nav-link dropdown-toggle" id="profile" 
          data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{url('/images/avatars/blank.png')}}" alt="USER_NAME" width="32" height="32" class="rounded-circle">
        {{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="profile">
        <li><a class="dropdown-item disabled" href="#" aria-disabled="true">{{ __('translations.dashboard.settings') }}</a></li>
        <li><a class="dropdown-item disabled" href="#" aria-disabled="true">{{ __('translations.dashboard.profile') }}</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}">{{ __('translations.dashboard.log-out') }}</a></li>
      </ul>
      </div>        
    </div>
  </div>
</nav>