@extends('layouts.admin')
 
@section('title', 'Messages')
@section('page-title', 'Contact Inquiries')
@section('page-subtitle', 'Manage and respond to messages from the public site.')
 
@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Inbox</h5>
    </div>
 
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr id="message-row-{{ $msg->id }}" class="{{ $msg->is_read ? '' : 'fw-bold' }}">
                    <td>
                        @if(!$msg->is_read)
                            <span class="badge bg-neon-blue text-black">New</span>
                        @else
                            <span class="text-secondary small">Read</span>
                        @endif
                    </td>
                    <td><small class="text-secondary">{{ $msg->created_at->format('M d, H:i') }}</small></td>
                    <td>{{ $msg->name }}</td>
                    <td><small class="text-secondary">{{ $msg->email }}</small></td>
                    <td>{{ Str::limit($msg->subject, 30) }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info view-msg" data-id="{{ $msg->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-msg" data-id="{{ $msg->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-secondary">Your inbox is empty.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
 
<!-- Message Modal -->
<div class="modal fade" id="msgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Message Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="text-secondary small">From:</label>
                    <p class="mb-0 fw-bold" id="msg-name"></p>
                    <small class="text-neon-blue" id="msg-email"></small>
                </div>
                <div class="mb-3">
                    <label class="text-secondary small">Subject:</label>
                    <p class="mb-0" id="msg-subject"></p>
                </div>
                <hr class="border-glass">
                <div class="mb-3">
                    <label class="text-secondary small">Message:</label>
                    <p class="mb-0" id="msg-body" style="white-space: pre-wrap;"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-neon" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
<script>
$(document).ready(function() {
    $('.view-msg').click(function() {
        const id = $(this).data('id');
        $.get(`/admin/messages/${id}`, function(m) {
            $('#msg-name').text(m.name);
            $('#msg-email').text(m.email);
            $('#msg-subject').text(m.subject || '(No Subject)');
            $('#msg-body').text(m.message);
            $('#msgModal').modal('show');
            // Update row style
            $(`#message-row-${id}`).removeClass('fw-bold').find('.badge').replaceWith('<span class="text-secondary small">Read</span>');
        });
    });
 
    $('.delete-msg').click(function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Message?', icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#00d2ff', cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!', background: '#111', color: '#fff'
        }).then(r => {
            if (r.isConfirmed) {
                $.ajax({
                    url: `/admin/messages/${id}`, method: 'DELETE',
                    success: function(res) {
                        $(`#message-row-${id}`).fadeOut(400);
                        showToast(res.message);
                    }
                });
            }
        });
    });
});
</script>
@endsection
