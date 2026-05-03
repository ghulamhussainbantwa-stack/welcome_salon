<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Message;
use App\Models\Staff;

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $staff = Staff::all();
        $stats = [
            'customers'    => Customer::count(),
            'services'     => Service::count(),
            'appointments' => Appointment::count(),
        ];
        return view('frontend.home', compact('services', 'staff', 'stats'));
    }

    public function services()
    {
        $services = Service::all();
        return view('frontend.services', compact('services'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Thank you! Your message has been sent successfully.'
        ]);
    }

    public function book()
    {
        $services = Service::all();
        return view('frontend.book', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'service_id'       => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        $customer = Customer::firstOrCreate(
            ['phone' => $validated['phone']],
            ['name'  => $validated['name']]
        );

        Appointment::create([
            'customer_id'      => $customer->id,
            'service_id'       => $validated['service_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status'           => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your appointment has been booked! We will confirm shortly via phone.'
        ]);
    }
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        Message::create([
            'name'    => 'Newsletter Subscriber',
            'email'   => $validated['email'],
            'subject' => 'Newsletter Subscription',
            'message' => 'User subscribed to the newsletter from the footer.',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Welcome to the Elite! You have successfully subscribed.'
        ]);
    }
}
