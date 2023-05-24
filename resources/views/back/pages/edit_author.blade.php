@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add Author')
@section('content')
<div>
    <form method="post"  action="{{url('author/updateAuthor/'.$user->id)}}" >
        @csrf
        @method('PUT')
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
             <label class="form-label">Name</label>
             <input type="text" class="form-control" name="name" placeholder="Enter Author Name" value="{{$user->name}}" >
             <span class="text-danger">
                 @error('name')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <label class="form-label">Email</label>
             <input type="text" class="form-control" name="email" placeholder="Enter Author Email" value="{{$user->email}}">
             <span class="text-danger">
                 @error('email')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <label class="form-label">UserName</label>
             <input type="text" class="form-control" name="username" placeholder="Enter Author UserName" value="{{$user->username}}">
             <span class="text-danger">
                 @error('username')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <div class="form-label">Select</div>
             <select class="form-select" name='author_type'>
               <option value="">--No Selected--</option>
               @foreach (\App\Models\Type::all() as  $type)
               <option value="{{$type->id}}" {{ $type->id ==$user->type ? 'selected' : '' }}>{{$type->name}}</option>
               @endforeach
             </select>
             <span class="text-danger">
                 @error('author_type')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <div class="form-label">Is Direct Publisher?</div>
             <div>
               <label class="form-check form-check-inline">
                 <input class="form-check-input" type="radio" name="direct_publish" value="0" {{old('direct_publish', $user->direct_publish) == '0' ? 'checked' : '' }}>
                 <span class="form-check-label">{{$user->direct_publish}}</span>
               </label>
               <label class="form-check form-check-inline">
                 <input class="form-check-input" type="radio" name="direct_publish" value="1" {{old('direct_publish', $user->direct_publish) == '1' ? 'checked' : '' }}>
                 <span class="form-check-label">Yes</span>
               </label>
             </div>
             <span class="text-danger">
                 @error('direct_publisher')
                     {{$message}}
                 @enderror
             </span>
           </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-primary">Save</button>
           </div>
     </form>

</div>

@endsection
