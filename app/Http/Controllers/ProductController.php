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

        if($cart->add($product, $request->qty)){
            // $cart->add($product, $request->qty);
            $request->session()->put('cart', $cart);
            // dd(Session::get($oldCart) );
            Session::flash('success','Item is successfully added to your cart!'); 
                
        }else{
            Session::flash('danger','Item is not available!'); 
        }
 
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
        $cart->reduceByOne($id);
        $total   = $cart->totalPrice; 

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
        $total   = $cart->totalPrice; 

        if(count($cart->item) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
             return view ('shop.cart');
        }
        return view ('shop.cart', [ 'products' =>$cart->item,'totalPrice'=>$total]);

    }

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

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        Session::forget('cart');
        return view ('shop.payment_confirmed');
    } 
}
