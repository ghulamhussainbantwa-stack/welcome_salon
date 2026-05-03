@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Financial Reports')
@section('page-subtitle', 'Track revenue, daily income and payment history.')

@section('content')

<!-- Income Stats -->
<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="glass-card" style="border-color:rgba(0,255,242,0.25);box-shadow:0 0 20px rgba(0,255,242,0.08)">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,255,242,0.08);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-sun" style="color:#00fff2"></i>
                </div>
                <div>
                    <p class="text-secondary small mb-0">Today's Income</p>
                    <h3 class="fw-bold mb-0" style="color:#00fff2">${{ number_format($today_income, 2) }}</h3>
                </div>
            </div>
            <div class="progress bg-dark" style="height:4px">
                <div class="progress-bar" style="width:45%;background:#00fff2"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="glass-card" style="border-color:rgba(157,80,187,0.25);box-shadow:0 0 20px rgba(157,80,187,0.08)">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:44px;height:44px;border-radius:12px;background:rgba(157,80,187,0.08);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-calendar" style="color:#9d50bb"></i>
                </div>
                <div>
                    <p class="text-secondary small mb-0">Monthly Revenue</p>
                    <h3 class="fw-bold mb-0" style="color:#9d50bb">${{ number_format($monthly_income, 2) }}</h3>
                </div>
            </div>
            <div class="progress bg-dark" style="height:4px">
                <div class="progress-bar" style="width:65%;background:#9d50bb"></div>
            </div>
        </div>
    </div>
</div>

<!-- Payment History -->
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Payment History</h5>
        <button class="btn btn-neon py-2 px-4" onclick="window.print()">
            <i class="fa-solid fa-print me-2"></i>Print Report
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Method</th>
                    <th>Amount</th>
                    <th>Invoice</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $i => $pay)
                <tr>
                    <td class="text-secondary small">{{ $i+1 }}</td>
                    <td><small>{{ $pay->created_at->format('M d, Y') }}</small></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($pay->appointment->customer->name) }}&background=00d2ff&color=fff" class="rounded-circle" width="26">
                            <span class="small">{{ $pay->appointment->customer->name }}</span>
                        </div>
                    </td>
                    <td><small class="text-secondary">{{ $pay->appointment->service->name }}</small></td>
                    <td><span class="badge border text-secondary" style="border-color:rgba(255,255,255,0.1)!important">{{ strtoupper($pay->payment_method) }}</span></td>
                    <td><span class="fw-bold" style="color:#00d2ff">${{ number_format($pay->amount, 2) }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-info print-invoice"
                            data-name="{{ $pay->appointment->customer->name }}"
                            data-service="{{ $pay->appointment->service->name }}"
                            data-amount="{{ $pay->amount }}"
                            data-date="{{ $pay->created_at->format('M d, Y') }}"
                            data-method="{{ strtoupper($pay->payment_method) }}">
                            <i class="fa-solid fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-secondary">No payments recorded yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Hidden Invoice Template -->
<div id="invoice-template" style="display:none">
    <div style="font-family:sans-serif;padding:60px;max-width:700px;margin:auto;color:#111">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:40px">
            <div>
                <h1 style="color:#00d2ff;margin:0;font-size:2rem;letter-spacing:2px">WELCOME SALON</h1>
                <p style="color:#888;margin:4px 0 0">Premium Hair & Beauty Studio</p>
            </div>
            <div style="text-align:right">
                <h3 style="margin:0;color:#333">INVOICE</h3>
                <p style="color:#888;margin:4px 0 0" id="inv-date-out"></p>
            </div>
        </div>
        <hr style="border-color:#eee;margin-bottom:30px">
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td style="padding:8px 0"><strong>Billed To:</strong></td>
                <td style="padding:8px 0" id="inv-name-out"></td>
            </tr>
            <tr>
                <td style="padding:8px 0"><strong>Service:</strong></td>
                <td style="padding:8px 0" id="inv-service-out"></td>
            </tr>
            <tr>
                <td style="padding:8px 0"><strong>Payment Method:</strong></td>
                <td style="padding:8px 0" id="inv-method-out"></td>
            </tr>
        </table>
        <hr style="border-color:#eee;margin:30px 0">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="background:#f9f9f9">
                    <th style="padding:12px;text-align:left">Description</th>
                    <th style="padding:12px;text-align:right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding:12px;border-bottom:1px solid #eee" id="inv-service-row"></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;text-align:right;font-weight:bold" id="inv-amount-out"></td>
                </tr>
            </tbody>
        </table>
        <div style="text-align:right;margin-top:20px">
            <h3 style="color:#00d2ff">Total Paid: <span id="inv-total-out"></span></h3>
        </div>
        <hr style="margin-top:60px">
        <p style="text-align:center;color:#aaa;font-size:0.85rem">Thank you for choosing Welcome Salon ♥</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('.print-invoice').click(function() {
    const d = $(this).data();
    $('#inv-name-out').text(d.name);
    $('#inv-service-out').text(d.service);
    $('#inv-method-out').text(d.method);
    $('#inv-service-row').text(d.service);
    $('#inv-date-out').text(d.date);
    $('#inv-amount-out').text('$'+parseFloat(d.amount).toFixed(2));
    $('#inv-total-out').text('$'+parseFloat(d.amount).toFixed(2));

    const body = $('#invoice-template').html();
    const orig = document.body.innerHTML;
    document.body.innerHTML = body;
    window.print();
    document.body.innerHTML = orig;
    location.reload();
});
</script>
@endsection
