@extends('layouts.app')

@section('content') 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                @include('inc.sidebar')
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">BILLING SUMMARY</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="container">
                        @if(Session::has('cart'))
                          <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</b></span></h4>
                          <hr>
                          <strong>Item</strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                          <strong>Qty</strong>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                          <strong>Price</strong>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
                          <strong>Amount</strong>
                          @foreach($products as $product)
                            <p><a href="#">{{$product['item']['name']}}</a>&nbsp; &nbsp;&nbsp; &nbsp;
                              <span class="qty">{{$product['qty']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                              <span class="price">{{$product['item']['price']}}</span>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                              <span id="total" class="total">{{$product['qty']*$product['item']['price']}}</span>
                            </p>
                          @endforeach
                        <hr>
                        <p>Grand Total <span class="price" style="color:black"><b>{{$totalPrice}}</b></span></p>
                        @endif
                      </div>
                    </div>
                    <a href="/shop/pay"type="submit" id="{{$product['item']['id']}}" class="btn btn-success form-control checkout"> Continue to checkout</a>
                  </div>
                </div>
            </div>
        </div>
     </div>   
</div>
  @section('page-script')
    @yield('head-script')
  @endsection
@endsection
