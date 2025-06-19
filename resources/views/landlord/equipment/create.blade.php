{{-- resources/views/landlord/equipment/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Добавить технику')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Добавить новую технику</h1>

    <form action="{{ route('landlord.equipment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-2 font-medium">Название техники *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 font-medium">Ставка аренды (₽/час) *</label>
                <input type="number" name="hourly_rate" value="{{ old('hourly_rate') }}"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    min="100" step="50" required>
                @error('hourly_rate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block mb-2 font-medium">Описание *</label>
                <textarea name="description" rows="4"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 font-medium">Изображение</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="image" id="imageInput" class="hidden">
                    <div id="imagePreview" class="mb-4">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Перетащите изображение или нажмите для загрузки</p>
                    </div>
                    <button type="button" onclick="document.

getElementById('imageInput').click()"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                        Выбрать файл
                    </button>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block mb-2 font-medium">Дополнительная информация</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Техника будет автоматически добавлена в каталог
                    </p>
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>Минимальная ставка: 100 ₽/час
                    </p>
                </div>
            </div>
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center transition">
                <i class="fas fa-plus-circle mr-2"></i> Добавить технику
            </button>
            <a href="{{ route('landlord.equipment.index') }}"
               class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400">
                Отмена
            </a>
        </div>
    </form>
</div>

<script>
    // Превью изображения
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="max-w-full max-h-48 mx-auto rounded-lg">`;
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
