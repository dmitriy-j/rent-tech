<?php

namespace App\Http\Controllers\Tenant;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function depositForm()
    {
        return view('tenant.balance.deposit');
    }

    public function processDeposit(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:100|max:100000']);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount * 100,
            'currency' => 'rub',
            'payment_method_types' => ['card'],
        ]);

        return view('tenant.balance.confirm', [
            'clientSecret' => $paymentIntent->client_secret,
            'amount' => $request->amount
        ]);
    }

    public function confirmDeposit(Request $request)
    {
        // Проверка и запись транзакции
        auth()->user()->transactions()->create([
            'amount' => $request->amount,
            'type' => 'deposit',
            'status' => 'completed',
            'description' => 'Пополнение баланса через карту'
        ]);

        auth()->user()->updateBalance();

        return redirect()->route('tenant.dashboard')
            ->with('success', 'Баланс успешно пополнен!');
    }
}
