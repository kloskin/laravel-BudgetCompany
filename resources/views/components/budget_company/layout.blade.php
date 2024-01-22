<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{$title ?? null}}</title>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/style.css'])

    @vite(['resources/js/script.js'])



</head>

<body class="font-sans antialiased">

{{-- container for all --}}
<div class="container mx-auto p-5">

    <nav class="flex justify-between items-center p-4">
        <!-- Logo on the left -->
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="text-3xl font-medium tracking-wide myTextColor2">BC</a>
        </div>

        <!-- Centered search bar with button -->
        <livewire:search />
        <!-- Links on the right -->
        <div class="md:flex hidden items-center space-x-6 text-sm md:text-lg">
            @if (Auth::check())
                <p>Logged as: <a class="myTextColor2 " href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a></p>
                <x-budget_company.logout-form />
            @else
                <a class="tracking-widest myTextColor2" href="{{ route('login') }}">Login</a>
                <a class="tracking-widest myTextColor2" href="{{ route('register') }}">Register</a>
            @endif
        </div>

        <!-- Hamburger icon on the right for mobile -->
        <div id="hamburger-icon" class="space-y-2 cursor-pointer md:hidden">
            <div class="w-8 h-1 myBgColor3"></div>
            <div class="w-8 h-1 myBgColor3"></div>
            <div class="w-8 h-1 myBgColor3"></div>
        </div>
    </nav>

    <nav class="flex justify-between items-center m-5">
        <div class="hidden md:flex ">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-12 rtl:space-x-reverse text-2xl ">
                    <li>
                        <a href="/" class="tracking-widest myTextColor2" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{route('transactions.index')}}" class="tracking-widest myTextColor2">Transactions</a>
                    </li>
                    <li>
                        <a href="{{route('invoices.index')}}" class="tracking-widest myTextColor2">Invoices</a>
                    </li>
                    <li>
                        <a href="{{route('transactions.budget')}}" class="tracking-widest myTextColor2">Budget</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>



    {{-- mobile menu --}}
    <div class="md:hidden ">
        <div id="mobile-menu"
             class="flex-col  items-center hidden py-8 space-y-6 myBgColor3 left-6 right-6 drop-shadow-lg">
            @if (Auth::check())
                <p>Logged as: <a class="hover:text-stone-500" href="{{ route('profile.edit') }}">{{Auth::user()->name}}</a></p>

                <a href="/"
                   class="inline font-bold text-lg px-10 py-2 rounded-full bg-gray-700">
                    <x-budget_company.logout-form /></a>
                <a href="{{route('home')}}"
                   class="inline font-bold text-lg px-8 py-2 text-white ">
                   Home</a>
                <a href="{{route('transactions.index')}}"
                   class="inline font-bold text-lg px-8 py-2 text-white ">
                    Transaction</a>
                <a href="{{route('invoices.index')}}"
                   class="inline font-bold text-lg px-8 py-2 text-white ">
                    Invoices</a>
                <a href="{{route('transactions.budget')}}"
                   class="inline font-bold text-lg px-8 py-2 text-white ">
                    Budget</a>
            @else
                <a class="tracking-widest hover:text-stone-500" href="{{ route('login') }}">Login</a>
                <a class="tracking-widest hover:text-stone-500" href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>

    {{ $slot }}

    {{-- footer --}}
    <footer class="flex items-center justify-center mt-12">
        &copy; 2024 BudgetCompany
    </footer>
</div>
</body>


</html>

