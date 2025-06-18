<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RentTech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex flex-col min-h-screen">
        <!-- Верхний блок (Header) -->
        <header class="bg-gray-800 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-10">
                    <!-- Логотип -->
                    <div class="text-xl font-bold">RentTech</div>

                    <!-- Навигация -->
                    <nav class="hidden md:flex space-x-6">
                        <a href="{{ route('about') }}">О компании</a>
                        <a href="#">Заявки</a>
                        <a href="#">Каталог</a>
                        <a href="#">Свободная техника</a>
                        <a href="#">Ремонт техники</a>
                        <a href="#">Сотрудничество</a>
                        <a href="#">Контакты</a>
                        <a href="#">Вакансии</a>
                    </nav>
                </div>

                <!-- Для авторизованных пользователей -->
                @auth
                    <div class="flex items-center space-x-4">
                        <span>{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Выход</button>
                        </form>
                    </div>
                @endauth
            </div>
        </header>

        <div class="flex flex-1">
            <!-- Левый блок (Sidebar) -->
            <aside class="bg-gray-100 w-64 p-4">
                @include('layouts.sidebar')
            </aside>

            <!-- Центральный блок (Content) -->
            <main class="flex-1 p-6">
                <!-- Поисковая строка -->
                <div class="mb-6">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="query" placeholder="Поиск техники..." class="w-full p-2 border rounded">
                    </form>
                </div>

                <!-- Контент страницы -->
                <div class="bg-white p-6 rounded shadow">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Подвал (Footer) -->
        <footer class="bg-gray-800 text-white p-6">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="font-bold mb-2">Контакты</h3>
                    <p>Телефон: +7 (XXX) XXX-XX-XX</p>
                    <p>Email: info@renttech.ru</p>
                </div>
                <div>
                    <h3 class="font-bold mb-2">Адрес</h3>
                    <p>г. Москва, ул. Строителей, д. 45</p>
                </div>
                <div>
                    <p>Разработчик: [Ваше имя/компания]</p>
                    <p>&copy; {{ date('Y') }} RentTech. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
