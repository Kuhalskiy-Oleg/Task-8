<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Schema;


class IndexController extends Controller
{
    public function index()
    {	
        if (Schema::hasTable ('products')) {

        	
        	
        	$products = Products::orderBy('created_at','asc')->take(8)->get();

            $products_count = Products::all()->count();

            
        	
        	return view('home.index',compact('products','products_count'));

        }else{

            return view('home.index', [
                'products' => 'not table "products"'
            ]);

        }
    }
}
