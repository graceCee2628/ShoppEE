@extends('admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Admin</div>

                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">EDIT</div>
                <div class="card-body">
                    <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3>
                                <label class="text-primary" id="pcode">{{$product->product_code}}</label>
                            </h3>
                        </div>
                        
                        <form id="form" enctype="multipart/form-data" class="form-horizontal">
                            <input type="hidden" name="prod_id" id="prod_id" value="{{ $product->id}}">
                            <div class="modal-body">
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4" >
                                            <div class="thumbnail" align="center">
                                                <img id="image_preview_container" src="/images/{{ $product->image }}" 
                                                alt="preview image" style="max-height: 330px;"> 
                                            </div>
                                            <div  class="mt-2">
                                                <input type="file" name="pimage" id="pimage"> 
                                                <input type="hidden" name="hidden_image" value="{{$product->image}}">
                                            </div>
                                        </div>
                                        <div class="col-md-8" >
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Name:</label>
                                                    </div>
                                                    <div class="col-md-9" >
                                                        <input type="text" id="pname" name="pname" class="form-control" value="{{ $product->name }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Qty:</label>
                                                    </div>
                                                    <div class="col-md-9" >
                                                        <input type="number" min="1" max="100" id="qty" name="qty" class="form-control" value="{{ $product->qty }}" >
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Price:</label>
                                                    </div>
                                                    <div class="col-md-9" >
                                                        <input id="price" name="price" class="form-control" value="{{ $product->price }}" >
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Description:</label>
                                                    </div>
                                                    <div class="col-md-9" >
                                                        <input class="form-control" id="desc" name="desc" value="{{ $product->description }}">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" >
                                <button type="submit" name="action_button" id="action_button" class="btn btn-success submit">Update<i class='far fa-edit'></i></button>
                                <a href="/admin" name="create" class="btn btn-default text-secondary" style="float: left;">
                                    <i class="fa fa-reply"></i>Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @section('page-script')
    <script type="text/javascript">

        $(document).ready(function(){


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 


              //Image change
              $('#pimage').change(function(){

                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#image_preview_container').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 

              });



              $('#form').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);

                

                $.ajax({
                    type:'POST',
                    url: "{{ url('update-product')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data) {
                        console.log('Updated:' +data);
                        alert('Successfully Updated!');
                        window.location.assign('/admin');
                                           
                    },
                    error:function(data){
                        console.log(data.responseJSON.errors);
                    }             
                });
              });

        });    


    </script>

    @endsection
@endsection