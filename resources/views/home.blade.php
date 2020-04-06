@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('inc.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-primary">
                    <b>Shop All!</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($products as $obj=>$row)
                      <div class="col-sm-4">
                        <div class="card">
                            <img src="/images/{{ $row['image'] }}" style="max-height: 300px" class="img-responsive"> 
                        </div>
                        <div class="card-footer">
                            <h3>₱ {{$row['price']}}</h3>        
                            <a href="" class="btn btn-default addtocart" style="float: right;margin-top: -35px; color: maroon" id="{{$row['id']}}" role="button">
                                <i class="fa fa-cart-plus" ></i> Add to Cart</a>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
  <div class="modal fade" id="formModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="form" enctype="multipart/form-data" method="post" class="form-horizontal">
            {{csrf_field()}}
            <div class="modal-body">
                <span class="form_result"></span>
                <div class="row">
                    <div class="col">
                        <img id="image_preview_container" src="" alt="preview image" style="max-width: 370px;"> 
                    </div>
                    <div class=" col elements" style="margin-left: 2px;">
                        <input type="hidden" name="id" id="id">
                        <h3><label name="pcode" id="pcode"></label></h3>
                        <br>
                        <label name="pordername" id="pordername"></label>
                        <br>
                        <span>₱</span><label name="porderprice" id="porderprice"> </label>
                        <br>
                        <label>Available Stocks:</label>
                        <br>
                        <label name="stocks" id="stocks"></label>
                        <br>
                        <div class="row">
                          <div class="col-2">
                             <label>Qty:</label>
                          </div>
                          <div class="col-6">
                            <input class="form-control" type="number" id="qty" name="qty" min="1" max="1" width="50%">
                          </div> 
                        </div>
                        <br>
                        <button type="submit" style="background: maroon; border: none; color: white" class="form-control buynow">Buy Now</button>
                        <hr>
                        <label class="text-secondary">Product Description:</label>
                        <br>
                        <br>
                        <label class="text-secondary" name="porderdesc" id="porderdesc"></label>
                    </div>
                 </div>  
            </div> 
            <div class="modal-footer">
            </div>
        </form>
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

        //TO DISPLAY THE DATA USING MODAL SO THAT THE USER CAN ADD THE ITEM TO CART
          $(".addtocart").on('click',function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url:'shop/'+id+'/view',
                method: 'GET',
                data:{
                    id:id
                },
                success:function(data){
                    $('#image_preview_container').attr('src','/images/'+data.image);
                    $('#id').text(data.id);
                    $('#pcode').text(data.product_code);
                    $('#pordername').text(data.name);
                    $('#porderprice').text( data.price);
                    $('#stocks').text(data.qty); 
                    $('#porderdesc').text(data.description);
                    $('#formModal').modal('show');
                },

            });
             
          });


          $('#form').on('submit', function(e){
            e.preventDefault();
            var id = $('#id').text();
            var qty = $('#qty').val();
            var porderprice = $('#porderprice').text();
            var pordername = $('#pordername').text();

            var pcode = $('#pcode').text();
            var stocks = $('#stocks').text(); 
              
            var totalprice =  qty * porderprice;


            $.ajax({
                url: '/add-to-cart/'+id,
                method:'POST',
                data:{
                    id,
                    qty,
                    porderprice,
                    pordername,
                    pcode,
                    totalprice
                },
                success:function(){
                    location.reload();
                }
            });


          });
/*
|--------------------------------------------------------------------------
| ADD TO CART BUT IT'S STILL STACKING
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


          // $('#form').on('submit', function(e){
          //   e.preventDefault();
          //   var id = $('#id').text();
          //   var qty = $('#qty').val();
          //   var porderprice = $('#porderprice').text();
          //   var pordername = $('#pordername').text();   


           
          //   var pcode = $('#pcode').text();
          //   var stocks = $('#stocks').text();

          //   var totalprice =  qty * porderprice;
          //   var remaining_stocks = stocks - qty;


            
          //   $.ajax({
          //       url: '/add-to-cart',
          //       method:'POST',
          //       data:{
          //           id,
          //           qty,
          //           porderprice,
          //           pordername,
          //           pcode,
          //           totalprice
          //       },
          //       success:function(){
          //           location.reload();
          //       }
          //   });


          // });

    });      

</script>


@endsection
