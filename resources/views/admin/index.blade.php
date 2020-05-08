@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Tableau de bord</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <index-component 
          :orders='@json($orders)' 
          :products='@json($products)' 
          :users_count='@json($users_count)' 
          :products_count='@json($products_count)' 
          :orders_count='@json($orders_count)' 
          :success='@json(session('success'))'>
          </index-component>
  
  
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection