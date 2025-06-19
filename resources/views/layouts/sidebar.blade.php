
@auth
    @if(auth()->user()->role === 'tenant')
        <!-- Сайдбар для арендатора -->
        <div class="mb-6 p-4 bg-white rounded-lg shadow">
            <div class="flex items-center mb-4">
                <div class="bg-gray-200 rounded-full w-12 h-12 flex items-center justify-center mr-3">
                    <i class="fas fa-user text-blue-800"></i>
                </div>
                <div>
                    <h3 class="font-bold">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-green-600 font-semibold">Баланс: {{ number_format(Auth::user()->balance, 2) }} ₽</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('tenant.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-tools mr-2 text-blue-600"></i> Техника в работе
                </a>
                <a href="{{ route('tenant.orders') }}" class="flex items-center p-2 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-clipboard-list mr-2 text-blue-600"></i> Заказы
                </a>
                <a href="{{ route('tenant.documents') }}" class="flex items-center p-2 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-file-alt mr-2 text-blue-600"></i> Документы
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-file-contract mr-2 text-blue-600"></i> Договор
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-comment-alt mr-2 text-blue-600"></i> Жалобы и предложения
                </a>
            </nav>
        </div>

    @elseif(auth()->user()->role === 'landlord')
        <!-- Сайдбар для арендодателя (аналогично арендатору) -->
        ...
    @endif

@else
    <!-- Сайдбар для гостя -->
     <div class="mb-6 bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4 text-center">Вход в систему</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Ваш email"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Пароль</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Ваш пароль"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>
            <div class="flex items-center mb-4">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    class="mr-2"
                >
                <label for="remember" class="text-sm">Запомнить меня</label>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition">
                Войти
            </button>
        </form>
    </div>

    <div class="mb-6">
        <a href="{{ route('register.role') }}" class="block text-center bg-gray-200 p-3 rounded-lg font-medium hover:bg-gray-300 transition">
            Регистрация
        </a>
    </div>

    <div class="mb-6 bg-white p-4 rounded-lg shadow">
        <h3 class="font-bold text-lg mb-3 flex items-center">
            <i class="fas fa-newspaper mr-2 text-blue-600"></i> Новости
        </h3>


<div class="space-y-3">
            <div class="border-l-4 border-blue-500 pl-3 py-1">
                <p class="font-medium">Новая партия экскаваторов</p>
                <p class="text-sm text-gray-500">12.04.2025</p>
            </div>
            <div class="border-l-4 border-green-500 pl-3 py-1">
                <p class="font-medium">Скидки на аренду в мае</p>
                <p class="text-sm text-gray-500">10.04.2025</p>
            </div>
        </div>
    </div>

    <div class="urgent-applications bg-white p-4 rounded-lg shadow">
        <h3 class="font-bold text-lg mb-3 flex items-center text-red-600">
            <i class="fas fa-exclamation-triangle mr-2"></i> Срочные заявки
        </h3>
        <div class="space-y-3">
            <div class="urgent-request bg-red-50 border border-red-200 p-3 rounded-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="font-semibold">Экскаватор JCB</span>
                        <p class="text-sm mt-1 text-gray-700">Срочно на 2 дня, Москва</p>
                    </div>
                    <span class="bg-red-600 text-white text-xs px-2 py-1 rounded">Срочно!</span>
                </div>
                <div class="mt-2 flex items-center text-xs text-gray-500">
                    <i class="far fa-clock mr-1"></i> До 18:00 сегодня
                </div>
            </div>

            <div class="urgent-request bg-red-50 border border-red-200 p-3 rounded-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="font-semibold">Бульдозер CAT</span>
                        <p class="text-sm mt-1 text-gray-700">Для срочных земляных работ</p>
                    </div>
                    <span class="bg-red-600 text-white text-xs px-2 py-1 rounded">Срочно!</span>
                </div>
                <div class="mt-2 flex items-center text-xs text-gray-500">
                    <i class="far fa-clock mr-1"></i> Требуется сегодня до 18:00
                </div>
            </div>
        </div>
    </div>
@endauth
