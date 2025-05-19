<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
</head>
<body>
<div class="card">
    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h3>Order Form</h3>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-new-order" data-toggle="pill" href="#tab1" role="tab">New Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-order-list" data-toggle="pill" href="#tab2" role="tab">Order Lists</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-feedback" data-toggle="pill" href="#tab3" role="tab">Customer Feedback</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">

                            <!-- New Order -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                <form action="{{ route('order.submit') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        @foreach($dishes as $dish)
                                            <div class="col-sm-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="{{ url('/images/'.$dish->image) }}" width="100" height="100"><br>
                                                        <label>{{ $dish->name }}</label><br>
                                                        <input type="number" name="{{ $dish->id }}" class="form-control"><br>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label>Table</label>
                                        <select name="table" class="form-control">
                                            @foreach($tables as $table)
                                                <option value="{{ $table->id }}">{{ $table->number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Submit">
                                </form>
                            </div>

                            <!-- Order List -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                <table class="table table-bordered table-striped">
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
                                            <td>{{ optional($order->dish)->name ?? 'Unknown Dish' }}</td>
                                            <td>{{ $order->table_id }}</td>
                                            <td>{{ $status[$order->status] }}</td>
                                            <td>
                                                <a href="/order/{{ $order->id }}/serve" class="btn btn-warning">Serve</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                           <!-- Customer Feedback -->
                        <div class="tab-pane fade" id="tab3" role="tabpanel">
                            <h5>Submit Customer Feedback</h5>
                                <form id="feedback-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Customer Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="comment">Feedback Comment</label>
                                    <textarea name="comment" class="form-control" rows="4" required></textarea>
                                </div>

                                <label>Feedback (Food Quality)</label>
                                <select name="status" class="form-control" required>
                                    <option value="bad">Bad</option>
                                    <option value="better">Better</option>
                                    <option value="good">Good</option>
                                    <option value="best">Best</option>
                                </select><br>

                                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                                </form>

                                <div id="feedback-response" class="mt-2"></div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/plugins/datatables/jquery.dataTables.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/dist/js/adminlte.min.js"></script>
<script>
    document.getElementById('feedback-form').addEventListener('submit', function (e) {
        e.preventDefault();
    
        const form = e.target;
        const formData = new FormData(form);
    
        fetch('/api/feedback', {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();
            const responseDiv = document.getElementById('feedback-response');
    
            if (res.ok) {
                responseDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                form.reset();
            } else {
                let errors = '';
                for (let key in data.errors) {
                    errors += `<li>${data.errors[key][0]}</li>`;
                }
                responseDiv.innerHTML = `<div class="alert alert-danger"><ul>${errors}</ul></div>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('feedback-response').innerHTML = '<div class="alert alert-danger">An unexpected error occurred.</div>';
        });
    });
</script>
    
</body>
</html>
