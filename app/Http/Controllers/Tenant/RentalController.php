<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Equipment;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class RentalController extends Controller
{
    public function create(Equipment $equipment)
    {
        return view('tenant.rentals.create', compact('equipment'));
    }

    public function store(Request $request, Equipment $equipment)
    {
        $request->validate([
11:22

PHP
'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
        ]);

        $hours = Carbon::parse($request->start_date)
            ->diffInHours(Carbon::parse($request->end_date));

        $totalPrice = $hours * $equipment->hourly_rate;

        if (auth()->user()->balance < $totalPrice) {
            return back()->withErrors('Недостаточно средств на балансе');
        }

        $rental = Rental::create([
            'tenant_id' => auth()->id(),
            'equipment_id' => $equipment->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // Резервирование средств
        auth()->user()->transactions()->create([
            'amount' => -$totalPrice,
            'type' => 'reservation',
            'status' => 'completed',
            'description' => 'Бронирование техники #' . $equipment->id
        ]);

        auth()->user()->updateBalance();

        return redirect()->route('tenant.rentals.show', $rental)
            ->with('success', 'Техника успешно забронирована!');
    }
}
