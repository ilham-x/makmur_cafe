<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="font-sans bg-green-400 text-black antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center p-6">

        <!-- 🔥 LOGO CUSTOM (GANTI DI SINI) -->
        <div class="mb-6">
    <button onclick="openModal()" 
        class="bg-yellow-300 border-4 border-black p-4 shadow-[6px_6px_0px_black] -rotate-2">

        <img src="{{ asset('image/logo.jpeg') }}" 
             class="w-24 h-24 object-cover rounded-full border-4 border-black shadow-[4px_4px_0px_black] mx-auto hover:scale-110 transition">

    </button>
</div>
        <!-- CARD -->
        <div class="w-full sm:max-w-md p-6 bg-yellow-200 border-4 border-black shadow-[10px_10px_0px_black]">

            {{ $slot }}

        </div>

    </div>
<script>
function openModal() {
    document.getElementById('logoModal').classList.remove('hidden');
    document.getElementById('logoModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('logoModal').classList.add('hidden');
}
</script>
</body>
</html>