<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/gatunki.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/gatunki.js') }}"></script>
    </x-slot>      
    <div class="container">
      <h1 class="display-6">{{ __('translations.gatunki.title') }}</h1>
      <div class="d-flex flex-row-reverse mb-4">
      </div> 
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('translations.gatunki.attribute.name') }}</th>
            <th>{{ __('translations.gatunki.attribute.count_filmy' ) }}</th>
            <th>{{ __('translations.attribute.created_at' ) }}</th>
            <th>{{ __('translations.attribute.updated_at' ) }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($gatunki as $kategoria) 
          <tr>
            <td>{{ $kategoria->id }}</td>
            <td>{{ $kategoria->nazwa_gatunku }}</td>
            <td>{{ $kategoria->filmy_count }}</td>
            <td>{{ $kategoria->created_at }}</td>
            <td>{{ $kategoria->updated_at }}</td>
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
