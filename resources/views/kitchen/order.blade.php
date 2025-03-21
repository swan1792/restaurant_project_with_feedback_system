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
                  <h3 class="card-title">Order Listing</h3>
                  {{-- <div>
                    <a href="/dish/create" class="btn btn-success float-right">Create</a>
                </div> --}}
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
                        <th>Dish Name</th>
                        <th>Table Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                      @foreach($orders as $order)
                      <tr>
                        <td>{{$order->dish_id}}</td>
                        <td>{{$order->table_id}}</td>
                        <td>{{$status[$order->status]}}</td>
                        <td>
                            <div>
                              <a href="/order/{{$order->id}}/approve" class="btn btn-warning">Approve</a>
                              <a href="/order/{{$order->id}}/cancel" class="btn btn-danger">Cancel</a>
                              <a href="/order/{{$order->id}}/ready" class="btn btn-success">Ready</a>
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
  <div class="float-right d-none d-sm-inline">
    <form action="logout" method="POST">
      @csrf
      <button type="submit" class="btn btn-default">Logout</button>
    </form>
  </div>

@endsection

<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $(function () {
    $('#dishes').DataTable({
        "paging": true,
        "searching" : false,
        "pageLength": 10,
        "lengthChange": false,
        "ordering": true,
        "info": true,
    });
});
</script>
