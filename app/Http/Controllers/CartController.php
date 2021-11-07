<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DelElemCartFormRequest;
use App\Http\Requests\ClearCartFormRequest;
use App\Http\Requests\AddInCartFormRequest;
use App\Http\Requests\EditCartFormRequest;
use Darryldecode\Cart\Cart;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class CartController extends Controller
{
 
    public function addInCart(AddInCartFormRequest $request)
    {
    	

    		$product = Products::where( 'id',$request->validated()['id'] )->first();
		    
		    
		    $userId = Auth::user()->id;

    		
	    	\Cart::session( $userId );

			
	    	\Cart::add(array(
			    'id'         => (int) $request->validated()['id'], 
			    'name'       => $product->title,
			    
			    'price'      => isset($product->new_price) ? $product->new_price : $product->price ,
			    
			    'quantity'   => $request->validated()['count'],
			    'attributes' => [
			    	
			    	'img'  => isset($product->images[0]->img) ? $product->images[0]->img : 'images/not_file.png',
			    	'slug' => $product->slug,
			    ]
			));
	    	
			
			return response()->json([
				'status'  => 'succes',
				'cart'    => \Cart::getContent(), 
				'id user' => $userId
			],200);


    }


    public function editCart(EditCartFormRequest $request)
    {
    	

			$userId = Auth::user()->id;
			\Cart::session( $userId );

	    	\Cart::update( $request->validated()['id'] , [
				'quantity' => [
				      'relative' => false,
				      'value' => $request->count
				  ],
		
			]);

			$response = array(
				'result'    => 'success',
				'status'    => 200,
				'request'   => $request->validated(),
				'all_price' => \Cart::getTotal(), 
				'all_count' => \Cart::getTotalQuantity(), 
				'price'     => \Cart::get($request->validated()['id'])->getPriceSum() 
			);
			return response()->json($response, 200);

    }



    public function delElemCart(DelElemCartFormRequest $request)
    {
    	

			$userId = Auth::user()->id;
			\Cart::session( $userId );

	    	
	    	\Cart::remove($request->validated()['id']);

	    	
	    	$response = array(
				'result'    => 'success',
				'status'    => 200,
				'id'        => $request->validated()['id'] ,
				'all_price' => \Cart::getTotal(),  
				'all_count' => \Cart::getTotalQuantity() 
			);
			return response()->json($response,200);

    }



    public function clearCart(ClearCartFormRequest $request)
    {
    	
    		$userId = Auth::user()->id;
			\Cart::session( $userId );
    		
    		\Cart::clear();
	    	return response()->json([ 
	    		'result' => 'success',
	    		'status' => 200,
	    	], 200);
	
    }
}
