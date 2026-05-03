@extends('layouts.admin')

@section('title', 'Customers')
@section('page-title', 'Customer Management')
@section('page-subtitle', 'Manage your salon customers and their information.')

@section('content')
<div class="glass-card mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Customers</h5>
        <div class="d-flex gap-3">
            <div class="input-group" style="max-width: 280px;">
                <span class="input-group-text bg-transparent border-glass text-secondary">
                    <i class="fa-solid fa-search"></i>
                </span>
                <input type="text" id="customerSearch" class="form-control search-glow" placeholder="Search customers...">
            </div>
            <button class="btn btn-neon" data-bs-toggle="modal" data-bs-target="#customerModal" id="addBtn">
                <i class="fa-solid fa-plus me-2"></i> Add Customer
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle" id="customers-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $i => $customer)
                <tr id="customer-row-{{ $customer->id }}">
                    <td class="text-secondary small">{{ $i + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=9d50bb&color=fff" class="rounded-circle" width="32">
                            <span class="fw-500">{{ $customer->name }}</span>
                        </div>
                    </td>
                    <td>{{ $customer->phone }}</td>
                    <td class="text-secondary small">{{ $customer->email ?? '—' }}</td>
                    <td class="text-secondary small">{{ Str::limit($customer->address, 25) ?? '—' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info edit-customer" data-id="{{ $customer->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-customer" data-id="{{ $customer->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-secondary">No customers yet. Add your first one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Add New Customer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="customerForm">
                    <input type="hidden" id="customer_id">
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Full Name *</label>
                        <input type="text" id="name" class="form-control" placeholder="e.g. John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Phone Number *</label>
                        <input type="text" id="phone" class="form-control" placeholder="e.g. +1 234 567 890" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Email Address</label>
                        <input type="email" id="email" class="form-control" placeholder="john@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">Home Address</label>
                        <textarea id="address" class="form-control" rows="2" placeholder="123 Street, City"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-secondary text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-neon" id="saveCustomer">Save Customer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const BASE = '/admin';

$(document).ready(function() {
    // Reset modal on open for ADD
    $('#addBtn').click(function() {
        $('#modalTitle').text('Add New Customer');
        $('#customerForm')[0].reset();
        $('#customer_id').val('');
    });

    // SAVE / UPDATE
    $('#saveCustomer').click(function() {
        const id  = $('#customer_id').val();
        const url = id ? `${BASE}/customers/${id}` : `${BASE}/customers`;
        const method = id ? 'PUT' : 'POST';
        const data = {
            name: $('#name').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            address: $('#address').val()
        };
        $.ajax({
            url, method, data,
            success: function(res) {
                $('#customerModal').modal('hide');
                showToast(res.message);
                setTimeout(() => location.reload(), 800);
            },
            error: function(xhr) {
                const errs = xhr.responseJSON?.errors || {};
                showToast(Object.values(errs).flat()[0] || 'Error occurred', 'error');
            }
        });
    });

    // SEARCH with skeleton
    let searchTimer;
    $('#customerSearch').on('keyup', function() {
        clearTimeout(searchTimer);
        const query = $(this).val();
        const tbody = $('#customers-table tbody');
        tbody.html(`
            <tr><td><div class="skeleton w-75"></div></td>
            <td><div class="skeleton w-50"></div></td>
            <td><div class="skeleton w-75"></div></td>
            <td><div class="skeleton w-50"></div></td>
            <td><div class="skeleton w-75"></div></td>
            <td><div class="skeleton w-25"></div></td></tr>
        `.repeat(3));

        searchTimer = setTimeout(() => {
            $.get(`${BASE}/customers`, { search: query }, function(customers) {
                let rows = '';
                customers.forEach((c, i) => {
                    rows += `<tr id="customer-row-${c.id}">
                        <td class="text-secondary small">${i+1}</td>
                        <td><div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(c.name)}&background=9d50bb&color=fff" class="rounded-circle" width="32">
                            <span>${c.name}</span></div></td>
                        <td>${c.phone}</td>
                        <td class="text-secondary small">${c.email || '—'}</td>
                        <td class="text-secondary small">${c.address ? c.address.substring(0,25)+'…' : '—'}</td>
                        <td><div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-info edit-customer" data-id="${c.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-sm btn-outline-danger delete-customer" data-id="${c.id}"><i class="fa-solid fa-trash"></i></button>
                        </div></td></tr>`;
                });
                if (!customers.length) rows = '<tr><td colspan="6" class="text-center py-4 text-secondary">No customers found.</td></tr>';
                tbody.html(rows);
                bindEvents();
            });
        }, 400);
    });

    function bindEvents() {
        // Edit
        $('.edit-customer').off('click').on('click', function() {
            const id = $(this).data('id');
            $.get(`${BASE}/customers/${id}`, function(c) {
                $('#modalTitle').text('Edit Customer');
                $('#customer_id').val(c.id);
                $('#name').val(c.name);
                $('#phone').val(c.phone);
                $('#email').val(c.email);
                $('#address').val(c.address);
                $('#customerModal').modal('show');
            });
        });

        // Delete
        $('.delete-customer').off('click').on('click', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Delete Customer?', text: "This cannot be undone!",
                icon: 'warning', showCancelButton: true,
                confirmButtonColor: '#00d2ff', cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!', background: '#111', color: '#fff'
            }).then(r => {
                if (r.isConfirmed) {
                    $.ajax({
                        url: `${BASE}/customers/${id}`, method: 'DELETE',
                        success: function(res) {
                            $(`#customer-row-${id}`).fadeOut(400);
                            showToast(res.message);
                        }
                    });
                }
            });
        });
    }

    bindEvents();
});
</script>
@endsection
