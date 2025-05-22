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
                    <th>Actions</th>
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
                    <tr @if(!empty($feedback->reply)) class="table-success" @endif>
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
                      <td>
                        @if(empty($feedback->reply))
                          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal{{ $feedback->id }}">
                            Reply
                          </button>
                        @else
                          <button type="button" class="btn btn-secondary btn-sm" disabled>Replied</button>
                        @endif

                        <!-- Delete -->
                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>

                    @if(empty($feedback->reply))
                      <!-- Modal -->
                      <div class="modal fade" id="replyModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $feedback->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="{{ route('feedback.reply', $feedback->id) }}" method="POST">
                              @csrf
                              <div class="modal-header">
                                <h5 class="modal-title" id="replyModalLabel{{ $feedback->id }}">Reply to {{ $feedback->email }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label class="col-form-label">Recipient:</label>
                                  <input type="email" class="form-control" value="{{ $feedback->email }}" readonly>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Message:</label>
                                  <textarea name="reply" class="form-control" rows="4" required></textarea>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    @endif
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
