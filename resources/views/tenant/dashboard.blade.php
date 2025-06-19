@extends('layouts.app')

@section('title', 'Личный кабинет арендатора')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Личный кабинет арендатора</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Блок баланса -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <h2 class="text-lg font-semibold mb-3">Баланс</h2>
            <div class="text-3xl font-bold text-blue-700 mb-4">
                {{ number_format(auth()->user()->balance, 2) }} ₽
            </div>
            <a href="{{ route('tenant.balance.deposit') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition">
                Пополнить баланс
            </a>
        </div>

        <!-- Техника в работе -->
        <div class="md:col-span-2">
            <h2 class="text-lg font-semibold mb-3">Техника в работе</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Техника</th>
                            <th class="py-2 px-4 border-b">Период</th>
                            <th class="py-2 px-4 border-b">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeRentals as $rental)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $rental->equipment->name }}</td>
                            <td class="py-2 px-4 border-b">
                                {{ $rental->start_date->format('d.m.Y H:i') }} -
                                {{ $rental->end_date->format('d.m.Y H:i') }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">
                                    {{ $rental->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- История заказов -->
    <h2 class="text-xl font-semibold mb-4">История заказов</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Техника</th>

<th class="py-3 px-4 text-left">Дата</th>
                    <th class="py-3 px-4 text-left">Сумма</th>
                    <th class="py-3 px-4 text-left">Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                <tr>
                    <td class="py-3 px-4 border-b">#{{ $rental->id }}</td>
                    <td class="py-3 px-4 border-b">{{ $rental->equipment->name }}</td>
                    <td class="py-3 px-4 border-b">{{ $rental->created_at->format('d.m.Y') }}</td>
                    <td class="py-3 px-4 border-b">{{ number_format($rental->total_price, 2) }} ₽</td>
                    <td class="py-3 px-4 border-b">
                        <span class="px-2 py-1 rounded-full text-xs
                            {{ $rental->status === 'completed' ? 'bg-green-100 text-green-800' :
                               ($rental->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $rental->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
