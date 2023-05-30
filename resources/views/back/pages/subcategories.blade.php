@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')

<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
              Alt kategoriler
              </h2>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-3">

        <div class="col-md-6 mb-2">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <h4>Alt Kategoriler</h4>
                      <li class="nav-item ms-auto">
                        <a href="{{route('author.addsubcategory')}}" class="btn btn-sm btn-primary">Alt Kategori Ekle</a>
                    </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <p class="text-muted"> <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                              <th>Alt Kategori Adı</th>
                              <th>Kategori Adı</th>
                              <th>Ürün Sayısı</th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach (\App\Models\Subcategory::all() as $subcategory )
                             <tr>
                              <td id="td-{{$subcategory->id}}">{{$subcategory->subcategory_name}}</td>
                              <td class="text-muted">
                              {{$subcategory->category->category_name}}
                              </td>
                              <td class="text-muted">
                                {{$subcategory->posts->count()}}
                               </td>
                              <td>
                                <div class="btn-group">
                                    <a href="{{url('author/editsubcategories/'.$subcategory->id)}}" class="btn btn-sm btn-primary">Düzenle</a> &nbsp;
                                    <button id="myButton"  data-id="{{$subcategory->id}}" class="btn btn-sm btn-danger deneme">Sil</button>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div></p>
                  </div>
                </div>
              </div>
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
                url: 'deletesubcategories/' + id,
                type: 'POST',
                data: {
                        _method: 'DELETE'
                    },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Başarı durumunda işlemleri burada yapabilirsiniz
                    console.log(response.message);
                    // Silinen veriyi UI'dan kaldırmak için gerekli güncellemeleri yapabilirsiniz
                    toastr.success(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Hata durumunda işlemleri burada yapabilirsiniz
                    toastr.error(response.message);
            }

        });
    }
});
});

</script>
@endpush
