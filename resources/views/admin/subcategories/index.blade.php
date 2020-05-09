@extends('layouts.admin')

@section('content')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row my-2">
        <div class="col-12">
          <h1 class="m-0 text-dark">Les sous-catégories</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
      <subcategories-component :subcategories='@json($subcategories)' :csrf='@json(csrf_token())' :errors='@json($errors->all())' :success='@json(session('success'))'></subcategories-component>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  
@endsection