<x-app-layout>
  <x-slot name="styles">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/film.css') }}">
  </x-slot>
  <x-slot name="scripts">
    <script type="text/javascript" src="{{ asset('js/film.js') }}"></script>
    <!-- {!!
      JsValidator::formRequest('App\Http\Requests\Filmy\FilmRequest');
    !!}     -->
  </x-slot>
  <div class="container">
    <h1>{{ __('translations.filmy.title') }}</h1>
    <div class="card">
      <div class="card-body">
      <h5 class="card-title">
          @if (isset($edit) && $edit === true)
          {{ __('translations.filmy.labels.edit') }}
          @else
          {{ __('translations.filmy.labels.create') }}
          @endif
        </h5>
        <form id="film-form" method="POST" 
        enctype="multipart/form-data"
          @if (isset($edit) && $edit===true)
            action="{{ route('filmy.update', $film) }}" 
          @else 
            action="{{ route('filmy.store') }}"
          @endif>
          @if (isset($edit) && $edit === true)
          @method('PATCH')
          @endif
          @csrf

          
          <!-- gatunek -->
          <div class="row mb-3">
            <label for="film-type" class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.type') }}
            </label>
            <div class="col-sm-10">
              <select class="form-select select2 @error('gatunek_id')is-invalid @enderror" name="gatunek_id"
              id="film-type" 
              aria-describedby="film-type-error">
                <option></option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}"
                  @if (isset($film))
                    @if( $film->gatunek_id == $type->id ) 
                      selected="selected"
                    @endif
                  @else
                    @if( old('gatunek_id', null) == $type->id ) 
                    selected="selected"
                    @endif
                  @endif  
                  >{{ $type->nazwa_gatunku  }}</option>
                @endforeach
              </select>
              @error('gatunek_id')
              <span id="film-type-error" class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
          <!-- rezyser -->
          <div class="row mb-3">
            <label for="film-director" class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.director') }}
            </label>
            <div class="col-sm-10">
              <select class="form-select select2 @error('gwiazda_id')is-invalid @enderror" name="gwiazda_id"
                id="film-director"                 
                aria-describedby="film-director-error">
                <option></option>
                @foreach ($directors as $director)
                  <option value="{{ $director->id }}"
                  @if (isset($film))
                    @if( $film->gwiazda_id == $director->id ) 
                      selected="selected"
                    @endif
                  @else
                    @if( old('gwiazda_id', null) == $director->id ) 
                      selected="selected"
                    @endif
                  @endif>
                  {{ $director->imie_gwiazdy  }} {{ $director->nazwisko_gwiazdy  }}</option>
                @endforeach
              </select>
              @error('gwiazda_id')
              <span id="film-director-error" class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
          <!-- tytuł -->
          <div class="row mb-3">
            <label for="film-title" class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.title') }}
            </label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tytul')is-invalid @enderror" name="tytul" 
                value="@if (isset($film)){{ $film->tytul }}@else{{ old('tytul') }}@endif" id="film-title">
              @error('tytul')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
          <!-- data premiery -->
          <div class="row mb-3">
            <label for="film-release" class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.release') }}
            </label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('data_premiery')is-invalid @enderror" name="data_premiery"
                id="film-release" value="@if (isset($film)){{ $film->data_premiery }}@else{{ old('data_premiery') }}@endif">
              @error('data_premiery')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
          <!-- opis -->
          <div class="row mb-3">
            <label for="film-descryption" class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.descryption') }}
            </label>
            <div class="col-sm-10">
              <textarea class="form-control @error('opis')is-invalid @enderror" name="opis"
                id="film-descryption" rows="3"
                >@if (isset($film)){{ $film->opis }}@else{{ old('opis') }}@endif</textarea>
              @error('opis')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
          <!-- okładka -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.cover') }}
            </label>
            <div class="col-sm-auto">
            @if ((isset($film) && $film->czyokladka == 1) || old('film-cover-check') == 'true')
                <img id="film-cover-default" src="{{ asset('images/covers/default.jpg') }}" class="img-thumbnail" alt="{{ __('translations.filmy.attribute.cover') }}" width="200" STYLE="display: none !important"/>
                <img id="film-cover-custom" 
                @if (isset($film) && $film->czyokladka == 1) src="{{ asset('/images/covers/'.$film->id.'.jpg') }}" 
                @else
                src="{{ asset('images/covers/default.jpg') }}"
                @endif
                class="img-thumbnail" alt="{{ __('translations.filmy.attribute.cover') }}" width="200"/>
              @else
                <img id="film-cover-default" src="{{ asset('images/covers/default.jpg') }}" class="img-thumbnail" alt="{{ __('translations.filmy.attribute.cover') }}" width="200"/>
                <img id="film-cover-custom" src="{{ asset('images/covers/default.jpg') }}" class="img-thumbnail" alt="{{ __('translations.filmy.attribute.cover') }}" width="200" STYLE="display: none !important"/>
              @endif
            </div>
            <div class="col-sm">
              <div class="form-check">
                <input class="form-check-input" onclick="defaltCover()" type="radio" name="film-cover-check" id="film-cover-check-1" value="false" 
                @if ((!isset($film) &&  old('film-cover-check') != 'true' ) || (isset($film) && $film->czyokladka != 1)) checked @endif>
                <label class="form-check-label" for="film-cover-check-1">
                {{ __('translations.filmy.attribute.default-cover') }}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" onclick="customCover()" type="radio" name="film-cover-check" id="film-cover-check-2" value="true"
                @if ((isset($film) && $film->czyokladka == 1) || old('film-cover-check') == 'true') checked @endif>
                <label class="form-check-label" for="film-cover-check-2">
                {{ __('translations.filmy.attribute.custom-cover') }}
                </label>
              </div>
              <input class="form-control mt-4" type="file" id="film-cover" name="cover" 
              @if ((!isset($film) &&  old('film-cover-check') != 'true' ) || (isset($film) && $film->czyokladka != 1)) disabled STYLE="display: none !important" @endif  accept=".jpg,.png," >
            </div> 
          </div>
          

          <!-- gwiazda java -->
          <div class="row mb-3 ">
            <label for="film-stars" class="col-sm-2 col-form-label">
              {{ __('translations.filmy.attribute.stars') }}
            </label>
            <div class="col-sm-10 row d-flex mx-0 mb-3">
            @for ($i = 1; $i < 6; $i++)

            <!-- STYLE="display: none !important"  -->
            <div id="star_nr{{ $i }}" 
              @if (isset($film))
                @if( count($film->gwiazdy_w_filmie)+1 <= $i ) 
                  STYLE="display: none !important" 
                @endif
              @else
                @if( old('iloscgwiazd', null) <= $i ) 
                  STYLE="display: none !important" 
                @endif
              @endif
            class="col-lg-12 row d-flex justify-content-between mx-0 p-0">
              <div class="col-lg-5 row m-0 p-0 mb-3">
                <label for="film-star-id[{{ $i }}]" class="col-auto my-auto">{{ __('translations.filmy.attribute.star', [ 'nr' => $i ]) }}</label>
                <select class="form-select select2 @error('aktorzy_id.'.($i-1))is-invalid @enderror col" name="aktorzy_id[]"
                  id="film-star-id[{{ $i }}]" 
                  @if (isset($film))
                    @if( count($film->gwiazdy_w_filmie)+1 <= $i ) 
                      disabled 
                    @endif
                  @else
                    @if( old('iloscgwiazd', null) <= $i ) 
                      disabled
                    @endif
                  @endif
                  aria-describedby="film-star-id[{{ $i }}]-error">
                  <option></option>
                  @foreach ($directors as $director)
                    <option value="{{ $director->id }}"
                    @if (isset($film) && $i <= count($film->gwiazdy_w_filmie))
                      @if( $film->gwiazdy_w_filmie[$i-1]->pivot->gwiazda_id == $director->id ) 
                        selected="selected"
                      @endif
                    @else
                      @if( old('aktorzy_id.'.($i-1), null) == $director->id ) 
                        selected="selected"
                      @endif
                    @endif>
                    {{ $director->imie_gwiazdy  }} {{ $director->nazwisko_gwiazdy  }}</option>
                  @endforeach
                </select>
                @error('aktorzy_id.'.($i-1))
                <span id="film-star-id[{{ $i }}]-error" class="invalid-feedback" role="alert">
                  {{ $message }}
                </span>
                @enderror
              </div>
              <div class="col-lg-5 row m-0 p-0 mb-3">
                <label  class="col-auto my-auto" for="film-star-role[{{ $i }}]">{{ __('translations.filmy.attribute.stars-as') }}</label>
                <input type="text" 
                id="film-star-role[{{ $i }}]" 
                  @if (isset($film))
                    @if( count($film->gwiazdy_w_filmie)+1 <= $i ) 
                      disabled 
                    @else
                      value="{{ $film->gwiazdy_w_filmie[$i-1]->pivot->rola }}"  
                    @endif
                  @else
                    @if( old('iloscgwiazd', null) <= $i ) 
                      disabled
                    @else
                      value="{{ old('aktorzy_role.'.($i-1)) }}"  
                    @endif
                  @endif
                class="form-control col @error('aktorzy_role.'.($i-1))is-invalid @enderror" name="aktorzy_role[]"              
                id="film-star-role[{{ $i }}]">
                @error('aktorzy_role.'.($i-1))
                  <span id="film-star-role[{{ $i }}]-error" class="invalid-feedback" role="alert">
                   {{ $errors->first('aktorzy_role.'.($i-1)) }}
                  </span>
                @enderror              
              </div>
              <div class="col-sm-auto m-0 p-0 mb-3">
                <button type="button" onclick="deletestar({{ $i }})" class="btn btn-secondary col-auto ms-3">{{ __('translations.buttons.delete-star') }}</button>
              </div>
            </div>
            @endfor
            <div class="d-flex flex-row-reverse m-0 p-0 mb-3">
              <button type="button" onclick="addstar()" class="btn btn-info">{{ __('translations.buttons.store-star') }}</button> 
            </div>
            <!-- STYLE="display: none !important" -->
            <input type="number" name="iloscgwiazd" min="1" max="6"  STYLE="display: none !important"
            @if (isset($film))value="{{ count($film->gwiazdy_w_filmie)+1 }}"@else value="{{ old('iloscgwiazd') }}"@endif id="iloscgwiazd"
            >
            </div>
          </div>

                


          <div class="d-flex justify-content-end mb-3 ">
            <div class="btn-group" role="group" aria-label="Cancel or submit form">
              <a href="{{ URL::previous() }}" type="submit" class="btn btn-secondary">
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
<!-- @if (count($errors) > 0)
    <div class="error">
        {{ $errors }}
    </div>
