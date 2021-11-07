<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function categories()
    {
    	
    	return view('categories.categories');
    }

    public function showCategory(Request $request, string $slug)
    {

    	
    	$category = Category::where('slug',$slug)->first();
    	
    	
    	
    	$products_from_category = $category ? $category->products()->paginate(8)->withQueryString() : null;

    	$products_from_category_count = $category ?  $category->products()->count() : null;
    	

        $dataRequest = $request->only((['sortBy','page']));
        if (count($dataRequest) > 0) {
            
            $products_from_category = Category::sort($request->sortBy, $category->products());
        }



        if (isset($products_from_category)) {
        	
        	$response = array(
				'status' => 'success',
				"products_from_category" => $products_from_category,
				"request" => $request->all(),
				
				'pagination' => $products_from_category->appends(request()->query())->links("pagination::bootstrap-4")
			);
        }
        

        
        if ($request->ajax()) {

        	return view('generated_code_ajax.show_category',compact('response'))->render();
   
        }
        
    	return view('categories.show_category',compact(
            'category',
            'products_from_category',
            'products_from_category_count',
        ));
    }


}



