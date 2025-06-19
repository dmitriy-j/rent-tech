
{{-- resources/views/landlord/equipment/show.blade.php --}}
@extends('layouts.app')

@section('title', $equipment->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $equipment->name }}</h1>
            <div class="flex items-center mt-2">
                <span class="px-3 py-1 rounded-full text-sm
                    {{ $equipment->status == 'available' ? 'bg-green-100 text-green-800' :
                       ($equipment->status == 'rented' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                    @if($equipment->status == 'available')
                        Доступна
                    @elseif($equipment->status == 'rented')
                        В аренде
                    @else
                        В ремонте
                    @endif
                </span>
                <span class="ml-4 text-gray-600">
                    <i class="fas fa-clock mr-1"></i> {{ number_format($equipment->hourly_rate, 2) }} ₽/час
                </span>
            </div>
        </div>
        <a href="{{ route('landlord.equipment.index') }}"
           class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
            <i class="fas fa-arrow-left mr-2"></i> Назад
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1">
            @if($equipment->image_path)
                <img src="{{ asset('storage/' . $equipment->image_path) }}"
                     alt="{{ $equipment->name }}"
                     class="w-full h-auto rounded-lg shadow-md">
            @else
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-64 flex items-center justify-center text-gray-400">
                    <i class="fas fa-hard-hat text-5xl"></i>
                </div>
            @endif
        </div>

        <div class="md:col-span-2">
            <h2 class="text-xl font-semibold mb-4">Описание</h2>
            <p class="text-gray-700 mb-6">{{ $equipment->description }}</p>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold mb-2">Детали</h3>
                <ul class="space-y-2">
                    <li class="flex">

<span class="w-40 text-gray-600">Дата добавления:</span>
                        <span>{{ $equipment->created_at->format('d.m.Y') }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-40 text-gray-600">Последнее обновление:</span>
                        <span>{{ $equipment->updated_at->format('d.m.Y') }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-40 text-gray-600">Статус:</span>
                        <span class="font-medium">
                            @if($equipment->status == 'available')
                                Доступна для аренды
                            @elseif($equipment->status == 'rented')
                                Сейчас в аренде
                            @else
                                Находится в ремонте
                            @endif
                        </span>
                    </li>
                </ul>
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('landlord.equipment.edit', $equipment) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Редактировать
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
