<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Payment;
use Carbon\Carbon;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Services
        $s1 = Service::create(['name' => 'Haircut & Styling', 'price' => 25.00, 'duration' => 30]);
        $s2 = Service::create(['name' => 'Beard Trim', 'price' => 15.00, 'duration' => 15]);
        $s3 = Service::create(['name' => 'Luxury Facial', 'price' => 50.00, 'duration' => 45]);
        $s4 = Service::create(['name' => 'Hair Coloring', 'price' => 80.00, 'duration' => 120]);

        // Customers
        $c1 = Customer::create(['name' => 'John Smith', 'phone' => '1234567890', 'email' => 'john@gmail.com']);
        $c2 = Customer::create(['name' => 'Sarah Connor', 'phone' => '9876543210', 'email' => 'sarah@example.com']);
        $c3 = Customer::create(['name' => 'Mike Tyson', 'phone' => '555123444', 'email' => 'mike@boxing.com']);

        // Appointments
        $a1 = Appointment::create([
            'customer_id' => $c1->id,
            'service_id' => $s1->id,
            'appointment_date' => Carbon::today(),
            'appointment_time' => '10:00',
            'status' => 'completed'
        ]);

        $a2 = Appointment::create([
            'customer_id' => $c2->id,
            'service_id' => $s3->id,
            'appointment_date' => Carbon::today(),
            'appointment_time' => '14:30',
            'status' => 'pending'
        ]);

        // Payments
        Payment::create([
            'appointment_id' => $a1->id,
            'amount' => $s1->price,
            'payment_method' => 'cash',
            'status' => 'paid'
        ]);
    }
}
