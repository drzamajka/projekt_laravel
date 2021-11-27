<x-app-layout> 
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/filmy.css') }}">
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/filmy.js') }}"></script>
    </x-slot>      
    <div class="container">
      <h1 class="display-6">{{ __('translations.filmy.title') }}</h1>
      <div class="d-flex flex-row-reverse mb-4">
      </div> 
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('translations.filmy.attribute.type') }}</th>
            <th>{{ __('translations.filmy.attribute.director') }}</th>
            <th>{{ __('translations.filmy.attribute.title' ) }}</th>
            <th>{{ __('translations.filmy.attribute.release' ) }}</th>
            <th>{{ __('translations.filmy.attribute.descryption' ) }}</th>
            <th>{{ __('translations.filmy.attribute.cover' ) }}</th>
            <th>{{ __('translations.attribute.created_at' ) }}</th>
            <th>{{ __('translations.attribute.updated_at' ) }}</th>
            <th>{{ __('translations.attribute.deleted_at' ) }}</th>
            <th></th>
          </tr>
        </thead>
      </table>     
    </div>
</x-app-layout>
