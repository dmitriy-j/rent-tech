@extends('layouts.app')

@section('title', 'Редактирование техники')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Редактирование техники</h1>

    <form action="{{ route('landlord.equipment.update', $equipment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Поля формы -->
            <div>
                <label class="block mb-2 font-medium">Название</label>
                <input type="text" name="name" value="{{ old('name', $equipment->name) }}"
                    class="w-full p-3 border rounded-lg">
            </div>

            <div>
                <label class="block mb-2 font-medium">Ставка (₽/час)</label>
                <input type="number" name="hourly_rate" value="{{ old('hourly_rate', $equipment->hourly_rate) }}"
                    class="w-full p-3 border rounded-lg">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-2 font-medium">Описание</label>
                <textarea name="description" rows="4"
                    class="w-full p-3 border rounded-lg">{{ old('description', $equipment->description) }}</textarea>
            </div>

            <div>
                <label class="block mb-2 font-medium">Статус</label>
                <select name="status" class="w-full p-3 border rounded-lg">
                    <option value="available" {{ $equipment->status == 'available' ? 'selected' : '' }}>Доступна</option>
                    <option value="rented" {{ $equipment->status == 'rented' ? 'selected' : '' }}>В аренде</option>
                    <option value="repair" {{ $equipment->status == 'repair' ? 'selected' : '' }}>В ремонте</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 font-medium">Изображение</label>
                <input type="file" name="image" class="w-full p-2">
                @if($equipment->image_path)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $equipment->image_path) }}"
                         alt="{{ $equipment->name }}"
                         class="w-32 h-32 object-cover rounded-lg">
                </div>
                @endif
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Сохранить изменения
            </button>
            <a href="{{ route('landlord.equipment.index') }}"
               class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400">
                Отмена
            </a>
        </div>
    </form>
</div>
@endsection
