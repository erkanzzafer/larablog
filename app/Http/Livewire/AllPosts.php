<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class AllPosts extends Component
{

    use WithPagination;
    public $perPage=2   ;
    public $search=null;
    public $author=null;
    public $category=null;
    public $orderBy='desc';
    protected $listeners=[
        'deletePostAction'
    ];
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
                             ->when($this->category,function($query){
                                $query->where('category_id',$this->category);
                             })
                             ->when($this->author,function($query){
                                $query->where('author_id',$this->author);
                             })
                             ->when($this->orderBy,function($query){
                                $query->orderBy('id',$this->orderBy);
                             })
                             ->with('subcategories')->paginate($this->perPage) :
                             Post::where('author_id',auth()->id())->paginate($this->perPage)
                             ->when($this->category,function($query){
                                $query->where('category_id',$this->category);
                             })
                             ->when($this->author,function($query){
                                $query->where('author_id',$this->author);
                             })
                             ->when($this->orderBy,function($query){
                                $query->orderBy('id',$this->orderBy);
                             })
        ]);
    }

    public function deletePost($id){
        $this->dispatchBrowserEvent('deletePost',[
            'title' => 'Emin misiniz?',
            'html'  => 'Silmek istediğinize',
            'id'    => $id,
        ]);
    }

    public function deletePostAction($id){
        $post=Post::find($id);
        $path="back/images/post_images/";
        $sayfa_gorsel=$post->sayfa_gorsel;
        //dd(Storage::disk('public')->exists($path.$sayfa_gorsel));
        if($sayfa_gorsel!=null && (File::exists($path.$sayfa_gorsel))){
                        File::delete($path.$sayfa_gorsel);
                //dd($sayfa_gorsel);
        }
        $delete_post=$post->delete();
        if($delete_post){
            $this->showToastr('Ürün başarıyla silindi','success');
        }else{
            $this->showToastr('Hata Oluştu','error');

        }
    }

    public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type'      => $type,
            'message'   => $message,
        ]);

    }

}
