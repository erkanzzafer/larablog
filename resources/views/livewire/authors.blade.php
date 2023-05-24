<div>

<div class="container-xl">
    <div class="row g-2 align-items-center">

      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none mb-2">
        <div class="d-flex">

          <a href="{{route('author.addAuthor')}}" class="btn btn-primary" >
            New Author

          </a>
        </div>
      </div>
    </div>
  </div>

  @forelse ($authors as $author )
  <div class="row row-cards">
    <div class="col-md-6 col-lg-3">
      <div class="card">
        <div class="card-body p-4 text-center">
          <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg)"></span>
          <h3 class="m-0 mb-1"><a href="#">{{$author->name}}</a></h3>
          <div class="text-muted">{{$author->email}}</div>
          <div class="mt-3">
            <span class="badge bg-purple-lt">{{$author->authorType->name}}</span>
          </div>
        </div>
        <div class="d-flex">
          <a href="{{url('author/editAuthor/'.$author->id)}}" class="card-btn">Edit</a>

          <form action="{{ url('author/deleteAuthor/'.$author->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="card-btn">Delete</button>
        </form>



        </div>
      </div>
    </div>
@empty
<span class="text-danger">No Author Found</span>
@endforelse
    </div>
</div>
<div class="row mt-4">
    {{$authors->links('livewire::bootstrap')}}
</div>


