@extends('layouts.app')

@section('content')
    <product-page :product='@json($product[0])'></product-page>
@endsection