@endif -->
</x-app-layout>


<!-- gwiazda java
<div class="row mb-3">
            <label for="film-stars" class="col-sm-2 col-form-label pt-3">
              {{ __('translations.filmy.attribute.stars') }}
            </label>
            @for ($i = 1; $i < 6; $i++)
            <div class="col-sm-10 row container my-2">
              <label for="film-star[]" class="col-sm-2 col-form-label my-2 mx-0">
                {{ __('translations.filmy.attribute.star', [ 'nr' => $i ]) }}
              </label>
              <div class="col-sm-10">
                <select class="form-select @error('aktorzy_id[]')is-invalid @enderror" name="aktorzy_id[]"
                  id="film-star[]" 
                  data-placeholder="{{ __('translations.labels.select2-placeholder') }}"
                  aria-describedby="film-star[]-error">
                  <option></option>
                  @foreach ($directors as $director)
                    <option value="{{ $director->id }}">
                    {{ $director->imie_gwiazdy  }} {{ $director->nazwisko_gwiazdy  }}</option>
                  @endforeach
                </select>
                @error('aktorzy_id[]')
                <span id="film-star[]-error" class="invalid-feedback" role="alert">
                  {{ $message }}
                </span>
                @enderror
              </div>
              <label for="film-star[]" class="col-sm-2 col-form-label">
                {{ __('translations.filmy.attribute.stars-as') }}
              </label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('aktorzy_role[]')is-invalid @enderror" name="aktorzy_role[]" 
                  value="{{ old('aktorzy_role[]') }}" id="film-star[]">
                @error('aktorzy_role[]')
                <span class="invalid-feedback" role="alert">
                  {{ $message }}
                </span>
                @enderror
              </div>
            </div>
            @endfor
          </div> -->