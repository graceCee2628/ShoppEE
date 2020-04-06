<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Session;

use App\Product;

use App\Cart;

use App\User;

class CartController extends Controller
{



    


    // public function cart(Request $request, $id)
    // {

    //     $prod_id=Product::find($id); 

    //     $user_id=Auth::user()->id;
    //     $user=User::find($user_id);
    //     $user_name = Auth::user()->name;

    //     $cart = new cart;
    //     $cart->user_name =$user_name;
    //     $cart->prod_id = $id;
    //     $cart->prod_item = $request->pordername;
    //     $cart->prod_code = $request->pcode;
    //     $cart->prod_qty = $request->quantity;
    //     $cart->price = $request->porderprice;
    //     $cart->amount_due = $request->totalprice;
    //     $cart->grandTotal = $request->grand_total;

    //     $cart->save();



    //     //TO DO: PLS UPDATE THE QUANTITY SHOWING IN WEB
        
    // }     
    // public function my_cart()
    // {
    //     $cart = Cart::all();

    //     return view ('shop.cart')->with('carts', $cart);
        
    // } 

    // public function delete_cart_item($id)
    // {
    //     $cart = Cart::find($id);
    //     $cart->delete();
        
    // }
    
}
