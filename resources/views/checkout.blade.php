@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<checkout-component></checkout-component>

@endsection

@section('scripts')

<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AW74vfZiWryaoXiLyq4mkLLPYePLjFvYSmsetzc_S3ZMxw_0jGdVLxxlj-mGPyLAUkpFdNm2rdZFRJ8y&currency=EUR"> // Replace YOUR_SB_CLIENT_ID with your sandbox client ID
</script>
@endsection