@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')
@livewire('categories')
@endsection
@push('scripts')
    <script>

    window.addEventListener('hideCategoriesModal',function(e){
        $('#categories_modal').modal('hide');
    });


    window.addEventListener('showCategoriesModal',function(e){
        $('#categories_modal').modal('show');
    });


    window.addEventListener('hideSubcategoriesModal',function(e){
        $('#subcategories_modal').modal('hide');
    });


    </script>




@endpush
