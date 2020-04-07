<?php

namespace App;


class Cart
{

    public $item  = null ; //group of products
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart)
    {
       //if cart already exists
      if($oldCart){
          
          $this->item        = $oldCart->item;
          $this->totalQty    = $oldCart->totalQty;
          $this->totalPrice  = $oldCart->totalPrice;


      }
    }

    public function add($item, $qty)
    {

        
       $storedItem  = [
                        'qty'   => 0,
                        'price' => $item->price,
                        'item'  => $item,
                        'maxqty'=> $item->qty,
                       ];

        if($this->item){

             if(array_key_exists($item->id, $this->item)){
                $storedItem = $this->item[$item->id];

                 // $this->item[$item->id]['qty' ] = $item->qty;

                 // $
                

                if($item[$item->qty] == 0){
                 return false;
                }
             }
        }


        $storedItem['qty']+= $qty ; //add each time qty 
        $storedItem['price'] = $item->price * $qty; //$qty input qty by the cust
        if( $storedItem['qty'] > $item->qty){
          return false;
        }

        $this->item[$item->id] = $storedItem;
        // $this->totalQty++;
        $this->totalQty += $storedItem['qty'];
        $this->totalPrice +=  $storedItem['price'];
        return true;




    }

    public function reduceByOne($id)
    {
      $this->item[$id]['qty']--;
      $this->item[$id]['price'] -=  $this->item[$id]['item']['price'];
      $this->totalQty--;
      $this->totalPrice -= $this->item[$id]['item']['price'];

      if($this->item[$id]['qty']<= 0){
        unset($this->item[$id]);
      }
    }

    public function removeItem($id){
      $this->totalQty -= $this->item[$id]['qty'];//subtracting the qty currently stored in the session from it's number itself
      $this->totalPrice -= $this->item[$id]['price'];//subtracting not just the single item but the whole item itself
      unset($this->item[$id]);
    }


}



