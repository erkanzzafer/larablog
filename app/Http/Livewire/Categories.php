<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $parent_category;
    public $updateCategoryMode=false;
    public $updateSubCategoryMode=false;



    public function addSubCategory(){

        $this->validate([
            'parent_category' => 'required',
        ]);

        $subcategory=new Subcategory();
        $subcategory->subcategory_name=$this->subcategory_name;
        $subcategory->slug=Str::slug($this->subcategory_name);
        $subcategory->parent_category=$this->parent_category;
        $saved=$subcategory->save();
        if($saved){
            $this->dispatchBrowserEvent('hideSubcategoriesModal');
            $this->parent_category=null;

            $this->showToastr('New category has been successfully added','success');
        }else{
            $this->showToastr('something went wrong','error');
        }
    }




    public function updateCategory(){

            if ($this->selected_category_id){
                $this->validate([
                    'category_name' => 'required|unique:categories,category_name,'.$this->selected_category_id,
                ]);

                $category= Category::findOrFail($this->selected_category_id );
                $category->category_name=$this->category_name;
                $updated= $category->save();

                if($updated){
                    $this->dispatchBrowserEvent('hideCategoriesModal');
                    $this->updateCategoryMode=false;
                    $this->showToastr('Category has been successfully added', 'success');
                }else{
                    $this->showToastr('something went wrong','error');
                }
            }
    }

    public function editCategory ($id){
        $category=Category::findOrFail($id);
        $this->selected_category_id=$category->id;
        $this->category_name=$category->category_name;
        $this->updateCategoryMode=true;
        $this->dispatchBrowserEvent('showCategoriesModal');
    }

    public function addCategory(){
       $this->validate([
        'category_name' => 'required|unique:categories,category_name',
       ],[
        'category_name.required' => 'Bu alan zorunludur.',
        'category_name.unique' => 'Bu isimde başka bir kategori mevcut',
       ]);

       $category = new Category();
       $category->category_name=$this->category_name;
       $saved=$category->save();

       if ($saved){
        $this->dispatchBrowserEvent('hideCategoriesModal');
        $this->category_name=null;
        $this->showToastr('New category has been succesfuly added ','success');
       }else{
        $this->showToastr('Something went wrong','error');
       }


    }

    public function showToastr($message, $type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function render()
    {
        return view('livewire.categories',[
            'categories' =>Category::orderBy('ordering','asc')->get(),
        ]);
    }


}
