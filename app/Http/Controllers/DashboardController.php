<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'today_appointments' => Appointment::whereDate('appointment_date', Carbon::today())->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
        ];

        $recent_appointments = Appointment::with(['customer', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_appointments'));
    }
}
