@extends('layouts.app')

@section('title', 'Выбор типа аккаунта')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Выберите тип аккаунта
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('register.role.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <!-- Арендатор -->
                <label class="flex items-center p-6 border border-gray-300 rounded-lg cursor-pointer hover:border-blue-500">
                    <input type="radio" name="role" value="tenant" class="h-5 w-5 text-blue-600" required>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Арендатор</h3>
                        <p class="text-gray-500">Ищу строительную технику для аренды</p>
                    </div>
                </label>

                <!-- Арендодатель -->
                <label class="flex items-center p-6 border border-gray-300 rounded-lg cursor-pointer hover:border-blue-500">
                    <input type="radio" name="role" value="landlord" class="h-5 w-5 text-blue-600">
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Арендодатель</h3>
                        <p class="text-gray-500">Предоставляю технику в аренду</p>
                    </div>
                </label>
            </div>

            <div>
                <button type="submit"

                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Продолжить
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
