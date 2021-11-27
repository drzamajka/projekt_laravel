<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/gwiazdy.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/gwiazdy.js') }}"></script>
    </x-slot>      
    <div class="container">
      <h1 class="display-6">{{ __('translations.gwiazdy.title') }}</h1>
      <div class="d-flex flex-row-reverse mb-4">
      </div> 
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('translations.gwiazdy.attribute.name') }}</th>
            <th>{{ __('translations.gwiazdy.attribute.lastname') }}</th>
            <th>{{ __('translations.gwiazdy.attribute.count_filmy' ) }}</th>
            <th>{{ __('translations.attribute.created_at' ) }}</th>
            <th>{{ __('translations.attribute.updated_at' ) }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($gwiazdy as $gwiazda) 
          <tr>
            <td>{{ $gwiazda->id }}</td>
            <td>{{ $gwiazda->imie_gwiazdy }}</td>
            <td>{{ $gwiazda->nazwisko_gwiazdy }}</td>
            <td>{{ $gwiazda->filmy_count }}</td>
            <td>{{ $gwiazda->created_at }}</td>
            <td>{{ $gwiazda->updated_at }}</td>
            <td>
              <div class="btn-group" role="group" aria-label="action buttons">
                
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>     
    </div>
</x-app-layout>
