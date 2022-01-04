<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/film.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/film.js') }}"></script>
    </x-slot>      
    <div class="container">
        <div class="d-flex flex-row-reverse bd-highlight">
          <div class="btn-group" role="group" aria-label="Cancel or submit form">
            @can('update',$film) 
              <a class="btn btn-info" href="{{ route('filmy.edit', $film) }}" title="'.__('translations.film.labels.edit').'" >
              <i class="bi-pencil"></i></a> 
            @endcan 
            @can('delete', $film)
                <x-confirm
                  :action="route('filmy.destroy', $film)" method="DELETE"
                  :confirm-text="__('translations.buttons.yes')" confirm-class="btn btn-danger me-2"
                  :cancel-text="__('translations.buttons.no')" cancel-class="btn btn-secondary ms-2"
                  icon="question"
                  :message="__('translations.filmy.labels.destroy-question', ['name' => $film->tytul] )" 
                  button-class="btn btn-danger" :button-title="__('translations.filmy.labels.destroy')">
                    <i class="bi bi-trash"></i>
                </x-confirm>
              @endcan
              @can('restore', $film)
                <x-confirm
                  :action="route('filmy.restore', $film)" method="PUT"
                  :confirm-text="__('translations.buttons.yes')" confirm-class="btn btn-success me-2"
                  :cancel-text="__('translations.buttons.no')" cancel-class="btn btn-secondary ms-2"
                  icon="question"
                  :message="__('translations.filmy.labels.restore-question', ['name' => $film->tytul] )" 
                  button-class="btn btn-success" :button-title="__('translations.filmy.labels.restore')">
                    <i class="bi bi-trash"></i>
                </x-confirm>               
              @endcan
            <a class="btn btn-secondary" data-toggle="collapse" href="{{ route('home') }}" role="button" aria-expanded="false" aria-controls="collapseExample">
              {{ __('translations.buttons.return') }}
            </a>
          </div>
        </div>
        <p class="display-5 d-inline">{{$film->tytul}}</p>
        <p class="heading 6 mx-3 d-inline">{{date('Y', strtotime($film->data_premiery))}}</p>
        <p class="heading 6">{{ __('translations.filmy.attribute.type') }}: {{$film->gatunek->nazwa_gatunku}}</p>

        <div class="row mb-3">
          <div style="width: 180px;" >
            @if($film->czyokladka == 1)
              <img src="/images/covers/{{$film->id}}.jpg" alt="Domyślna okładka" width="180" height="225">
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
    @if($film->deleted_at == NULL)
      <div>
        @comments(['model' => $film])
      </div>
    @endif

</x-app-layout>
