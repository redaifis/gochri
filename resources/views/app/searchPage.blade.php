@extends('layouts.app')

@section('styles')
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

@endsection
@section('content')
    <search-page :searchedProducts='@json($products)' :searchText='@json($searchText)'></search-page>
@endsection

