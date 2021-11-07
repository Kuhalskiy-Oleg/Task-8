<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

if (Schema::hasTable ('products')) {

    
    class Products extends Model
    {
        use HasFactory, Sluggable;

        

        
        protected $table = 'products';

            


        
        public function images()
        {
        
        	return $this->hasMany(ProductImage::class , 'product_id' , 'id');
        }


        
        public function comments()
        {
          
        
          return $this->hasMany(Comment::class , 'product_id' , 'id')->orderBy('created_at','desc');
        }


        
        public function categories()
        {
        
        	return $this->belongsTo(Category::class , 'category_id' , 'id');
        }


        
        
        
        public static function sort($request_sortBy, $request_filterBy)
        {
            
            if ($request_filterBy != 'Default') {

                
                
                $category = Category::where('slug', $request_filterBy)->first();
                
                
                
                
                

                if ($request_sortBy == 'Price-min') {
                    
                    
                    return $category ? $category->products()->orderBy('price')->paginate(8) : null;

                }elseif ($request_sortBy == 'Price-max') {

                    
                    return $category ? $category->products()->orderBy('price','desc')->paginate(8) : null;

                }elseif ($request_sortBy == 'A-z') {

                    
                    return $category ? $category->products()->orderBy('title')->paginate(8) : null;

                }elseif ($request_sortBy == 'Z-a') {
                    
                    
                    return $category ? $category->products()->orderBy('title','desc')->paginate(8) : null;
                
                }elseif ($request_sortBy == 'Default') {

                    
                    return $category ? $category->products()->paginate(8) : null;
                }

            
            }else{

                
                

                if ($request_sortBy == 'Price-min') {
                    
                    
                    return Products::orderBy('price')->paginate(8);                

                }elseif ($request_sortBy == 'Price-max') {

                    
                    return Products::orderBy('price','desc')->paginate(8);
                    
                }elseif ($request_sortBy == 'A-z') {

                    
                    return Products::orderBy('title')->paginate(8);
                    
                }elseif ($request_sortBy == 'Z-a') {
                    
                    
                    return Products::orderBy('title','desc')->paginate(8);
                    
                }elseif ($request_sortBy == 'Default') {

                    
                    return Products::paginate(8);
                }

            }

        }


        /**
         * Return the sluggable configuration array for this model.
         *
         * @return array
         */
        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }

    }

}
