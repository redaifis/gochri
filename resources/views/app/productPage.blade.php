@extends('layouts.app')

@section('content')
    <product-page :product='@json($product)'></product-page>
@endsection
