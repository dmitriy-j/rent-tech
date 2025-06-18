@auth
    @if(auth()->user()->role === 'tenant')
        <!-- Сайдбар для арендатора -->
        <div class="mb-4">
<h3 class="font-bold">{{ Auth::user()->name }}</h3>
            <p>Баланс: {{ Auth::user()->balance }} ₽</p>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('tenant.dashboard') }}" class="block">Техника в работе</a>
            <a href="{{ route('tenant.orders') }}" class="block">Заказы</a>
            <a href="{{ route('tenant.documents') }}" class="block">Документы</a>
            <a href="{{ route('tenant.contract') }}" class="block">Договор</a>
            <a href="{{ route('tenant.feedback') }}" class="block">Жалобы и предложения</a>
        </nav>

    @elseif(auth()->user()->role === 'landlord')
        <!-- Сайдбар для арендодателя -->
        <div class="mb-4">
            <h3 class="font-bold">{{ Auth::user()->name }}</h3>
            <p>Баланс: {{ Auth::user()->balance }} ₽</p>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('landlord.equipment') }}" class="block">Техника</a>
            <a href="{{ route('landlord.orders') }}" class="block">Заказы</a>
            <a href="{{ route('landlord.documents') }}" class="block">Документы</a>
            <a href="{{ route('landlord.contract') }}" class="block">Договор</a>
            <a href="{{ route('landlord.feedback') }}" class="block">Жалобы и предложения</a>
        </nav>

    @elseif(auth()->user()->role === 'admin')
        <!-- Сайдбар для администратора -->
        <div class="mb-4">
            <h3 class="font-bold">{{ Auth::user()->name }}</h3>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('admin.bank-statements') }}" class="block">Банковские выписки</a>
            <a href="{{ route('admin.balances') }}" class="block">Балансы</a>
            <!-- ... остальные пункты для админа ... -->
            <a href="{{ route('admin.feedback') }}" class="block">Обратная связь</a>
        </nav>
    @endif

@else
    <!-- Сайдбар для гостя -->
    <div class="mb-6">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-2">
                <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-2">
                <input type="password" name="password" placeholder="Пароль" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Войти</button>
        </form>
    </div>

    <div class="mb-4">
        <a href="{{ route('register') }}" class="block text-center bg-gray-200 p-2 rounded">Регистрация</a>
    </div>

    <div class="mb-4">
        <h3 class="font-bold mb-2">Новости</h3>
        <!-- Блок новостей -->
    </div>

    <div>
        <h3 class="font-bold mb-2">Срочные заявки</h3>
        <!-- Блок срочных заявок -->
    </div>
@endauth
