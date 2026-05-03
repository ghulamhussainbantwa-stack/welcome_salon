@extends('layouts.admin')

@section('title', 'Appointments')
@section('page-title', 'Appointments')
@section('page-subtitle', 'Schedule and track salon appointments.')

@section('content')

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="glass-card text-center py-3">
            <h4 class="fw-bold mb-0" style="color:#fbbf24">{{ $appointments->where('status','pending')->count() }}</h4>
            <small class="text-secondary">Pending</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card text-center py-3">
            <h4 class="fw-bold mb-0 text-success">{{ $appointments->where('status','completed')->count() }}</h4>
            <small class="text-secondary">Completed</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card text-center py-3">
            <h4 class="fw-bold mb-0 text-danger">{{ $appointments->where('status','cancelled')->count() }}</h4>
            <small class="text-secondary">Cancelled</small>
        </div>
    </div>
</div>

<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Appointments</h5>
        <button class="btn btn-neon" data-bs-toggle="modal" data-bs-target="#appointmentModal" id="addApptBtn">
            <i class="fa-solid fa-calendar-plus me-2"></i> Book Appointment
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $i => $appt)
                <tr id="appointment-row-{{ $appt->id }}">
                    <td class="text-secondary small">{{ $i + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(optional($appt->customer)->name ?? 'Unknown') }}&background=00d2ff&color=fff" class="rounded-circle" width="28">
                            <span class="small">{{ optional($appt->customer)->name ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td><span class="badge" style="background:rgba(0,210,255,0.1);color:#00d2ff;border:1px solid rgba(0,210,255,0.2)">{{ optional($appt->service)->name ?? 'Unknown Service' }}</span></td>
                    <td><small>{{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') }}</small></td>
                    <td><small class="text-secondary">{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</small></td>
                    <td>
                        @if($appt->status == 'completed')
                            <span class="badge" style="background:rgba(25,135,84,0.2); color:#2ecc71; border:1px solid #2ecc71; padding:5px 12px;">✓ Completed</span>
                        @elseif($appt->status == 'cancelled')
                            <span class="badge" style="background:rgba(220,53,69,0.2); color:#e74c3c; border:1px solid #e74c3c; padding:5px 12px;">✕ Cancelled</span>
                        @else
                            <span class="badge" style="background:rgba(255,193,7,0.2); color:#f1c40f; border:1px solid #f1c40f; padding:5px 12px;">⏳ Pending</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info edit-appt" data-id="{{ $appt->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-appt" data-id="{{ $appt->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-secondary">No appointments yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="apptModalTitle">Book Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="apptForm">
                    <input type="hidden" id="appt_id">
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Customer *</label>
                        <select id="a_customer_id" class="form-select" required>
                            <option value="">Select Customer...</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} — {{ $c->phone }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Service *</label>
                        <select id="a_service_id" class="form-select" required>
                            <option value="">Select Service...</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} — ${{ $s->price }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small text-secondary">Date *</label>
                            <input type="date" id="a_date" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label small text-secondary">Time *</label>
                            <input type="time" id="a_time" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Status</label>
                        <select id="a_status" class="form-select">
                            <option value="pending">⏳ Pending</option>
                            <option value="completed">✓ Completed</option>
                            <option value="cancelled">✕ Cancelled</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-secondary text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-neon" id="saveAppt">Save Appointment</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const BASE = '/admin';

$(document).ready(function() {
    $('#addApptBtn').click(function() {
        $('#apptModalTitle').text('Book Appointment');
        $('#apptForm')[0].reset();
        $('#appt_id').val('');
    });

    $('#saveAppt').click(function() {
        const id  = $('#appt_id').val();
        const url = id ? `${BASE}/appointments/${id}` : `${BASE}/appointments`;
        const method = id ? 'PUT' : 'POST';
        $.ajax({
            url, method,
            data: {
                customer_id: $('#a_customer_id').val(),
                service_id:  $('#a_service_id').val(),
                appointment_date: $('#a_date').val(),
                appointment_time: $('#a_time').val(),
                status: $('#a_status').val()
            },
            success: function(res) {
                $('#appointmentModal').modal('hide');
                showToast(res.message);
                setTimeout(() => location.reload(), 800);
            },
            error: function(xhr) {
                const errs = xhr.responseJSON?.errors || {};
                showToast(Object.values(errs).flat()[0] || 'Error occurred', 'error');
            }
        });
    });

    $(document).on('click', '.edit-appt', function() {
        const id = $(this).data('id');
        $.get(`${BASE}/appointments/${id}`, function(a) {
            $('#apptModalTitle').text('Edit Appointment');
            $('#appt_id').val(a.id);
            $('#a_customer_id').val(a.customer_id);
            $('#a_service_id').val(a.service_id);
            $('#a_date').val(a.appointment_date);
            $('#a_time').val(a.appointment_time);
            $('#a_status').val(a.status);
            $('#appointmentModal').modal('show');
        });
    });

    $(document).on('click', '.delete-appt', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Appointment?', icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#00d2ff', cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!', background: '#111', color: '#fff'
        }).then(r => {
            if (r.isConfirmed) {
                $.ajax({
                    url: `${BASE}/appointments/${id}`, method: 'DELETE',
                    success: function(res) {
                        $(`#appointment-row-${id}`).fadeOut(400);
                        showToast(res.message);
                    }
                });
            }
        });
    });
});
</script>
@endsection
