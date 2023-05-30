@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add Author')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div>
    <div class="row">
        <form method="post" action="/author/addsubcategories">
            @csrf
      <div class="modal-header">
        <h5 class="modal-title">Alt Kategori Ekle</h5>

      </div>
      <div class="modal-body">
                     <div class="mb-3">
                          <div class="form-label">Ana Kategori</div>
                          <select class="form-select" name='parent_category'>

                                <option value="">Seçim Yapınız</option>

                            @foreach (\App\Models\Category::all() as $category )
                            <option value="{{$category->id}}"> {{$category->category_name}}</option>
                            @endforeach
                          </select>

                     </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alt Kategori Adı</label>
                        <input type="text" class="form-control" name="subcategory_name" placeholder="Alt kategori adı girin" >
                        <span class="text-danger">

                        </span>
                      </div>

                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                     </div>
                </div>

</div>

@endsection

