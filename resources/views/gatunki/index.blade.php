<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/gatunki.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/gatunki.js') }}"></script>
    </x-slot>  
    <div class="d-flex flex-row-reverse bd-highlight">
          @can('gatunki-store')
          <a class="btn btn-secondary" data-toggle="collapse" href="{{ route('gatunki.create') }}" role="button" aria-expanded="false" aria-controls="collapseExample">
            {{ __('translations.buttons.store') }}
          </a>
          @endcan
    </div>      
    <div class="container">
      <h1 class="display-6">{{ __('translations.gatunki.title') }}</h1>
      <div class="d-flex flex-row-reverse mb-4">
      </div> 
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('translations.gatunki.attribute.name') }}</th>
            <!-- <th>{{ __('translations.gatunki.attribute.count_filmy' ) }}</th> -->
            <th>{{ __('translations.attribute.created_at' ) }}</th>
            <th>{{ __('translations.attribute.updated_at' ) }}</th>
            <th>{{ __('translations.attribute.deleted_at' ) }}</th>
            <th></th>
          </tr>
        </thead>
        
      </table>
       
    </div>
</x-app-layout>
