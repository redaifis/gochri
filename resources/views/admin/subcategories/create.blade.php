@extends('layouts.admin')

@section('content')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row my-2">
        <div class="col-12">
          <h1 class="m-0 text-dark">Ajouter un sous-catégorie</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      

      <create-subcategorie :categories='@json($categories)' :csrf='@json(csrf_token())' :errors='@json($errors->all())'></create-subcategorie>


    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  
@endsection