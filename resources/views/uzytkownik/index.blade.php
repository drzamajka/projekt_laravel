<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/uzytkownik.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/uzytkownik.js') }}"></script>
    </x-slot>      
    <div class="container">
        <div class="d-flex flex-row-reverse bd-highlight">
          <div class="btn-group" role="group">
            <a class="btn btn-secondary" data-toggle="collapse" href="{{ route('home') }}" role="button" aria-expanded="false" aria-controls="collapseExample">
              {{ __('translations.buttons.return') }}
            </a>
            @if (auth()->user()->hasRole('user') && !auth()->user()->hasRole('creator'))
            <x-confirm
                  :action="route('uzytkownik.upgrade', Auth::user())" method="GET"
                  :confirm-text="__('translations.buttons.yes')" confirm-class="btn btn-danger me-2"
                  :cancel-text="__('translations.buttons.no')" cancel-class="btn btn-secondary ms-2"
                  icon="question"
                  :message="__('translations.urzytkownik.labels.upgrade-question' )" 
                  button-class="btn btn-primary" :button-title="__('translations.buttons.upgrade')">
                  {{ __('translations.buttons.upgrade') }}
            </x-confirm>
            @endif
          </div>
        </div>
        <div class="row py-4">
          <div class="col-sm-4 pe-5" >
              @if($uzytkownik->czyokladka == 1)
                <img src="{{ asset('images/avatars/$uzytkownik->id.jpg') }}" class="img-thumbnail" alt="{{__('translations.filmy.attribute.custom-cover')}}" width="100%">
              @else  
                <img src="{{ asset('images/avatars/blank.png') }}" class="img-thumbnail" alt="{{__('translations.filmy.attribute.default-cover')}}" width="100%" >
              @endif
          </div>
          <div class="col-sm-auto themed-grid-col">
            <p class="heading 6 d-inline">{{$uzytkownik->id}}</p>
            <p class="display-5 d-inline">{{$uzytkownik->name}}</p>
            <p class="mt-3">{{ __('translations.urzytkownik.labels.e-mail') }}: {{$uzytkownik->email}}</p>
            <div class="d-flex gap-3">
              <p>{{ __('translations.urzytkownik.labels.role') }}:</p>
              <div>
                @forelse ($uzytkownik->getRoleNames() as $Role)
                <p class="p-0 m-0">{{$Role}}</p>
                @empty
                  <p>{{ __('translations.filmy.attribute.stars-empty') }}</p>
                @endforelse
              </div>
            </div>
          </div>
        </div>


        
        </div>
          <p>{{ __('translations.attribute.created_at' ) }}: {{$uzytkownik->created_at}}</p>
          <p>{{ __('translations.attribute.updated_at' ) }}: {{$uzytkownik->updated_at}}</p>
          <p>{{ __('translations.attribute.deleted_at' ) }}: {{$uzytkownik->deleted_at}}</p>
    </div>

</x-app-layout>
