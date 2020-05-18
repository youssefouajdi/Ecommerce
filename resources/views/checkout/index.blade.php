@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')
<div class= "col-md-12">
    <h1>Page de paiement </h1>
    <div class="row">
        <div class="row-md-6" style="width: 50%;">
            <form action ="{{ route('checkout.store') }}" method="POST" class="my-4"
            id="payment-form">
            @csrf
                <div id="card-element" >
                </div>
                <div id="card-errors" role="alert"></div>
                <button class ="btn btn-success mt-3" id="submit">Payement ({{ getPrice(Cart::total()) }})</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extra-js')
<script>
        var stripe = Stripe('pk_test_s6GupCQKd3JcXE0YNPMFOSAs00s3iDwRxH');
        var elements = stripe.elements();
        var style = {
            base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            display: "inline-block",
            "::placeholder": {
                color: "#aab7c4"
            }
            },
            invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
            }
        };
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        card.addEventListener('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('alert','alert-warning');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert','alert-warning');
            displayError.textContent = '';
        }
        });
        var submitButton = document.getElementById('submit');

        submitButton.addEventListener('click', function(ev) {
        ev.preventDefault();
        submitButton.disabled=true;
        stripe.confirmCardPayment("{{ $clientSecret }}", {
            payment_method: {
            card: card
            }
        }).then(function(result) {
            if (result.error) {
            submitButton.disabled=false;
            } else {
            if (result.paymentIntent.status === 'succeeded') {
                var paymentIntent=result.paymentIntent;
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var form=document.getElementById('payment-form');
                var url=form.action;
                var redirect='/merci';  
                fetch(
                    url ,{
                        headers:{
                            "Content-Type": "application /json",
                            "Accept":"application/json, text-plain ,*/*",
                            "X-Requested-With":"XMLHttpRequest",
                            "X-CSRF-TOKEN":token
                        },
                        method:"POST",
                        body: JSON.stringify({
                            paymentIntent:paymentIntent
                        })
                    }
                ).then((data)=>{
                    console.log(data);
                    //window.location.href=redirect;
                }).catch((error)=>{
                    console.log("bonjour") 
                })  
                        
            }
            }
        });
        });
</script>
@endsection