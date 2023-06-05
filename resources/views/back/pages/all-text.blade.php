@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tüm Yazılar')
@section('content')
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
        Tüm Yazılar
      </h2>
    </div>
  </div>

  <div>



   <div class="row row-cards">
    @forelse ($posts as $post )
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <img src="\back\images\text_images\{{$post->photo}}"  class="card-img-top" alt="">
            <div class="card-body p-2">
                <h3 class="m-0 mb-1">{{$post->title}}</h3>
                <h5 class="m-0 mb-1">{!!$post->content!!}</h5>
            </div>
            <div class="d-flex">
                <a href="{{route('author.texts.editText',['text_id'=>$post->id])}}" class="card-btn">Düzenle</a>
                <a data-id="{{$post->id}}" class="card-btn deneme">Sil</a>
            </div>
        </div>
    </div>
    @empty
    <span class="text-danger">Yazı Bulunamadı</span>
    @endforelse

   </div>
   <div class="d-block mt-2">
    {{$posts->links()}}
   </div>
</div>

@endsection
@push('scripts')
<script>

    $(document).ready(function() {
        $('.deneme').on('click', function() {
            var id = $(this).data('id');
            var confirmation = confirm('Bu veriyi silmek istediğinize emin misiniz?');
            if (confirmation) {
                $.ajax({
                    url: 'deleteText/' + id,
                    type: 'POST',
                    data: {
                            _method: 'DELETE'
                        },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function(response) {
                        toastr.error(response.message);
                    }

            });
        }
    });
    });

    </script>
@endpush
