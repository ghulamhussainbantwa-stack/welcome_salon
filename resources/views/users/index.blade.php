@extends('layouts.admin')

@section('title', 'Manage Admins')
@section('page-title', 'User Management')
@section('page-subtitle', 'Control who has access to the admin panel and update credentials.')

@section('content')
<div class="glass-card">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <h5 class="fw-bold mb-0">System Admins</h5>
        <button class="btn btn-neon w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#userModal" id="addUserBtn">
            <i class="fa-solid fa-user-plus me-2"></i> Add New Admin
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr id="user-row-{{ $user->id }}">
                    <td class="text-secondary small">{{ $i + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle" width="35">
                            <span class="fw-bold">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td><span class="text-neon-blue">{{ $user->email }}</span></td>
                    <td><small class="text-secondary">{{ $user->created_at->format('M d, Y') }}</small></td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info edit-user" data-id="{{ $user->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-user" data-id="{{ $user->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="userModalTitle">Add New Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="user_id">
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Full Name *</label>
                        <input type="text" id="u_name" class="form-control" placeholder="Enter admin name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Email Address *</label>
                        <input type="email" id="u_email" class="form-control" placeholder="admin@salon.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Password <span id="pwdLabel">(Required)</span></label>
                        <input type="password" id="u_password" class="form-control" placeholder="Minimum 8 characters">
                        <small class="text-secondary" id="pwdHint" style="display:none">Leave blank to keep current password.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-secondary text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-neon" id="saveUser">Save Admin Details</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    const BASE = '/admin';

    $('#addUserBtn').click(function() {
        $('#userModalTitle').text('Add New Admin');
        $('#userForm')[0].reset();
        $('#user_id').val('');
        $('#pwdLabel').text('(Required)');
        $('#pwdHint').hide();
    });

    $('#saveUser').click(function() {
        const id = $('#user_id').val();
        const url = id ? `${BASE}/users/${id}` : `${BASE}/users`;
        const method = id ? 'PUT' : 'POST';

        $.ajax({
            url, method,
            data: {
                name: $('#u_name').val(),
                email: $('#u_email').val(),
                password: $('#u_password').val()
            },
            success: function(res) {
                $('#userModal').modal('hide');
                showToast(res.message);
                setTimeout(() => location.reload(), 800);
            },
            error: function(xhr) {
                const errs = xhr.responseJSON?.errors || {};
                showToast(Object.values(errs).flat()[0] || 'Validation error', 'error');
            }
        });
    });

    $(document).on('click', '.edit-user', function() {
        const id = $(this).data('id');
        $.get(`${BASE}/users/${id}`, function(u) {
            $('#userModalTitle').text('Edit Admin');
            $('#user_id').val(u.id);
            $('#u_name').val(u.name);
            $('#u_email').val(u.email);
            $('#u_password').val('');
            $('#pwdLabel').text('(Optional)');
            $('#pwdHint').show();
            $('#userModal').modal('show');
        });
    });

    $(document).on('click', '.delete-user', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Admin Account?', 
            text: 'This person will lose all access to the system!',
            icon: 'warning', 
            showCancelButton: true,
            confirmButtonColor: '#00d2ff', 
            cancelButtonColor: '#ff0055',
            confirmButtonText: 'Yes, Remove!', 
            background: '#111', 
            color: '#fff'
        }).then(r => {
            if (r.isConfirmed) {
                $.ajax({
                    url: `${BASE}/users/${id}`, 
                    method: 'DELETE',
                    success: function(res) {
                        if(res.success) {
                            $(`#user-row-${id}`).fadeOut(400);
                            showToast(res.message);
                        } else {
                            showToast(res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        showToast(xhr.responseJSON?.message || 'Error deleting admin', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection
