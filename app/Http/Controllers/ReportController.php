<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        
        $today_income = Payment::whereDate('created_at', $today)->sum('amount');
        $monthly_income = Payment::where('created_at', '>=', $startOfMonth)->sum('amount');
        
        $payments = Payment::with('appointment.customer', 'appointment.service')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reports.index', compact('today_income', 'monthly_income', 'payments'));
    }
}
