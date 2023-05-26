<?php

namespace App\Http\Controllers;

use App\Models\Subcategory as ModelsSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategory extends Controller
{
    public function addSubcategory (Request $request){

        $subcategory = new ModelsSubcategory();
        $subcategory->subcategory_name = $request->input('subcategory_name');
        $subcategory->parent_category = $request->input('parent_category');
        $subcategory->slug = Str::slug( $subcategory->subcategory_name);
        $saved=$subcategory->save();
        if ($saved){
            return redirect()->back()->with('success', 'Veri başarıyla kaydedildi.');
        }else{
            return redirect()->back()->with('error', 'Veri kaydedilmedi.');
        }
    }

    public function editSubcategory ($id){
            $subcategory = ModelsSubcategory::findOrFail($id);
            return view('back.pages.edit_subcategory', compact('subcategory'));
    }

    public function updateSubcategory(Request $request,Subcategory $subcategory){

        $subcategory=ModelsSubcategory::findOrFail($request->id);

        if (!$subcategory) {
            $subcategory->subcategory_name=$request->input('subcategory_name');
            $subcategory->parent_category=$request->input('parent_category');
            $saved=$subcategory->save();
            if ($saved){
                return redirect()->route('author.subcategories')->with('success', 'Alt kategori güncellendi.');
            }else{
                return redirect()->route('author.subcategories')->with('error', 'Alt kategori güncellenemedi.');
            }
        }else{
            dd("hata");
        }



    }


}
