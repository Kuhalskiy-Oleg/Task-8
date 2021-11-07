<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';


    
    public function products()
    {
      
    	return $this->hasMany(Products::class , 'category_id' , 'id');
    }


    
    
    
    public static function sort($request_sortBy, $category_products)
    {
        if ($request_sortBy == 'Price-min') {
            
            
            return $category_products->orderBy('price')->paginate(8)->withQueryString();

        }elseif ($request_sortBy == 'Price-max') {

            
            return $category_products->orderBy('price','desc')->paginate(8)->withQueryString();

        }elseif ($request_sortBy == 'A-z') {

            
            return $category_products->orderBy('title')->paginate(8)->withQueryString();

        }elseif ($request_sortBy == 'Z-a') {
            
            
            return $category_products->orderBy('title','desc')->paginate(8)->withQueryString();
        
        }elseif ($request_sortBy == 'Default') {

        	
            return $category_products->paginate(8)->withQueryString();
        }
    }
  
}
