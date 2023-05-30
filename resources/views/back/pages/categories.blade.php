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

    window.addEventListener('deleteCategory',function(event){
        swal.fire({
            title:event.detail.title,
            html:event.detail.html,
            showCloseButton:true,
            showCancelButton:true,
            cancelButtonText:'İptal',
            confirmButtonText:'Sil',
            cancelButtonColor:'#d33',
            confimButtonColor:'#3085d6',
            width:300,
            allowOutsideClick:false,


        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteCategoryAction',event.detail.id );
            }

        });


    });



    </script>




@endpush
