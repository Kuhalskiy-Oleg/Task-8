<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;


class ProductController extends Controller
{
    public function showProduct(string $slug)
    {
        if (Schema::hasTable ('categories')) {

        	$product = Products::where('slug',$slug)->first() ;
            $comments = $product->comments;
            
        	return view('product.show_product',compact('product','comments'));

	
        	
        }
    }


    public function products(Request $request)
    {
        
        if (Schema::hasTable ('products')) {

            
            $products = Products::paginate(8);
            

            
            

            $products_count_all = Products::all()->count();
            

            $dataRequest = $request->only((['sortBy','page','filterBy']));

            if (count($dataRequest) > 0) {

                $products = Products::sort($request->sortBy, $request->filterBy);
                
            }

            
            
            
            if (isset($products)) {
                $response = array(
                    'status'     => 'success',
                    "products"   => $products,
                    "request"    => $request->all(),
                    'pagination' => $products->appends(request()->query())->links("pagination.pagination_products")
                );
            }
                
            
            
            if ($request->ajax()) {
                
                return view('generated_code_ajax.products',compact('response'))->render();
            }

             
            return view('product.products',compact('products','products_count_all'));
   
        }else{
            return view('product.products', [ 
                'products' => 'not table "products"'
            ]);
        }

    }
    
}
