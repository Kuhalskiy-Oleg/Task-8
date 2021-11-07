<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        

        if (Schema::hasTable('categories')) {

            
            $categories = Category::all();

            
            View::share([
                'categories' => $categories
                
            ]);

        
        }else{

            
            $categories = [
                'status' => 'not table "categories"'
            ];

            View::share([
                'categories' => $categories
            ]);
  
        }

        


        
        if (Schema::hasTable('users')) {

            View::share([
                'users_AppServiceProvider' => 'table_users_create'
            ]);
        
        
        }else{

            View::share([
                'users_AppServiceProvider' => 'not_table_users'
            ]);
  
        }
        
    }
}
