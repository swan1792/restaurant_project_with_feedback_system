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
                  <h3 class="card-title">Creating Delicious Dish</h3>
                  <div>
                    <a href="/dish" class="btn btn-success float-right">Back</a>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                </ul>
                </div>
                @endif

                    <form action="/dish" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div>
                                <label for="">Name</label>
                                <input type="text" name="name" class= "form-control" placeholder="Enter dish name" value="{{ old('name') }} ">
                            </div>

                            <div>
                                <label for="" class="text-bold">Category</label>
                                <select name="category" id="" class="form-control">
                                    <option value="">Choose Category</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="">Image</label><br>
                                <input type="file" name="dish_image">
                            </div><br>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                    </form>
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
