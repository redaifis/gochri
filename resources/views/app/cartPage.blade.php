@extends('layouts.app')
{{--
@section('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@endsection --}}

@section('content')
    <cart-page></cart-page>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AW74vfZiWryaoXiLyq4mkLLPYePLjFvYSmsetzc_S3ZMxw_0jGdVLxxlj-mGPyLAUkpFdNm2rdZFRJ8y&currency=EUR"> // Replace YOUR_SB_CLIENT_ID with your sandbox client ID
    </script>

@endsection
