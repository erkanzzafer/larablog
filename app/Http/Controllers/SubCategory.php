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


}
