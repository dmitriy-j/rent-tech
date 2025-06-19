@extends('layouts.app')

@section('title', 'Регистрация ' . ($role === 'tenant' ? 'арендатора' : 'арендодателя'))

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">
                Регистрация {{ $role === 'tenant' ? 'арендатора' : 'арендодателя' }}
            </h1>
            <p class="mt-2 text-sm text-gray-600">
                Заполните все обязательные поля (помечены *)
            </p>
        </div>

        <form method="POST" action="{{ route('register.process', $role) }}" class="bg-white shadow rounded-lg p-8">
            @csrf

            <!-- Основная информация -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Основная информация</h2>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email *</label>
                    <input type="email" name="email" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Пароль *</label>
                    <input type="password" name="password" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Подтверждение пароля *</label>
                    <input type="password" name="password_confirmation" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Юридическая информация -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Юридическая информация</h2>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Наименование юридического лица *</label>
                    <input type="text" name="legal_name" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <div class="flex items-center">
                        <input type="checkbox" name="with_vat" value="1"
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-900">
                            Работаем с НДС
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:col-span-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ИНН *</label>

                        <input type="text" name="inn" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">КПП</label>
                        <input type="text" name="kpp"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ОГРН/ОГРНИП *</label>
                        <input type="text" name="ogrn" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ОКПО</label>
                        <input type="text" name="okpo"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Адреса -->
            <div class="grid grid-cols-1 gap-6 mb-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Адреса</h2>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Юридический адрес *</label>
                    <textarea name="legal_address" rows="2" required
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <div class="flex items-center">
                        <input type="checkbox" name="actual_address_same" value="1"
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded" id="sameAddressCheckbox">
                        <label for="sameAddressCheckbox" class="ml-2 block text-sm text-gray-900">
                            Фактический адрес совпадает с юридическим
                        </label>
                    </div>
                </div>

                <div id="actualAddressField" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700">Фактический адрес *</label>
                    <textarea name="actual_address" rows="2"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

            <!-- Банковские реквизиты -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Банковские реквизиты</h2>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Наименование банка *</label>
                    <input type="text" name="bank_name" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Расчётный счёт *</label>
                    <input type="text" name="account_number" required

                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">БИК *</label>
                    <input type="text" name="bik" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Корреспондентский счёт</label>
                    <input type="text" name="correspondent_account"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Контактные лица -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Контактные лица</h2>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Руководитель организации</label>
                    <input type="text" name="director"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Телефон</label>
                    <input type="tel" name="phone"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Менеджер</label>
                    <input type="text" name="manager"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Зарегистрироваться
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sameAddressCheckbox = document.getElementById('sameAddressCheckbox');
        const actualAddressField = document.getElementById('actualAddressField');

        sameAddressCheckbox.addEventListener('change', function() {
            actualAddressField.style.display = this.checked ? 'none' : 'block';
        });

        // Инициализируем состояние
        actualAddressField.style.display = sameAddressCheckbox.checked ? 'none' : 'block';
    });
</script>
@endsection
