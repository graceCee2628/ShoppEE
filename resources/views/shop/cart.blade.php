@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary">
                    <b>My Cart</b>
                </div>
                
                <div class="card-body">
                    <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
                        <div class="table-responsive" >
                            @if(Session::has('cart'))
                                <table id="myTable" class="table table-bordered table-striped mt-5" >
                                    <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)

                                            <tr>
                                                <td>{{$product['item']['product_code']}}</td>
                                                <td>{{$product['item']['name']}}</td>
                                                <td>{{$product['item']['price']}}</td>
                                                <td>{{$product['qty']}}</td>
                                                <td>{{$product['qty']*$product['item']['price']}}</td>
                                                <td>
                                                      <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle delete" id=" {{$product['item']['id']}}" type="button" data-toggle="dropdown"><i class="fa fa-trash" ></i>
                                                        <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                          <li><a href="/shop/{{$product['item']['id']}}/reduceItem">Reduce by 1</a></li>
                                                          <li><a href="/shop/{{$product['item']['id']}}/removeItem">Remove All</a></li>
                                                        </ul>
                                                      </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <strong class="text text-primary">Grand Total: ₱ {{$totalPrice}}</strong>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <a href="/checkout" class="btn btn-success">Check Out</a>
                                    </div>
                                </div>
                             @else
                                <center>
                                    <h3>{{'Cart is empty!'}} </h3>
                                </center>
                            </div>
                            @endif
                            <hr>
                            <a href="/home" class="btn btn-default text-primary" style="float: right"> 
                                <i class='fas fa-reply text-primary'>
                                </i> Back To Shop
                            </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 


    });      

</script>



@endsection
