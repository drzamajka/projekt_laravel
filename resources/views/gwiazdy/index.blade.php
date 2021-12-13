<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/gwiazdy.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/gwiazdy.js') }}"></script>
    </x-slot>  
    <div class="d-flex flex-row-reverse bd-highlight">
          @can('gwiazdy-store')
          <a class="btn btn-secondary" data-toggle="collapse" href="{{ route('gwiazdy.create') }}" role="button" aria-expanded="false" aria-controls="collapseExample">
            {{ __('translations.buttons.store') }}
          </a>
          @endcan
    </div>    
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
            <!-- <th>{{ __('translations.gwiazdy.attribute.count_filmy' ) }}</th> -->
            <th>{{ __('translations.attribute.created_at' ) }}</th>
            <th>{{ __('translations.attribute.updated_at' ) }}</th>
            <th>{{ __('translations.attribute.deleted_at' ) }}</th>
            <th></th>
          </tr>
        </thead>
      </table>     
    </div>
</x-app-layout>
