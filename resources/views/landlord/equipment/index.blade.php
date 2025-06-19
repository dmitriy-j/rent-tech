{{-- resources/views/landlord/equipment/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Моя техника')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Моя техника</h1>
        <a href="{{ route('landlord.equipment.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg flex items-center transition">
            <i class="fas fa-plus mr-2"></i> Добавить технику
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($equipments->isEmpty())
        <div class="bg-gray-100 border border-gray-200 rounded-lg p-8 text-center">
            <i class="fas fa-hard-hat text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 text-lg">У вас пока нет добавленной техники</p>
            <a href="{{ route('landlord.equipment.create') }}"
               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition">
                Добавить первую технику
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 text-left">Изображение</th>
                        <th class="py-3 px-4 text-left">Название</th>
                        <th class="py-3 px-4 text-left">Ставка (₽/час)</th>
                        <th class="py-3 px-4 text-left">Статус</th>
                        <th class="py-3 px-4 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipments as $equipment)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-4">
                            @if($equipment->image_path)
                                <img src="{{ asset('storage/' . $equipment->image_path) }}"
                                     alt="{{ $equipment->name }}"
                                     class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-hard-hat"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium">{{ $equipment->name }}</td>
                        <td class="py-3 px-4">{{ number_format($equipment->hourly_rate, 2) }} ₽</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-xs
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
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('landlord.equipment.edit', $equipment) }}"
                                   class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-100"
                                title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="{{ route('landlord.equipment.show', $equipment) }}"
                                   class="text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-green-100"
                                   title="Просмотреть">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('landlord.equipment.destroy', $equipment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-100"
                                            onclick="return confirm('Вы уверены, что хотите удалить эту технику?')"
                                            title="Удалить">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $equipments->links() }}
        </div>
    @endif
</div>
@endsection

