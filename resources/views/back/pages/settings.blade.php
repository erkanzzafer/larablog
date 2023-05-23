@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Settings')
@section('content')
<div class="row align-items-center">
    <div class="col">
        <h2 class="page-title">
            Settings
        </h2>
    </div>
</div>

<div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">General Settings</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Logo & Favicon</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Social Media</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
          <div>
            @livewire('author-general-setting')
          </div>
        </div>
        <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
          <div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Set Blog Logo</h3>
                    <div class="mb-2" style="max-width:200px">
                    <img src="" alt="" class="img-thumbnail" id="logo-image-preview" data-ijabo-default-img="{{\App\Models\Setting::find(1)->blog_logo}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{route('author.change-blog-logo')}}" method="POST" id="changeBlogLogoForm">
                        @csrf
                    <div class="mb-2">
                        <input type="file" name="blog_logo" class="form-control">
                    </div>
                    <button class="btn btn-primary">Change Logo</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h3>Set Blog Logo</h3>
                    <div class="mb-2" style="max-width:200px">
                    <img src="" alt="" class="img-thumbnail" id="logo-image-preview" data-ijabo-default-img="{{\App\Models\Setting::find(1)->blog_logo}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{route('author.change-blog-logo')}}" method="POST" id="changeBlogLogoForm">
                        @csrf
                    <div class="mb-2">
                        <input type="file" name="blog_logo" class="form-control">
                    </div>
                    <button class="btn btn-primary">Change Logo</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
          <h4>Activity tab</h4>
          <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $('input[name="blog_logo"]').ijaboViewer({
        preview:'#logo-image-preview',
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

            $('#changeBlogLogoForm').submit(function(e){
                e.preventDefault();
                var form =this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){},
                    success:function(data){
                        toastr.remove();
                        if(data.status==1){

                            toastr.success(data.msg);
                            $(form)[0].reset();
                            Livewire.emit('updateTopHeader');
                        }else{
                            toastr.error(data.msg);
                        }
                    }

                });

            });

  </script>

@endpush
