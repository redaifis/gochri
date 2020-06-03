@extends('layouts.app')

@section('content')
    <order-page :order='@json($order)'></order-page>
@endsection

