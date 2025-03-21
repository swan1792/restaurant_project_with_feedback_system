@extends('layouts.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kitchen</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">


            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Dishes</h3>
                  <div>
                    <a href="/dish/create" class="btn btn-success float-right">Create</a>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">

                    @if (session('message'))
                        <div class="alert alert-success">
                        {{ session('message') }}
                        </div>
                    @endif

                  <table id="dishes" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                      @foreach($dishes as $dish)
                      <tr>
                        <td>{{ $dish->id }}</td>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->category->name }}</td>
                        <td>{{ $dish->created_at }}</td>
                        <td>
                            <div class="form-row">
                            <a href="/dish/{{ $dish->id }}/edit" class="btn btn-warning">Edit</a>
                            <div class="ml-3">
                                <form action="/dish/{{ $dish->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" onClick="return confirm('Are you absolutely sure you want to delete?')">
                                        Delete
                                    </button>

                                </form>
                            </div>

                            </div>
                        </td>
                      </tr>
                      @endforeach
                    <tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>


          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection

