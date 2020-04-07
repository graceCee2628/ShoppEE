@extends('layouts.app')

@section('title') 
  CheckOut
@endsection


@section('content') 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
              @include('inc.sidebar')
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-primary">
                    <b>Checkout</b>
                </div>
                <div class="card-body">
                  <div class="col">
                    <center>
                      <h3>Thank you for patronizing our products!</h3>
                      <h3>A confirmation email will be sent to you shortly!</h3>
                    </center>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
