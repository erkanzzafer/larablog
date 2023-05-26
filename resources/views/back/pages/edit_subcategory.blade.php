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
        <form method="post" action="{{url('author/updatesubcategories/'.$subcategory->id)}}">
            @csrf
            @method('PUT')
            <input type="hidden" name="_method" value="PUT">
      <div class="modal-header">
        <h5 class="modal-title">Edit SubCategory</h5>

      </div>
      <div class="modal-body">
                     <div class="mb-3">
                          <div class="form-label">Parent Category</div>
                          <select class="form-select" name='parent_category'>

                                <option value="">No Selected</option>

                            @foreach (\App\Models\Category::all() as $category )
                            <option value="{{$category->id}}" {{ $category->id ==$subcategory->parent_category ? 'selected' : '' }}> {{$category->category_name}}</option>
                            @endforeach
                          </select>

                     </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name" placeholder="Enter Sub Category" value="{{$subcategory->subcategory_name}}" >
                        <span class="text-danger">

                        </span>
                      </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                     </div>
                </div>

</div>

@endsection

