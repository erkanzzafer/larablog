@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ürün Ekle')
@section('content')
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
        Yeni Sayfa Ekle
      </h2>
    </div>
  </div>

  <form action="{{route('author.posts.createPost2')}}" method="post"  id="addPostForm" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="" class="form-label">Sayfa Başlığı</label>
                        <input type="text"  class="form-control" name="sayfa_baslik" placeholder="Enter Post Title">
                        <span class="text-danger error-text sayfa_baslik_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sayfa İçeriği <span class="form-label-description">56/100</span></label>
                        <textarea class="form-control" name="sayfa_icerik" rows="6" placeholder="Content..">Oh! Come and see the violence inherent in the system! Help, help, I'm being repressed! We shall say 'Ni' again to you, if you do not appease us. I'm not a witch. I'm not a witch. Camelot!</textarea>
                        <span class="text-danger error-text sayfa_icerik_error"></span>
                      </div>
                      <div class="mb-3">
                        <div class="form-label">Kategori Seçimi</div>
                        <select class="form-select" name="sayfa_kategori">
                          <option value="">Seçim Yapınız</option>
                            @foreach (\App\Models\Subcategory::all() as $subcategory )
                                    <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger error-text sayfa_kategori_error"></span>
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">SEO Başlık</label>
                        <input type="text"  class="form-control" name="seo_baslik" placeholder="Enter Post Title">
                        <span class="text-danger error-text seo_baslik_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">SEO Etiket</label>
                        <input type="text"  class="form-control" name="seo_etiket" placeholder="Enter Post Title">
                        <span class="text-danger error-text seo_etiket_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">SEO İçerik</label>
                        <input type="text"  class="form-control" name="seo_icerik" placeholder="Enter Post Title">
                        <span class="text-danger error-text seo_icerik_error"></span>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">Görsel</div>
                        <input type="file" class="form-control" name="sayfa_gorsel">
                        <span class="text-danger error-text sayfa_gorsel_error"></span>
                    </div>
                    <div class="image_holder mb-2" style="max-width: 250px" >
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img=''>
                    </div>
                    <button type="submit" class="btn btn-primary">Ürün Ekle</button>
                </div>
            </div>
        </div>
    </div>



  </form>

@endsection
@push('scripts')

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
    $('form#addPostForm').on('submit',function(e){
    e.preventDefault();
    toastr.remove();

    var form=this;
    var formdata=new FormData(form);
    $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:formdata,
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){
            $(form).find('span.error-text').text('');
        },

        success:function(response){
            if(response.code==1){
                $(form)[0].reset();
                $('div.image_holder').html('');
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
