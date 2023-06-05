@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Yazı Ekle')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
        Yeni Yazı Ekle
      </h2>
    </div>
  </div>

  <form action="{{route('author.texts.updateText',['id' =>$post->id])}}" method="post"  id="editPostForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="" class="form-label">Yazı Başlığı</label>
                        <input type="text"  class="form-control" name="yazi_baslik" placeholder="Enter Post Title" value="{{$post->title}}">
                        @error('yazi_baslik')
                        <span class="text-danger error-text yazi_icerik_error">Gerekli alanları doldurun</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Yazı İçeriği <span class="form-label-description"></span></label>
                        <textarea class="ckeditor form-control" name="yazi_icerik" id="yazi_icerik" rows="10" placeholder="içerik..">{!!$post->content!!}</textarea>
                        <span class="text-danger error-text yazi_icerik_error"></span>
                        @error('yazi_icerik')
                        <span class="text-danger error-text yazi_icerik_error">Gerekli alanları doldurun</span>
                        @enderror
                    </div>
                    <div class="mb-3">

                    </div>
                    <div class="mb-3">
                        <div class="form-label">Görsel</div>
                        <input type="file" class="form-control" name="yazi_gorsel">
                        @error('yazi_gorsel')
                        <span class="text-danger error-text yazi_icerik_error">Gerekli alanları doldurun</span>
                        @enderror
                    </div>

                    <div class="image_holder mb-2" style="max-width: 250px" >
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img='/back/images/text_images/{{$post->photo}}'>
                    </div>
                    <button type="submit" class="btn btn-primary">Yazı Güncelle</button>
                </div>
            </div>
        </div>
    </div>
  </form>

@endsection
@push('scripts')

<script src="/ckeditor/ckeditor.js">

</script>

<script>
    $(function(){


          $('input[type="file"][name="yazi_gorsel"]').ijaboViewer({
          preview:'#image-previewer',
          imageShape:'rectangular',
          allowedExtensions:['jpg','jpeg','png'],
          onErrorShape:function(message,element){
              alert(message);
          },
          onInvalidType: function(message,element){
              alert(message);
          },
          onSuccess:function(message,element){

          }
      });



      });
  </script>

@endpush
