@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Modifier votre profil</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <edit-profile :profile='@json($profile)' :csrf='@json(csrf_token())':errors='@json($errors->all())'></edit-profile>
  
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->


@endsection