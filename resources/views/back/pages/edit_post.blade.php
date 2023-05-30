@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ürün Ekle')
@section('content')
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
        Ürün Düzenle
      </h2>
    </div>
  </div>

  <form action="{{route('author.posts.updatePost',['post_id' =>Request('post_id')])}}" method="post"  id="editPostForm" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="" class="form-label">Sayfa Başlığı</label>
                        <input type="text"  class="form-control" name="sayfa_baslik" placeholder="Enter Post Title" value="{{$post->post_title}}">
                        <span class="text-danger error-text sayfa_baslik_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sayfa İçeriği <span class="form-label-description">56/100</span></label>
                        <textarea class="ckeditor form-control" name="sayfa_icerik" id="sayfa_icerik" rows="6" placeholder="Content..">{!!$post->post_content!!}</textarea>
                        <span class="text-danger error-text sayfa_icerik_error"></span>
                    </div>
                      <div class="mb-3">
                        <div class="form-label">Kategori Seçimi</div>
                        <select class="form-select" name="sayfa_kategori">
                          <option value="">Seçim Yapınız</option>
                            @foreach (\App\Models\Subcategory::all() as $subcategory )
                                    <option value="{{$subcategory->id}}" {{$subcategory->id == $post->category_id ? 'selected' : ''}}>{{$subcategory->subcategory_name}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger error-text sayfa_kategori_error"></span>
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">SEO Başlık</label>
                        <input type="text"  class="form-control" name="seo_baslik" placeholder="Enter Post Title" value="{{$post->seo_baslik}}">
                        <span class="text-danger error-text seo_baslik_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">SEO Etiket</label>
                        <input type="text"  class="form-control" name="seo_etiket" placeholder="Enter Post Title" value="{{$post->seo_etiket}}">
                        <span class="text-danger error-text seo_etiket_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">SEO İçerik</label>
                        <input type="text"  class="form-control" name="seo_icerik" placeholder="Enter Post Title" value="{{$post->seo_icerik}}">
                        <span class="text-danger error-text seo_icerik_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Video</label>
                        <input type="text"  class="form-control" name="video" placeholder="Video Url giriniz" value="{{$post->video}}">
                        <span class="text-danger error-text video_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Barkod</label>
                        <input type="text"  class="form-control" name="barkod" placeholder="Barkod Giriniz" value="{{$post->barkod}}">
                        <span class="text-danger error-text barkod_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Fiyat</label>
                        <input type="text"  class="form-control" name="fiyat" placeholder="Fiyat Giriniz" value="{{$post->fiyat}}">
                        <span class="text-danger error-text fiyat_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">İndirimli Fiyat</label>
                        <input type="text"  class="form-control" name="fiyat_indirimli" placeholder="İndirimli Fiyat Giriniz" value="{{$post->fiyat_indirimli}}">
                        <span class="text-danger error-text fiyat_indirimli_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Stok Kodu</label>
                        <input type="text"  class="form-control" name="stok_kodu" placeholder="Stok Kodu Giriniz" value="{{$post->stok_kodu}}">
                        <span class="text-danger error-text stok_kodu_error"></span>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">Görsel</div>
                        <input type="file" class="form-control" name="sayfa_gorsel">
                        <span class="text-danger error-text sayfa_gorsel_error"></span>
                    </div>
                    <div class="image_holder mb-2" style="max-width: 250px" >
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img='/back/images/post_images/{{$post->sayfa_gorsel}}'>
                    </div>
                    <button type="submit" class="btn btn-primary">Ürün Güncelle</button>
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


        $('input[type="file"][name="sayfa_gorsel"]').ijaboViewer({
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
    $('form#editPostForm').on('submit',function(e){
    e.preventDefault();
    toastr.remove();
    var post_content = CKEDITOR.instances.sayfa_icerik.getData();
    var form=this;
    //var post_content = document.getElementById('sayfa_icerik').value;
    var fromdata=new FormData(form);
        fromdata.append('sayfa_icerik',post_content);
    $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:fromdata,
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){
            $(form).find('span.error-text').text('');
        },

        success:function(response){
            if(response.code==1){
                toastr.success(response.msg);

            }else{
                toastr.error(response.msg)
            }

        },

        error:function(response){
            console.log(response);
            toastr.remove();
            $.each(response?.responseJSON?.errors,function(prefix,val){
                $(form).find('span.'+prefix+'_error').text(val[0]);
            });
        }
       });
     });


    });
</script>
@endpush
