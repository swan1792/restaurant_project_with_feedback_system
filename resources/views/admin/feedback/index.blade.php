@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Customer Feedback</h1>
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
              <h3 class="card-title">Feedback Listing</h3>
            </div>

            <div class="card-body">
              @if(session('message'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif

              <table id="feedbacks" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($feedbacks as $index => $feedback)
                    @php
                      $badge = [
                        'Food' => 'secondary',
                        'Bad' => 'danger',
                        'Better' => 'warning',
                        'Best' => 'success',
                      ];
                    @endphp
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $feedback->name }}</td>
                      <td>{{ $feedback->email }}</td>
                      <td>{{ $feedback->comment }}</td>
                      <td>
                        <span class="badge badge-{{ $badge[$feedback->status] ?? 'info' }}">
                          {{ $feedback->status }}
                        </span>
                      </td>
                      <td>{{ $feedback->created_at->format('d M Y') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
  $(function () {
    $('#feedbacks').DataTable({
      paging: true,
      searching: true,
      pageLength: 10,
      ordering: true,
      info: true,
      lengthChange: false
    });
  });
</script>
@endsection
