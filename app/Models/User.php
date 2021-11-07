<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Schema;



use Illuminate\Support\Facades\Hash;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


if (Schema::hasTable ('users')) {
    class User extends Model implements AuthenticatableContract 
    {
        use HasFactory, Authenticatable, Sluggable;

        protected $table = 'users';

        protected $fillable = [
        	'name'    ,
        	'surname' ,
        	'login'   ,
        	'email'   ,
        	'password',
        ]; 

        protected $hidden = [
        	'password'
        ];


        
        
        public function setPasswordAttribute($password)
        {	
        	
        	
        	$this->attributes['password'] = Hash::make($password);

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
                    'source' => 'name'
                ]
            ];
        }
    }
}

