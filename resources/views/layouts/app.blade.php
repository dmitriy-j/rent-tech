<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RentTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <script src="{{ asset('build/assets/app.js') }}"></script>
    <style>
        .urgent-request {
            transition: all 0.3s ease;
        }
        .urgent-request:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex flex-col min-h-screen">
        <!-- Верхний блок (Header) -->
        <header class="bg-blue-800 text-white p-4 shadow-md">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <!-- Логотип и навигация -->
                <div class="flex items-center w-full md:w-auto justify-between">
                    <div class="text-xl font-bold flex items-center">
                        <i class="fas fa-hard-hat mr-2"></i>
                        RentTech
                    </div>

                    <!-- Мобильное меню -->
                    <button class="md:hidden text-white focus:outline-none" id="mobileMenuButton">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <!-- Навигация -->
                <nav class="mt-4 md:mt-0 w-full md:w-auto hidden md:block" id="mainNavigation">
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 text-sm md:text-base">
                        <a href="{{ route('about') }}" class="hover:text-blue-200 transition"><i class="fas fa-building mr-1"></i> О компании</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-clipboard-list mr-1"></i> Заявки</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-book mr-1"></i> Каталог</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-tools mr-1"></i> Свободная техника</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-wrench mr-1"></i> Ремонт техники</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-handshake mr-1"></i> Сотрудничество</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-envelope mr-1"></i> Контакты</a>
                        <a href="#" class="hover:text-blue-200 transition"><i class="fas fa-briefcase mr-1"></i> Вакансии</a>
                    </div>
                </nav>

                <!-- Для авторизованных пользователей -->
                @auth
                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                        <div class="bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-user text-blue-800"></i>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm hover:text-blue-200 transition">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="hidden md:inline">Выход</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </header>

        <div class="flex flex-1">
            <!-- Левый блок (Sidebar) -->
            <aside class="bg-gray-100 w-full md:w-64 p-4 border-r border-gray-200">
                @include('layouts.sidebar')
            </aside>

            <!-- Центральный блок (Content) -->
            <main class="flex-1 p-4 md:p-6">
<!-- Поисковая строка -->
                <div class="mb-6 bg-white p-4 rounded-lg shadow">
                    <form action="{{ route('search') }}" method="GET" class="flex">
                        <input
                            type="text"
                            name="query"
                            placeholder="Поиск техники..."
                            class="flex-1 p-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button type="submit" class="bg-blue-600 text-white px-4 rounded-r-lg hover:bg-blue-700 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Контент страницы -->
                <div class="bg-white p-6 rounded-lg shadow">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Подвал (Footer) -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Контакты -->
                    <div>
                        <h3 class="font-bold text-lg mb-4 flex items-center">
                            <i class="fas fa-phone-alt mr-2"></i> Контакты
                        </h3>
                        <p class="mb-2"><i class="fas fa-phone mr-2"></i> +7 (ХХХ) ХХХ-ХХ-ХХ</p>
                        <p><i class="fas fa-envelope mr-2"></i> info@renttech.ru</p>
                    </div>

                    <!-- Адрес -->
                    <div>
                        <h3 class="font-bold text-lg mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i> Адрес
                        </h3>
                        <p><i class="fas fa-building mr-2"></i> г. Москва, ул. Строителей, д. 45</p>
                    </div>

                    <!-- Быстрые ссылки -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">Быстрые ссылки</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-blue-300 transition"><i class="fas fa-chevron-right mr-2"></i> О компании</a></li>
                            <li><a href="#" class="hover:text-blue-300 transition"><i class="fas fa-chevron-right mr-2"></i> Каталог техники</a></li>
                            <li><a href="#" class="hover:text-blue-300 transition"><i class="fas fa-chevron-right mr-2"></i> Контакты</a></li>
                        </ul>
                    </div>

                    <!-- Информация -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">Информация</h3>
                        <p class="mb-2">Разработчик: [Ваше имя/компания]</p>
                        <p>&copy; {{ date('Y') }} RentTech. Все права защищены.</p>
                        <div class="mt-4 flex space-x-4">
                            <a href="#" class="text-xl hover:text-blue-300 transition"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-xl hover:text-blue-300 transition"><i class="fab fa-telegram"></i></a>
                            <a href="#" class="text-xl hover:text-blue-300 transition"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Мобильное меню
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const menu = document.getElementById('mainNavigation');
            menu.classList.toggle('hidden');
            menu.classList.toggle('block');
        });
    </script>
</body>
</html>
