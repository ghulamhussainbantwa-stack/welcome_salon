<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Payment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'service'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();
        
        $customers = Customer::all();
        $services = Service::all();

        return view('appointments.index', compact('appointments', 'customers', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $appointment = Appointment::create($validated);

        if ($validated['status'] == 'completed') {
            $service = Service::find($validated['service_id']);
            Payment::create([
                'appointment_id' => $appointment->id,
                'amount' => $service->price,
                'payment_method' => 'cash',
                'status' => 'paid',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'appointment' => $appointment
        ]);
    }

    public function show(Appointment $appointment)
    {
        return response()->json($appointment->load(['customer', 'service']));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $old_status = $appointment->status;
        $appointment->update($validated);

        if ($validated['status'] == 'completed' && $old_status != 'completed') {
            $service = Service::find($validated['service_id']);
            Payment::updateOrCreate(
                ['appointment_id' => $appointment->id],
                [
                    'amount' => $service->price,
                    'payment_method' => 'cash',
                    'status' => 'paid',
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment updated successfully!',
            'appointment' => $appointment
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Appointment deleted successfully!'
        ]);
    }
}
