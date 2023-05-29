<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{

    use WithPagination;
    public $perPage=5   ;
    public $search=null;
    public $author=null;
    public $category=null;
    public $order_by='desc';

    public function mount(){
        $this->resetPage();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingCategory(){
        $this->resetPage();
    }

    public function updatingAuthor(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.all-posts',[
            'posts' =>auth()->user()->type ==1 ?
                             Post::search(trim($this->search))
                             ->with('subcategories')->paginate($this->perPage) :
                             Post::where('author_id',auth()->id())->paginate($this->perPage)
        ]);
    }
}
