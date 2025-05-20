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
                        <span class="badge badge-{{ $badge[ucfirst($feedback->status)] ?? 'info' }}">
                          {{ ucfirst($feedback->status) }}
                        </span>
                      </td>
                      <td>{{ $feedback->created_at->format('d M Y') }}</td>
                    </tr>

                    <tr>
                      <td colspan="6">
                        <!-- Reply Form -->
                        <form action="{{ route('feedback.reply', $feedback->id) }}" method="POST" class="mb-2">
                          @csrf
                          <div class="form-group">
                            <label>Reply to {{ $feedback->email }}:</label>
                            <textarea name="reply" class="form-control" rows="2" required>{{ old('reply', $feedback->reply) }}</textarea>
                          </div>
                          <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
                        </form>

                        <!-- Delete Form -->
                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
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
