<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Comment;
use App\Http\Requests\CommentsForm;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function comment($slug, CommentsForm $request)
    {

    	$product = Products::where('slug', $slug)->first();

    	$comment = Comment::create([
    		'text'       => $request->validated()['text'],
    		'user_id'    => $request->validated()['user_id'],
    		'product_id' => $product->id,	
    	]);


    	if ($comment) {

            $response = array(
                    'status'  => 'success',
                    'slug'    => $slug,
                    
                    "comments" =>  $product->comments
                );
    	}


        
        if ($request->ajax()) {
            
            return view('generated_code_ajax.comments',compact('response'))->render();

        }else{

            
            return response()->
                json([

                    'status' => 'error',
                    'msg'    => 'not ajax'
                 
                ],500);
        }
	
    }
}
