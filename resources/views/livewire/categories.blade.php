<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
                Kategoriler
              </h2>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-3">
            <div class="col-md-8 mb-2">
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <h4>Kategoriler</h4>
                          <li class="nav-item ms-auto">
                            <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#categories_modal">Kategori Ekle</a>
                        </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <p class="text-muted"><div class="col-12">
                            <div class="card">
                              <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                  <thead>
                                    <tr>
                                      <th>Kategori Adı</th>
                                      <th>Alt Kategori Sayısı</th>
                                      <th class="w-1"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse ($categories as $category )


                                    <tr>
                                      <td>{{$category->category_name}}</td>
                                      <td class="text-muted">
                                       {{$category->subcategories->count()}}
                                      </td>
                                      <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-primary" wire:click.prevent='editCategory({{$category->id}})'>Düzenle</a> &nbsp;
                                            <a href="#" class="btn btn-sm btn-danger">Sil</a> &nbsp;
                                        </div>
                                      </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">
                                            <span class="text-danger">No Category Found!</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div></p>
                      </div>
                    </div>
                  </div>
            </div>


      </div>



      <div wire:ignore.self class="modal modal-blur fade" id="categories_modal" tabindex="-1" role="dialog" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" class="modal-content"
        @if ($updateCategoryMode)
            wire:submit.prevent='updateCategory()'
        @else
            wire:submit.prevent='addCategory()'
        @endif
        >
          <div class="modal-header">
            <h5 class="modal-title">{{$updateCategoryMode ? 'Kategori Güncelle' : 'Kategori Ekle'}} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             @if($updateCategoryMode)
                <input type="hidden" wire:model='selected_category_id'>
             @endif
           <div class="mb-3">
                              <label class="form-label">Kategori Adı</label>
                              <input type="text" class="form-control" name="example-text-input" placeholder="Kategori Adı Giriniz." wire:model='category_name'>
                             <span class="text-danger"> @error('category_name')
                                {{$message}}
                              @enderror
                             </span>
                            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-primary">{{$updateCategoryMode ? 'Güncelle' : 'Kaydet'}}</button>
          </div>
        </form >
      </div>
    </div>



    <div wire:ignore.self class="modal modal-blur fade" id="sub_categories" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" class="modal-content"
            @if ($updateSubCategoryMode)
                   wire:submit.prevent='updateSubCategory()'
            @else
                    wire:submit.prevent='addSubCategory()'
            @endif
            >
          <div class="modal-header">
            <h5 class="modal-title">{{$updateSubCategoryMode ? 'Update SubCategory' : 'Add SubCategory'}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if ($updateSubCategoryMode)
                    <input type="hidden" wire:model='selected_subcategory_id'>
            @endif


                         <div class="mb-3">
                              <div class="form-label">Parent Category</div>
                              <select class="form-select" wire:model='parent_category'>
                                @if(!$updateCategoryMode)
                                    <option value="">No Selected</option>
                                @endif
                                @foreach (\App\Models\Category::all() as $category )
                                <option value="{{$category->id}}"> {{$category->category_name}}</option>
                                @endforeach
                              </select>
                              <span class="text-danger">@error('parent_category')
                                {{$message}}
                              @enderror</span>
                         </div>
                         <div class="mb-3">
                            <label class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Enter SubCategory Name" wire:model='subcategory_name'>
                           <span class="text-danger"> @error('subcategory_name')
                              {{$message}}
                            @enderror
                           </span>
                          </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">{{$updateSubCategoryMode ?  'Update' : 'Save'}}</button>
          </div>
        </form>
      </div>
    </div>

</div>
