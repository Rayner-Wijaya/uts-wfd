<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'UTS Laravel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

    <div class="max-w-4xl mx-auto px-4 py-6 space-y-6">
        {{-- Title --}}
        <h1 class="text-3xl font-bold text-center text-blue-700">@yield('title')</h1>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 p-3 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        @yield('content')
    </div>

</body>
</html>
