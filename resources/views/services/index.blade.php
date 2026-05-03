@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Service Management')
@section('page-subtitle', 'Define and manage salon services and pricing.')

@section('content')
<div class="glass-card mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Services</h5>
        <button class="btn btn-neon" data-bs-toggle="modal" data-bs-target="#serviceModal" id="addServiceBtn">
            <i class="fa-solid fa-plus me-2"></i> Add Service
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $i => $service)
                <tr id="service-row-{{ $service->id }}">
                    <td class="text-secondary small">{{ $i + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;border-radius:8px;background:rgba(157,80,187,0.12);display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-scissors" style="color:var(--neon-purple, #9d50bb);font-size:0.8rem"></i>
                            </div>
                            <span class="fw-bold">{{ $service->name }}</span>
                        </div>
                    </td>
                    <td><span class="fw-bold" style="color:#00fff2">${{ number_format($service->price, 2) }}</span></td>
                    <td><small class="text-secondary"><i class="fa-regular fa-clock me-1"></i>{{ $service->duration ?? 0 }} mins</small></td>
                    <td><small class="text-secondary">{{ Str::limit($service->description, 40) ?? '—' }}</small></td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info edit-service" data-id="{{ $service->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-service" data-id="{{ $service->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-secondary">No services yet. Add your first one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Service Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="serviceModalTitle">Add New Service</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <input type="hidden" id="service_id">
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Service Name *</label>
                        <input type="text" id="s_name" class="form-control" placeholder="e.g. Haircut, Beard Trim" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small text-secondary">Price ($) *</label>
                            <input type="number" id="s_price" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label small text-secondary">Duration (mins)</label>
                            <input type="number" id="s_duration" class="form-control" placeholder="30" min="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Description</label>
                        <textarea id="s_description" class="form-control" rows="2" placeholder="Brief description..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Image URL (Unsplash Link)</label>
                        <input type="url" id="s_image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-secondary text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-neon" id="saveService">Save Service</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const BASE = '/admin';

$(document).ready(function() {
    $('#addServiceBtn').click(function() {
        $('#serviceModalTitle').text('Add New Service');
        $('#serviceForm')[0].reset();
        $('#service_id').val('');
    });

    $('#saveService').click(function() {
        const id  = $('#service_id').val();
        const url = id ? `${BASE}/services/${id}` : `${BASE}/services`;
        const method = id ? 'PUT' : 'POST';
        $.ajax({
            url, method,
            data: { 
                name: $('#s_name').val(), 
                price: $('#s_price').val(), 
                duration: $('#s_duration').val(), 
                description: $('#s_description').val(),
                image_url: $('#s_image_url').val()
            },
            success: function(res) {
                $('#serviceModal').modal('hide');
                showToast(res.message);
                setTimeout(() => location.reload(), 800);
            },
            error: function(xhr) {
                const errs = xhr.responseJSON?.errors || {};
                showToast(Object.values(errs).flat()[0] || 'Error occurred', 'error');
            }
        });
    });

    // Edit
    $(document).on('click', '.edit-service', function() {
        const id = $(this).data('id');
        $.get(`${BASE}/services/${id}`, function(s) {
            $('#serviceModalTitle').text('Edit Service');
            $('#service_id').val(s.id);
            $('#s_name').val(s.name);
            $('#s_price').val(s.price);
            $('#s_duration').val(s.duration);
            $('#s_description').val(s.description);
            $('#s_image_url').val(s.image_url);
            $('#serviceModal').modal('show');
        });
    });

    // Delete
    $(document).on('click', '.delete-service', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Service?', text: 'This may affect existing appointments!',
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#00d2ff', cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!', background: '#111', color: '#fff'
        }).then(r => {
            if (r.isConfirmed) {
                $.ajax({
                    url: `${BASE}/services/${id}`, method: 'DELETE',
                    success: function(res) {
                        $(`#service-row-${id}`).fadeOut(400);
                        showToast(res.message);
                    }
                });
            }
        });
    });
});
</script>
@endsection
