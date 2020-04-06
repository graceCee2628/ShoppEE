<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\Cart;

use Session;


class ProductController extends Controller
{


    public function index()
    {
        $product = Product::all()->toArray();

        return view ('home')->with('products',$product );
    }

	//SESSION STARTS HERE...
	public function shop_view($id){
	        $prod = Product::find($id);
	        return response()->json($prod);
	}

    public function getAddToCart(Request $request, $id)
    {

        $this->validate($request,[
            'qty' => 'required'
        ]);      

        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        Session::flash('success','Item is successfully added to your cart!'); 

        
    } 
    public function my_cart()
    {
        if(!Session::has('cart')){
            return view ('shop.cart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $total   = $cart->totalPrice; 
        return view ('shop.cart', [ 'products' =>$cart->item,'totalPrice'=>$total]);
        
    }

    public function getReduceByOne($id)
    {
        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $total   = $cart->totalPrice; 
        $cart->reduceByOne($id);

        if(count($cart->item) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        return view ('shop.cart', [ 'products' =>$cart->item,'totalPrice'=>$total]);
        


    }

    public function getRemoveItem($id)
    {


        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->item) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
             return view ('shop.cart');
        }
        return view ('shop.cart', [ 'products' =>$cart->item,'totalPrice'=>$total]);

    }

    // public function checkOut($item)
    // {
    //     $oldCart = Session::has('cart') ? Session::get('cart') : null;
    //     $cart    = new Cart($oldCart);
    //     $cart->removeItem($id);

    //     if(count($cart->item) > 0){
    //         Session::put('cart', $cart);
    //     }else{
    //         Session::forget('cart');
    //          return view ('shop.cart');
    //     }
    //     return view ('shop.checkout', [ 'products' =>$cart->item,'totalPrice'=>$total]);
        
    // }    

    public function checkOut()
    {
        if(!Session::has('cart')){
            return view ('shop.cart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $total   = $cart->totalPrice; 
        return view ('shop.checkout', [ 'products' =>$cart->item,'totalPrice'=>$total]);
        
    }


    public function payment()
    {
        return view ('shop.payment_confirmed');
    } 
}
