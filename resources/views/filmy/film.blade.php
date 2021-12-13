<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/film.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/film.js') }}"></script>
    </x-slot>      
    <div class="container">
        <div class="d-flex flex-row-reverse bd-highlight">
          <a class="btn btn-secondary" data-toggle="collapse" href="{{ URL::previous() }}" role="button" aria-expanded="false" aria-controls="collapseExample">
            {{ __('translations.buttons.return') }}
          </a>
        </div>
        <p class="display-5 d-inline">{{$film->tytul}}</p>
        <p class="heading 6 mx-3 d-inline">{{date('Y', strtotime($film->data_premiery))}}</p>
        <p class="heading 6">{{ __('translations.filmy.attribute.type') }}: {{$film->gatunek->nazwa_gatunku}}</p>

        <div class="row mb-3">
          <div style="width: 180px;" >
            @if($film->czyokladka == 1)
              <img src="/images/covers/{{$film->id}}.jpg" alt="Domyślna okładka" width="180" height="225">
              <script>toastr.error('działam')</script>
            @else  
              <img src="/images/covers/0.jpg" alt="Domyślna okładka" width="180" height="225">
            @endif
          </div>
          <div class="col-sm-8 themed-grid-col row">
            <div class="p-4 d-flex gap-3 py-1">
              <p>{{ __('translations.filmy.attribute.descryption' ) }}:</p>
              <p>{{$film->opis}}</p>
            </div>
            <div class="p-4 d-flex gap-3 py-1">
              <p>{{ __('translations.filmy.attribute.director') }}:</p>
              <p>{{$film->gwiazda->imie_gwiazdy}} {{$film->gwiazda->nazwisko_gwiazdy}}</p>
            </div>
            <div class="p-4 d-flex gap-3 py-1">
              <p>{{ __('translations.filmy.attribute.stars') }}:</p>
              <div>
                @forelse ($film->gwiazdy_w_filmie as $gwiazda)
                <p class="p-0 m-0">{{$gwiazda->imie_gwiazdy}} {{$gwiazda->nazwisko_gwiazdy}} {{ __('translations.filmy.attribute.stars-as') }} {{$gwiazda->pivot->rola}}</p>
                @empty
                  <p>{{ __('translations.filmy.attribute.stars-empty') }}</p>
                @endforelse
              </div>
            </div>
        </div>
        </div>
          <p>{{ __('translations.attribute.created_at' ) }}: {{$film->created_at}}</p>
          <p>{{ __('translations.attribute.updated_at' ) }}: {{$film->updated_at}}</p>
          <p>{{ __('translations.attribute.deleted_at' ) }}: {{$film->deleted_at}}</p>
    </div>

</x-app-layout>
