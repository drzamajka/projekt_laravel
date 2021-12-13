<x-app-layout>
  <x-slot name="styles">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gatunki.css') }}">
  </x-slot>
  <x-slot name="scripts">
    <script type="text/javascript" src="{{ asset('js/gatunki.js') }}"></script>
    {!!
      JsValidator::formRequest('App\Http\Requests\Gatunki\GatunekRequest');
    !!}    
  </x-slot>
  <div class="container">
    <h1>{{ __('translations.gatunki.title') }}</h1>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          @if (isset($edit) && $edit === true)
          {{ __('translations.gatunki.labels.edit') }}
          @else
          {{ __('translations.gatunki.labels.create') }}
          @endif
        </h5>
        <form id="gatunek-form" method="POST" 
          @if (isset($edit) && $edit===true)
            action="{{ route('gatunki.update', $gatunek) }}" 
          @else 
            action="{{ route('gatunki.store') }}"
          @endif>
          @if (isset($edit) && $edit === true)
          @method('PATCH')
          @endif
          @csrf

          <div class="row mb-3">
            <label for="gatunek-name" class="col-sm-2 col-form-label">
              {{ __('translations.gatunki.attribute.name') }}
            </label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nazwa_gatunku') is-invalid @enderror" name="nazwa_gatunku"
                id="gatunek-name" @if (isset($gatunek)) value="{{ $gatunek->nazwa_gatunku }}" @else
                value="{{ old('nazwa_gatunku') }}" @endif
                aria-describedby="gatunek-name-error">
              @error('nazwa_gatunku')
              <span id="gatunek-name-error" class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>

          <div class="d-flex justify-content-end mb-3 ">
            <div class="btn-group" role="group" aria-label="Cancel or submit form">
              <a href="{{ route('gatunki.index') }}" type="submit" class="btn btn-secondary">
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