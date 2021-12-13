<x-app-layout>
  <x-slot name="styles">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gwiazdy.css') }}">
  </x-slot>
  <x-slot name="scripts">
    <script type="text/javascript" src="{{ asset('js/gwiazdy.js') }}"></script>
    {!!
      JsValidator::formRequest('App\Http\Requests\Gwiazdy\GwiazdaRequest');
    !!}    
  </x-slot>
  <div class="container">
    <h1>{{ __('translations.gwiazdy.title') }}</h1>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          @if (isset($edit) && $edit === true)
          {{ __('translations.gwiazdy.labels.edit') }}
          @else
          {{ __('translations.gwiazdy.labels.create') }}
          @endif
        </h5>
        <form id="gwiazda-form" method="POST" 
          @if (isset($edit) && $edit===true)
            action="{{ route('gwiazdy.update', $gwiazda) }}" 
          @else 
            action="{{ route('gwiazdy.store') }}"
          @endif>
          @if (isset($edit) && $edit === true)
          @method('PATCH')
          @endif
          @csrf

          <div class="row mb-3">
            <label for="gwiazda-name" class="col-sm-2 col-form-label">
              {{ __('translations.gwiazdy.attribute.name') }}
            </label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('imie_gwiazdy') is-invalid @enderror" name="imie_gwiazdy"
                id="gwiazda-name" @if (isset($gwiazda)) value="{{ $gwiazda->imie_gwiazdy }}" @else
                value="{{ old('imie_gwiazdy') }}" @endif
                aria-describedby="gwiazda-name-error">
              @error('imie_gwiazdy')
              <span id="gwiazda-name-error" class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="gwiazda-lastname" class="col-sm-2 col-form-label">
              {{ __('translations.gwiazdy.attribute.lastname') }}
            </label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nazwisko_gwiazdy') is-invalid @enderror" name="nazwisko_gwiazdy"
                id="gwiazda-lastname" @if (isset($gwiazda)) value="{{ $gwiazda->nazwisko_gwiazdy }}" @else
                value="{{ old('nazwisko_gwiazdy') }}" @endif
                aria-describedby="gwiazda-lastname-error">
              @error('nazwisko_gwiazdy')
              <span id="gwiazda-lastname-error" class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>

          <div class="d-flex justify-content-end mb-3 ">
            <div class="btn-group" role="group" aria-label="Cancel or submit form">
              <a href="{{ route('gwiazdy.index') }}" type="submit" class="btn btn-secondary">
                {{ __('translations.buttons.cancel') }}
              </a>
              <button type="submit" class="btn btn-primary">
                @if (isset($edit) && $edit === true)
                {{ __('translations.buttons.update') }}
                @else
                {{ __('translations.buttons.store') }}
                @endif
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>