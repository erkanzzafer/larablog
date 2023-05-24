<div>
    <form method="post" wire:submit.prevent='addAuthor()' >
        <div class="mb-3">
             <label class="form-label">Name</label>
             <input type="text" class="form-control" name="example-text-input" placeholder="Enter Author Name" wire:model='name'>
             <span class="text-danger">
                 @error('name')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <label class="form-label">Email</label>
             <input type="text" class="form-control" name="example-text-input" placeholder="Enter Author Email" wire:model='email'>
             <span class="text-danger">
                 @error('email')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <label class="form-label">UserName</label>
             <input type="text" class="form-control" name="example-text-input" placeholder="Enter Author UserName" wire:model='username'>
             <span class="text-danger">
                 @error('username')
                     {{$message}}
                 @enderror
             </span>
           </div>

           <div class="mb-3">
             <div class="form-label">Select</div>
             <select class="form-select" wire:model='author_type'>
               <option value="">--No Selected--</option>
               @foreach (\App\Models\Type::all() as  $type)
               <option value="{{$type->id}}">{{$type->name}}</option>
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
                 <input class="form-check-input" type="radio" name="direct_publisher" value="0" wire:model='direct_publisher'>
                 <span class="form-check-label">No</span>
               </label>
               <label class="form-check form-check-inline">
                 <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model='direct_publisher' >
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
