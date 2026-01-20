<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventaris - RSUD H. Badaruddin Kasim</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    },
                    colors: {
                        indigo: {
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="antialiased font-sans">

    <div
        class="relative min-h-screen flex flex-col justify-center items-center bg-gray-900 selection:bg-indigo-500 selection:text-white overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('rumah_sakit.jpeg') }}" alt="Background RSUD"
                class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-gray-900/30"></div>
        </div>

        @if (Route::has('login'))
            <div class="fixed top-0 right-0 p-6 text-right z-50">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-white hover:text-indigo-400 transition focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">
                        <i class="fa-solid fa-gauge-high mr-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-white hover:text-indigo-400 transition focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i> Log in
                    </a>

                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-indigo-400 transition focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                    @endif --}}
                @endauth
            </div>
        @endif

        <div class="relative z-10 max-w-7xl mx-auto p-6 lg:p-8 text-center">

            <div class="flex flex-col items-center animate-fade-in-up">

                <div class="bg-white/10 backdrop-blur-sm p-4 rounded-full shadow-2xl mb-6 border border-white/20">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo RSUD"
                        class="w-24 h-24 object-contain drop-shadow-md">
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-2 drop-shadow-lg">
                    Sistem Informasi <span class="text-indigo-400">Inventaris</span>
                </h1>

                <h2 class="text-xl md:text-2xl font-light text-gray-200 mb-8">
                    RSUD H. Badaruddin Kasim
                </h2>

                <div class="mt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-full shadow-lg transition transform hover:scale-105 hover:shadow-indigo-500/50 flex items-center gap-2">
                            Masuk ke Dashboard <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-full shadow-lg transition transform hover:scale-105 hover:shadow-indigo-500/50 flex items-center gap-2">
                            Login Petugas <i class="fa-solid fa-key"></i>
                        </a>
                    @endauth
                </div>

            </div>

        </div>

        <div class="absolute bottom-6 w-full text-center z-10 text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} SIM Aset & Inventaris RSUD H. Badaruddin Kasim. All rights reserved.</p>
            <p class="mt-1 text-xs">Jl. Tanjung Baru, Desa Maburai, Kab. Tabalong</p>
        </div>

    </div>

</body>

</html>
