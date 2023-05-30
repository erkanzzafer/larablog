<div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Ara</label>
            <input type="text" class="form-control" placeholder="ara.."  wire:model='search'>
        </div>
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Kategori</label>
            <select name="" class="form-select" id="" wire:model='category'>
                    <option value="">Seçim Yapınız</option>
                    @foreach (\App\Models\Subcategory::whereHas('posts')->get() as $category)
                    <option value="{{$category->id}}">{{$category->subcategory_name}}</option>

                    @endforeach

            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Yazar</label>
            <select name="" class="form-select" id="">
                    <option value="">Seçim Yapınız</option>
                    @foreach (\App\Models\User::whereHas('posts')->get() as $author )
                    <option value="{{$author->id}}">{{$author->name}}</option>
                    @endforeach

            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Sırala</label>
            <select name="" class="form-select" id="" wire:model='orderBy'>
                    <option value="asc">A'dan Z'ye</option>
                    <option value="desc">Z'den A'ya</option>
            </select>
        </div>
    </div>

   <div class="row row-cards">
    @forelse ($posts as $post )
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <img src="\back\images\post_images\{{$post->sayfa_gorsel}}"  class="card-img-top" alt="">
            <div class="card-body p-2">
                <h3 class="m-0 mb-1">{{$post->post_title}}</h3>
                <h5 class="m-0 mb-1">{{$post->subcategories->subcategory_name}}</h5>
            </div>
            <div class="d-flex">
                <a href="{{route('author.posts.editPost',['post_id'=>$post->id])}}" class="card-btn">Edit</a>
                <a href="" wire:click.prevent="deletePost({{$post->id}})" class="card-btn">Delete</a>
            </div>
        </div>
    </div>
    @empty
    <span class="text-danger">Yazı Bulunamadı</span>
    @endforelse

   </div>
   <div class="d-block mt-2">
    {{$posts->links('livewire::bootstrap')}}
   </div>
</div>
