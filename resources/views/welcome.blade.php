<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Makmur</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Smooth fade */
        .fade-in {
            animation: fadeIn 1.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(50px);}
            to { opacity: 1; transform: translateY(0);}
        }

        /* Soft glow */
        .btn-glow:hover {
            box-shadow: 0 0 25px rgba(255, 200, 100, 0.5);
        }

        /* Glass card */
        .glass {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>

<body class="h-screen overflow-hidden text-white">

<div class="relative h-full">

    <!-- Background -->
    <img src="{{ asset('image/mkr.jpeg') }}"
         class="absolute inset-0 w-full h-full object-cover">

    <!-- Overlay cinematic -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/90 via-black/60 to-black/90"></div>

    <!-- Lighting effect -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,200,120,0.15),transparent_70%)]"></div>

    <!-- Navbar -->
    <nav class="absolute top-0 w-full px-8 py-5 flex justify-between items-center z-20
                backdrop-blur-md bg-black/30 border-b border-white/10">

        <h1 class="text-2xl font-bold tracking-wide">☕ Makmur</h1>

        <span class="text-sm text-gray-300 hidden md:block">
            Coffee • Chill • Work
        </span>
    </nav>

    <!-- MAIN HERO -->
    <div class="relative z-10 flex justify-center items-center h-full px-4 fade-in">

        <!-- Glass Card -->
        <div class="glass rounded-2xl p-10 max-w-2xl text-center shadow-2xl">

            <!-- Badge -->
            <span class="inline-block mb-4 px-4 py-1 text-sm rounded-full
                         bg-yellow-500/20 border border-yellow-400/30">
                ✨ Cafe Modern & Nyaman
            </span>

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                Cafe Makmur
            </h1>

            <!-- Subtitle -->
            <p class="text-gray-200 mb-8 leading-relaxed">
                Tempat terbaik untuk menikmati kopi, bekerja dengan nyaman,
                dan menghabiskan waktu bersama orang terdekat.
            </p>

            <!-- Buttons -->
            @if (Route::has('login') && Route::has('register'))
            <div class="flex flex-col sm:flex-row gap-4 justify-center">

                <!-- Login -->
                <a href="{{ route('login') }}"
                   class="btn-glow px-8 py-3 rounded-xl font-semibold
                   bg-yellow-500 text-black shadow-lg
                   hover:bg-yellow-400 hover:scale-105 transition duration-300">

                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>

                <!-- Register -->
                <a href="{{ route('register') }}"
                   class="px-8 py-3 rounded-xl font-semibold
                   border border-white/50
                   hover:bg-white hover:text-black hover:scale-105 transition duration-300">

                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>

            </div>
            @endif

        </div>

    </div>

    <!-- Footer -->
    <div class="absolute bottom-5 w-full text-center text-sm text-gray-300 z-20">
        © {{ date('Y') }} Cafe Makmur • Open 10:00 - 23:00
    </div>

</div>

</body>
</html>