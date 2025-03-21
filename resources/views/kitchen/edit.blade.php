{{-- @extends('layouts.master')

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
                  <h3 class="card-title">Editing Delicious Dish</h3>
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
                                <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" value="{{old('name',$dish->name)}}">
                            </div>

                            <div>
                                <label for="" class="text-bold">Category</label>
                                <select name="category" id="" class="form-control">
                                    <option value="">Choose Category</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{$cat->id}}" {{$cat->id == $dish->category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="">Image</label><br>
                                <img src="/public/images/{{$dish->image}}" alt="">
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


@endsection --}}

@extends('layouts.master')

@section('content')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kitchen</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Editing Delicious Dish</h3>
                  <div>
                    <a href="/dish" class="btn btn-success float-right">Back</a>
                  </div>
                </div>

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

                    <form action="{{ url('dish/' . $dish->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name', $dish->name) }}">
                        </div>

                        <div>
                            <label for="">Category</label>
                            <select name="category" class="form-control">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $dish->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="">Current Image</label><br>
                            <img src="{{ asset('images/' . $dish->image) }}" alt="Dish Image" width="100">
                        </div>

                        <div>
                            <label for="">Upload New Image</label>
                            <input type="file" name="dish_image" class="form-control">
                        </div><br>

                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

