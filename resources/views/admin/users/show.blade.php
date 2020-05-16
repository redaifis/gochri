@extends('layouts.admin')

@section('content')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row my-2">
        <div class="col-12">
          <h1 class="m-0 text-dark">Profil d'utilisateur</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      

      <show-user></show-user>


    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  
@endsection

@section('scripts')
  <script>
    window.userId = {!! $userId !!}
  </script>
@endsection