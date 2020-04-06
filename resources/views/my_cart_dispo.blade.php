@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
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
                                    @php  

                                        $totalSum = 0;
                                    @endphp

                                    @foreach($products as $product)

                                        <tr>
                                            <td>{{$product['item']['product_code']}} </td>
                                            <td>{{$product['item']['name']}} </td>
                                            <td>{{$product['item']['price']}}</td>
                                            <td>{{$product['qty']}}</td>
                                            <td>{{$product['qty']*$product['item']['price']}}</td>
                                            <td>
                                                <center>
                                                    <a href="" type="" class="delete" id="">
                                                        <i class="fa fa-trash" style="color: maroon" ></i>
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                         <?php  
                                             $totalSum+=$totalprice;
                                        ?> 
                                    @endforeach
                                </tbody>
                            </table>
                             @else
                                <center>
                                    <h3>{{'Cart is empty!'}} </h3>
                                </center>
                             @endif
                        </div>
                        <a href="/home" class="btn btn-default text-primary" style="float: right"> 
                            <i class='fas fa-reply text-primary'>
                            </i> Back To Shop
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Order Summary</div>
                <div class="card-body">
                    <div class="col mt-3">
                        <b style="color: maroon">
                            <label>Amount Due:</label>
                            @if(Session::has('carts'))                
                            <span>&nbsp;&nbsp;₱</span>&nbsp;&nbsp;&nbsp;<label name="dueAmount" id="dueAmount">{{$totalSum}}</label>
                            @else
                            <span>&nbsp;&nbsp;₱</span>&nbsp;&nbsp;&nbsp;<label>0</label>
                            @endif
                        </b>
                        <br>
                        <br>
                        <a href="/home" class="btn btn-default form-control text-primary" style="background: rgba(0,0,0,0.2);"> Continue Shopping</a>
                        <br>
                        <br>
                        <a href="" class="btn form-control checkOut" type="submit" id="" style="background: maroon; border: none; color: white">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container">
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thank You For CheckingOut!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary continue" id="continue" data-dismiss="modal">Continue</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>





<!--------------------------------------------------------------------------
 ADD TO CART BUT IT'S STILL STACKING
-------------------------------------------------------------------------->


                    @if(Session::has('cart'))
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                <ul class="list-group">
                                    @foreach($products as $product)
                                        <li class="list-group-item">
                                            <strong>{{$product['item']['name']}}</strong>
                                            <span class="badge badge-success">{{$product['qty']}}</span>
                                            
                                            <span class="label label-success">{{$product['price']}}</span>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                    Action<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href=""></a>Reduce by 1</li>
                                                    <li><a href=""></a>Reduce All</li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>



                        <hr>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                <strong>Total Price: {{$product['totalPrice']}}</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                <button type="button" class="btn btn-success">Checkout</button>
                            </div>
                        </div>




                    @else
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                <h2>No Items in Cart!   </h2>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>


<!--------------------------------------------------------------------------
| FORM BILLING
|-------------------------------------------------------------------------->




        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-primary">
                    <b>Checkout</b>
                </div>
                <div class="card-body">
                       <form action="/action_page.php">
                              <div class="row">
                                <div class="col-6">
                                  <h3>Billing Address</h3>
                                  <div class="row">
                                    <div class="col-12">
                                      <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                      <input type="text" id="fname" class="form-control" name="firstname" placeholder="John M. Doe">
                                    </div>
                                  </div>
                                  
                                  <div class="row">
                                    <div class="col-12">
                                      <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                      <input type="text" id="email" class="form-control" name="email" placeholder="john@example.com">
                                    </div>
                                  </div>


                                  <div class="row">
                                    <div class="col-12">
                                      <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                      <input type="text" id="adr" class="form-control" name="address" placeholder="542 W. 15th Street">
                                    </div>
                                  </div>
                                  
                                  <div class="row">
                                    <div class="col-12">
                                      <label for="city"><i class="fa fa-institution"></i> City</label>
                                      <input type="text" id="city" class="form-control" name="city" placeholder="New York">
                                    </div>
                                  </div>  
                                  

                                  <div class="row">
                                    <div class="col-6">
                                      <label for="state">State</label>
                                      <input type="text" id="state" class="form-control" name="state" placeholder="NY">
                                    </div>
                                    <div class="col-6">
                                      <label for="zip">Zip</label>
                                      <input type="text" id="zip" class="form-control" name="zip" placeholder="10001">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-6">
                                  <h3>Payment</h3>
                                  <label for="fname">Accepted Cards</label>
                                  <div class="icon-container">
                                    <i class='fab fa-cc-visa'style="color:navy;"></i>
                                    <i class="fab fa-cc-amex" style="color:blue;"></i>
                                    <i class="fab fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fab fa-cc-discover" style="color:orange;"></i>
                                  </div>

                                  <div class="row">
                                    <div class="col-12">
                                      <label for="cname">Name on Card</label>
                                      <input type="text" id="cname" class="form-control" name="cardname" placeholder="John More Doe">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-12">
                                      <label for="ccnum">Credit card number</label>
                                      <input type="text" id="ccnum" class="form-control" name="cardnumber" placeholder="1111-2222-3333-4444">
                                    </div>
                                  </div>


                                  <div class="row">
                                    <div class="col-6">
                                      <label for="expmonth">Exp Month</label>
                                     <input type="text" id="expmonth" class="form-control" name="expmonth" placeholder="September">
                                    </div>
                                    <div class="col-6">
                                      <label for="expyear">Exp Year</label>
                                      <input type="text" id="expyear" class="form-control" name="expyear" placeholder="2018">
                                    </div>
                                  </div>
                                  
                                  <div class="row">
                                    <div class="col-6">
                                      <label for="cvv">CVV</label>
                                     <input type="text" id="cvv" class="form-control" name="cvv" placeholder="352">
                                    </div>
                                  </div> 
                                </div>
                              </div>
                              <label>
                                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                              </label>
                              <a href="/shop/pay"type="submit" class="btn btn-success form-control checkout"> Continue to checkout</a>

                            </form>
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


            $('.delete').on('click', function(e){
                e.preventDefault();
                var id = $(this).attr('id');

                if(confirm('Are you sure you want to delete the item?')){

                    $.ajax({
                        method:'POST',
                        url:'/shop/'+id+'/delete_cart_item',
                        data:{
                            id
                        },
                        success:function(response){
                            location.reload();
                            alert('Item is deleted!');
                        }
                    });                    
                }
            });



            $('.checkOut').on('click', function(e){
                e.preventDefault();
                $('#myModal').modal('show');
                
            });


            $('#continue').on('click', function(e){
                e.preventDefault();
                var uname = $('#user_name').val();  
                $.ajax({
                    method:'POST',
                    url:'/shop/checkout',
                    data:{
                        uname
                    },
                    success:function(response){
                        window.location.assign('/home'); 
                    }
                });
            });
    });      

</script>


@endsection
